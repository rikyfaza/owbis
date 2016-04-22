<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mchart extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getMeasurePerView()
	{
		$idview = $this->uri->segment(3);
		$data = array();
		$Q = $this->db->query('SELECT tblmeasure.`name` , tblmeasure.`idmeasure` FROM tblmeasure WHERE idmeasure IN ( SELECT DISTINCT tbldetail.idmeasure FROM tbldetail INNER JOIN tblsecuritymeasure ON tbldetail.`idmeasure` = tblsecuritymeasure.`idmeasure` WHERE tbldetail.idview = "'.$idview.'" AND tblsecuritymeasure.`idusers` = "'.$_SESSION['iduserlogged'].'" AND tblsecuritymeasure.`iddb` = "'.$_SESSION['dbuserlogged'].'" AND tblsecuritymeasure.`view` = "1" ) AND tblmeasure.cloning IS NULL ORDER BY tblmeasure.`name` ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function SynchronizeReport()
	{
		$Q = $this->db->query('SELECT DISTINCT idview, idmeasure FROM tblhirarkikpi WHERE iddb = "'.$_SESSION['dbuserlogged'].'" ORDER BY idmeasure');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$this->refreshData( $row['idview'], $row['idmeasure'] );
		}}
		redirect('maincontroller/setupreport');
	}
	
	public function refreshData( $idview, $idmeasure )
	{
		//$idview = $this->input->post('idview');
		//$idmeasure = $this->input->post('listmeasure');
		//$years = array();
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;
		
		// cari data dari tblchartline dengan idview = $idview
		$Q = $this->db->query('SELECT * FROM tblchartline WHERE idview = "'.$idview.'" AND idmeasure ="'.$idmeasure.'" ');
		
		// kosongkan tabel tblchartline dengan idview = $idview
		if($Q->num_rows() >0)
		{
			$Q1 = $this->db->query('DELETE FROM tblchartline WHERE idview = "'.$idview.'" AND idmeasure ="'.$idmeasure.'" ');
		}
		
		// input data baru ke dalam tblchartline dengan idview = $idview
		$Q2 = $this->db->query('SELECT tbldetail.`idmeasure`, tbldetail.`actual`, tbldetail.`target`, tbldetail.`periodname`, tbldetail.series1, tbldetail.series2, tbldetail.index FROM tbldetail WHERE tbldetail.`year`="'.$years[0]['year'].'" AND tbldetail.`idview`="'.$idview.'" AND idmeasure ="'.$idmeasure.'" ORDER BY FIELD(tbldetail.`periodname`,"jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des") ');
		//print ('SELECT tbldetail.`idmeasure`, tbldetail.`actual`, tbldetail.`target`, tbldetail.`periodname`, tbldetail.series1, tbldetail.series2, tbldetail.index FROM tbldetail WHERE tbldetail.`year`="'.$years[0]['year'].'" AND tbldetail.`idview`="'.$idview.'" AND idmeasure ="'.$idmeasure.'" ');exit;
		if($Q2->num_rows() > 0){foreach($Q2->result_array() as $row){
			//$data[] = $row;
			
			$Qinsert = $this->db->query('INSERT INTO tblchartline(idview,idmeasure,month,actual,target,series1,series2,`index`) VALUES("'.$idview.'","'.$row['idmeasure'].'","'.$row['periodname'].'","'.$row['actual'].'","'.$row['target'].'","'.$row['series1'].'","'.$row['series2'].'", "'.$row['index'].'" )');
			
		}}
		
		// update nilai actual last year
		$Q3 = $this->db->query('SELECT tbldetail.`idmeasure`, tbldetail.`actual`, tbldetail.`periodname` FROM tbldetail WHERE tbldetail.`year`="'.$yearsmin1.'" AND tbldetail.`idview`="'.$idview.'" AND idmeasure ="'.$idmeasure.'" ORDER BY FIELD(tbldetail.`periodname`,"jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des") ');
		if($Q3->num_rows() > 0){foreach($Q3->result_array() as $rows){
			$QUpdateActualLastYear = $this->db->query('UPDATE tblchartline SET actuallastyear = "'.$rows['actual'].'" WHERE idmeasure = "'.$rows['idmeasure'].'" AND idview = "'.$idview.'" AND month = "'.$rows['periodname'].'" ');
		}}
		
		// update nilai actualvstarget
		$Q4 = $this->db->query('SELECT idmeasure, month, actual, target, actuallastyear FROM tblchartline WHERE idview = "'.$idview.'" AND idmeasure ="'.$idmeasure.'" ');
		if($Q4->num_rows() > 0)
		{
			foreach($Q4->result_array() as $rowz)
			{
			
			
				if($rowz['target'] == 0){} else 
				{
					// mengitung nilai actual vs target
					$hitungactualvstarget = ($rowz['actual'] / $rowz['target']) * 100;
					$actualvstarget = number_format($hitungactualvstarget,2);
					
					// mengupdate nilai actual vs target
					$QUpdateActualvsTarget = $this->db->query('UPDATE tblchartline SET actualvstarget = "'.$actualvstarget.'" WHERE idmeasure = "'.$rowz['idmeasure'].'" AND idview = "'.$idview.'" AND month = "'.$rowz['month'].'" ');
				}
				
				if($rowz['actuallastyear'] == 0){} else 
				{
					// menghitung actual vs actuallastyear
					$hitungactualvslastyear = ($rowz['actual'] / $rowz['actuallastyear']);
					$actualvslastyear = number_format($hitungactualvslastyear,2);
					
					// mengupdate nilai actual vs actuallastyear
					$QUpdateActualvsTarget = $this->db->query('UPDATE tblchartline SET actualvslastyear = "'.$actualvslastyear.'" WHERE idmeasure = "'.$rowz['idmeasure'].'" AND idview = "'.$idview.'" AND month = "'.$rowz['month'].'" ');
				}
				
			}
		}
		
		$this->akumulasiChartLine( $idmeasure , $idview );
		
		//redirect('chart/viewChart/'.$idview.'/'.$idmeasure);
	}
	
	public function akumulasiChartLine( $idmeasure , $idview )
	{
		//$idmeasure = $this->input->post('listmeasure');
		
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;
		
		// cari data dari tblchartline dengan idview = $idview
		$Q = $this->db->query('SELECT * FROM tblchartlineakumulasi WHERE idmeasure ="'.$idmeasure.'" ');
		
		// kosongkan tabel tblchartline dengan idview = $idview
		if($Q->num_rows() >0)
		{
			$Q1 = $this->db->query('DELETE FROM tblchartlineakumulasi WHERE idmeasure ="'.$idmeasure.'" ');
		}
		
		/*
		// input data baru ke dalam tblchartline dengan idview = $idview
		$Q2 = $this->db->query('SELECT tbldetail.`idmeasure`, SUM(tbldetail.`actual`) AS sumactual, SUM(tbldetail.`target`) AS sumtarget, tbldetail.`periodname`  FROM tbldetail  WHERE tbldetail.`year`=YEAR(CURDATE())  AND idmeasure ="'.$idmeasure.'" GROUP BY tbldetail.`idmeasure`, tbldetail.`periodname`  ORDER BY FIELD(periodname,"jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des") ');
		if($Q2->num_rows() > 0){foreach($Q2->result_array() as $row){
			//$data[] = $row;
			$Qinsert = $this->db->query('INSERT INTO tblchartlineakumulasi(idmeasure,month,actual,target) VALUES("'.$row['idmeasure'].'","'.$row['periodname'].'","'.$row['sumactual'].'","'.$row['sumtarget'].'")');
		}}
		*/
		//for( $i = 1 ; $i <13 ; $i++ )
		$arraymonth = array("jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des");
		$actualresult = 0;
		$actualtarget = 0;
		foreach($arraymonth as $rowmonth)
		{
			$Qsum = $this->db->query('SELECT tbldetail.idmeasure, tbldetail.periodname, tbldetail.actual, tbldetail.target, tbldetail.series1, tbldetail.series2, tbldetail.index FROM tbldetail WHERE tbldetail.idmeasure = "'.$idmeasure.'" AND tbldetail.year="'.$years[0]['year'].'" AND tbldetail.idview = "'.$idview.'" AND tbldetail.periodname = "'.$rowmonth.'" LIMIT 1');
			//print ('SELECT tbldetail.idmeasure, tbldetail.periodname, tbldetail.actual, tbldetail.target, tbldetail.series1, tbldetail.series2, tbldetail.index FROM tbldetail WHERE tbldetail.idmeasure = "'.$idmeasure.'" AND tbldetail.year="'.$years[0]['year'].'" AND tbldetail.idview = "'.$idview.'" AND tbldetail.periodname = "'.$rowmonth.'" LIMIT 1');exit;
			if($Qsum->num_rows() > 0){foreach($Qsum->result_array() as $rowresult){
				$actualresult += $rowresult['actual'];
				$targetresult += $rowresult['target'];
				$series1result += $rowresult['series1'];
				$series2result += $rowresult['series2'];
				$Qinsert = $this->db->query('INSERT INTO tblchartlineakumulasi(idmeasure,month,actual,target,series1,series2, `index`) VALUES("'.$rowresult['idmeasure'].'","'.$rowresult['periodname'].'","'.$actualresult.'","'.$targetresult.'","'.$series1result.'","'.$series2result.'", "'.$rowresult['index'].'" )');
			}}
		}
		
		$actualresultlastyear = 0;
		foreach($arraymonth as $rowmonth)
		{
			$Qactuallastyear = $this->db->query('SELECT tbldetail.`idmeasure`, tbldetail.`actual`, tbldetail.`periodname` FROM tbldetail WHERE tbldetail.`year`="'.$yearsmin1.'" AND tbldetail.`idview`="'.$idview.'" AND idmeasure ="'.$idmeasure.'" AND tbldetail.periodname = "'.$rowmonth.'" LIMIT 1 ');
			$actualresultlastyear += $rowresult['actual'];
			$QUpdateActualLastYear = $this->db->query('UPDATE tblchartline SET actuallastyear = "'.$actualresultlastyear.'" WHERE idmeasure = "'.$rowresult['idmeasure'].'" AND idview = "'.$idview.'" AND month = "'.$rowmonth.'" ');
		}
		/*
		// update nilai actual last year
		$Q3 = $this->db->query('SELECT tbldetail.`idmeasure`, SUM(tbldetail.`actual`) AS sumactual, tbldetail.`periodname`  FROM tbldetail WHERE tbldetail.`year`=YEAR(CURDATE())-1  AND idmeasure = "'.$idmeasure.'" GROUP BY tbldetail.`idmeasure`, tbldetail.`periodname`  ORDER BY FIELD(periodname,"jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des") ');
		if($Q3->num_rows() > 0){foreach($Q3->result_array() as $rows){
			$QUpdateActualLastYear = $this->db->query('UPDATE tblchartlineakumulasi SET actuallastyear = "'.$rows['sumactual'].'" WHERE idmeasure = "'.$rows['idmeasure'].'" AND month = "'.$rows['periodname'].'" ');
		}}
		*/
		
		// update nilai actualvstarget
		$Q4 = $this->db->query('SELECT idmeasure, month, actual, target, actuallastyear FROM tblchartlineakumulasi WHERE  idmeasure ="'.$idmeasure.'" ');
		if($Q4->num_rows() > 0)
		{
			foreach($Q4->result_array() as $rowz)
			{
				if($rowz['target'] == 0){} else 
				{
					// mengitung nilai actual vs target
					$hitungactualvstarget = ($rowz['actual'] / $rowz['target']) * 100;
					$actualvstarget = number_format($hitungactualvstarget,2);
					
					// mengupdate nilai actual vs target
					$QUpdateActualvsTarget = $this->db->query('UPDATE tblchartlineakumulasi SET actualvstarget = "'.$actualvstarget.'" WHERE idmeasure = "'.$rowz['idmeasure'].'" AND month = "'.$rowz['month'].'" ');
				}
				
				if($rowz['actuallastyear'] == 0){} else 
				{
					// menghitung actual vs actuallastyear
					$hitungactualvslastyear = ($rowz['actual'] / $rowz['actuallastyear']);
					$actualvslastyear = number_format($hitungactualvslastyear,2);
					
					// mengupdate nilai actual vs actuallastyear
					$QUpdateActualvsTarget = $this->db->query('UPDATE tblchartlineakumulasi SET actualvslastyear = "'.$actualvslastyear.'" WHERE idmeasure = "'.$rowz['idmeasure'].'" AND month = "'.$rowz['month'].'" ');
				}
			}
		}
	}
	
	public function getMeasureChart($idview , $idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT	tblmeasure.`name`,tblchartline.* FROM tblmeasure INNER JOIN tblchartline ON tblmeasure.`idmeasure` = tblchartline.`idmeasure` WHERE tblchartline.`idview` = "'.$idview.'" AND tblchartline.`idmeasure` = "'.$idmeasure.'" ');
		
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getMeasureChartAkumulasi( $idmeasure )
	{
		$data = array();
        $Q = $this->db->query('SELECT	tblmeasure.`name`,tblchartlineakumulasi.* FROM tblmeasure INNER JOIN tblchartlineakumulasi ON tblmeasure.`idmeasure` = tblchartlineakumulasi.`idmeasure` WHERE tblchartlineakumulasi.`idmeasure` = "'.$idmeasure.'" ');
		
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getSeries1( $idmeasure , $iddb )
	{
		$data = array();
		$this->db->where('idmeasure' , $idmeasure);
		$this->db->where('iddb' , $iddb);
		$this->db->where('seriestype' , 'ser1');
        $Q = $this->db->get('tbldataseries');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getSeries2( $idmeasure , $iddb )
	{
		$data = array();
		$this->db->where('idmeasure' , $idmeasure);
		$this->db->where('iddb' , $iddb);
		$this->db->where('seriestype' , 'ser2');
        $Q = $this->db->get('tbldataseries');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getPeriodMonth()
	{
		$data = array();
		$Q = $this->db->query('SELECT month,`year` FROM tblperiod WHERE iddb = "'.$_SESSION['dbuserlogged'] .'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getNumeric($month)
	{
		$data = array();
		//print $month;exit;
		if($month=='Jan'){$data['num']='0';}
		else if($month=='Feb'){$data['num']='1';}
		else if($month=='Mar'){$data['num']='2';}
		else if($month=='Apr'){$data['num']='3';}
		else if($month=='May'){$data['num']='4';}
		else if($month=='Jun'){$data['num']='5';}
		else if($month=='Jul'){$data['num']='6';}
		else if($month=='Aug'){$data['num']='7';}
		else if($month=='Sep'){$data['num']='8';}
		else if($month=='Oct'){$data['num']='9';}
		else if($month=='Nov'){$data['num']='10';}
		else if($month=='Dec'){$data['num']='11';}
		return $data;
	}
}

