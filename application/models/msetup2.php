<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetup2 extends CI_Model
{

	/*
	*	Contructor
	*/
	public function __construct()
    {
        parent::__construct();
    }
	
	public function addUserSecurityMeasure()
	{
		foreach($_POST['namesecuritymeasure'] as $namesecuritymeasureinput)
		{
			$data = array(
				'idsecurity' => rand(111111,999999),
				'iddb' => htmlentities(mysql_real_escape_string($this->input->post('iddb')), ENT_QUOTES),
				'idmeasure' => htmlentities(mysql_real_escape_string($this->input->post('idmeasure')), ENT_QUOTES),
				'idusers' => $namesecuritymeasureinput
			);
			$this->db->insert('tblsecuritymeasure', $data);
		}
		redirect('setup/setSecurityMeasure/'.$this->input->post('idmeasure'));
	}
	
	public function getSelectedUser( $iddb , $idmeasure )
	{
		$data = array();
		
		$Q = $this->db->query('SELECT tblusers.`idusers`, tblusers.`name` , `tblsecuritymeasure`.`view` , `tblsecuritymeasure`.`edit` , `tblsecuritymeasure`.`entry` FROM tblusers INNER JOIN tblsecuritymeasure ON tblusers.`idusers` = tblsecuritymeasure.`idusers` WHERE tblsecuritymeasure.`iddb` = "'.$iddb.'"  AND tblsecuritymeasure.`idmeasure` = "'.$idmeasure.'" AND tblusers.level <> "admin" ');
		
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function grantUserSecurityMeasure()
	{
		$Qcloning = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasureasli = "'.$this->input->post('idmeasure').'" AND iddb = "'.$this->input->post('iddb').'" ');
		
		/* reset view, edit, entry */
		foreach($_POST['view'] as $viewubah)
		{
			$data = array(
				'view' => '0',
				'edit' => '0',
				'entry' => '0'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'view' => '0',
					'edit' => '0',
					'entry' => '0'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
		}
		foreach($_POST['edit'] as $viewubah)
		{
			$data = array(
				'view' => '0',
				'edit' => '0',
				'entry' => '0'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'view' => '0',
					'edit' => '0',
					'entry' => '0'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
		}
		foreach($_POST['entry'] as $viewubah)
		{
			$data = array(
				'view' => '0',
				'edit' => '0',
				'entry' => '0'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'view' => '0',
					'edit' => '0',
					'entry' => '0'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
			
		}
		
		
		/* update nilai field 'view' */
		foreach($_POST['view'] as $viewubah)
		{
			$data = array(
				'view' => '1'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'view' => '1'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
			
		}
		
		/* update nilai field 'edit' */
		foreach($_POST['edit'] as $viewubah)
		{
			$data = array(
				'edit' => '1'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'edit' => '1'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
			
		}
		
		/* update nilai field 'entry' */
		foreach($_POST['entry'] as $viewubah)
		{
			$data = array(
				'entry' => '1'
			);
			$this->db->where('iddb', $this->input->post('iddb'));
			$this->db->where('idmeasure', $this->input->post('idmeasure'));
			$this->db->where('idusers', $viewubah);
			$this->db->update('tblsecuritymeasure', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'entry' => '1'
				);
				$this->db->where('iddb', $row['iddb']);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idusers', $viewubah);
				$this->db->update('tblsecuritymeasure', $dataclon);	
			}}
			
		}
		
		redirect('setup/setSecurityMeasure/'.$this->input->post('idmeasure'));
	}
	
	public function delSecurityMeasure()
	{
		$iddb = $this->input->post('iddb');
		$idmeasure = $this->input->post('idmeasure');
		$idusers = $this->input->post('idusers');
		
		$this->db->where('iddb', $iddb);
		$this->db->where('idmeasure', $idmeasure);
		$this->db->where('idusers', $idusers);
		$this->db->delete('tblsecuritymeasure');
		
		$Qcloning = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasureasli = "'.$idmeasure.'" AND iddb = "'.$iddb.'" ');

		if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
			$this->db->where('iddb', $row['iddb']);
			$this->db->where('idmeasure', $row['idmeasurecloning']);
			$this->db->where('idusers', $idusers);
			$this->db->delete('tblsecuritymeasure');
		}}
		
		redirect('setup/setSecurityMeasure/'.$this->input->post('idmeasure'));
	}
	
	public function savedataseries()
	{
		$this->db->where( 'idmeasure' , $this->input->post('idmeasure') );
		$this->db->where( 'iddb' , $this->input->post('iddb') );
		$Q = $this->db->get('tbldataseries');
		
		if($Q->num_rows() < 1) { $seriestype = 'ser1'; } else { $seriestype = 'ser2'; }
		
		if($Q->num_rows() >= 2) 
		{
			$this->session->set_flashdata('Error', 'Maximum data series is 2 record!');
		} else 
		{
			$data = array(
				'iddataseries' => rand(111111,999999),
				'idmeasure' =>  htmlentities(mysql_real_escape_string($this->input->post('idmeasure')), ENT_QUOTES),
				'iddb' =>  htmlentities(mysql_real_escape_string($this->input->post('iddb')), ENT_QUOTES),
				'name' =>  htmlentities(mysql_real_escape_string($this->input->post('seriesname')), ENT_QUOTES),
				'desc' =>  htmlentities(mysql_real_escape_string($this->input->post('descriptionseries')), ENT_QUOTES),
				'storageperiod' => htmlentities(mysql_real_escape_string($this->input->post('storageperiod')), ENT_QUOTES),
				'unittype' => htmlentities(mysql_real_escape_string($this->input->post('unittype')), ENT_QUOTES),
				'seriestype' => $seriestype
			);
			$this->db->insert('tbldataseries', $data);
		}
		redirect('setup/customSeries/'.$this->input->post('idmeasure'));
	}
	
	public function getListDataSeries( $idmeasure , $iddb )
	{
		$data = array();
		$Q = $this->db->query('SELECT tbldataseries.* , tblunittype.`name` AS unitname FROM `tbldataseries` INNER JOIN tblunittype ON tbldataseries.`unittype` = tblunittype.`idunittype` WHERE tbldataseries.idmeasure = "'.$idmeasure.'" AND tbldataseries.iddb = "'.$iddb.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getDataSeriesById( $iddataseries )
	{
		$data = array();
		$this->db->where( 'iddataseries', $iddataseries );
		$Q = $this->db->get('tbldataseries');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function updateSataSeries()
	{
		$data = array(
			'name' =>  htmlentities(mysql_real_escape_string($this->input->post('seriesname')), ENT_QUOTES),
			'desc' =>  htmlentities(mysql_real_escape_string($this->input->post('descriptionseries')), ENT_QUOTES)
		);
		
		$this->db->where('iddataseries', $this->input->post('iddataseries') );
		$this->db->update('tbldataseries', $data);	
		
		redirect('setup/customSeries/'.$this->input->post('idmeasure'));
	}
	
	public function deleteDataSeries( $iddataseries, $idmeasure )
	{
		$this->db->where('iddataseries', $iddataseries );
		$this->db->delete('tbldataseries');	
		
		redirect('setup/customSeries/'.$idmeasure);
	}

	public function companyConfig()
	{
		$Q = $this->db->get('tblcompanyconfig');
        if($Q->num_rows() > 0){		
			$dataU = array(
				'idcompany' => htmlentities(mysql_real_escape_string($this->input->post('idcompany')), ENT_QUOTES),
				'maxdb' => htmlentities(mysql_real_escape_string($this->input->post('dbmax')), ENT_QUOTES),
				'maxuser' => htmlentities(mysql_real_escape_string($this->input->post('usermax')), ENT_QUOTES)
			);
			$this->db->update('tblcompanyconfig', $dataU);
		} else {		
			$dataI = array(
				'idcompany' => htmlentities(mysql_real_escape_string($this->input->post('idcompany')), ENT_QUOTES),
				'maxdb' => htmlentities(mysql_real_escape_string($this->input->post('dbmax')), ENT_QUOTES),
				'maxuser' => htmlentities(mysql_real_escape_string($this->input->post('usermax')), ENT_QUOTES)
			);
			$this->db->insert('tblcompanyconfig', $dataI);
		}
		redirect('maincontroller/setupCompany');
	}
	
	public function getCompanyConfig()
	{
		$data = array();
		$Q = $this->db->get('tblcompanyconfig');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function searchMeasure( $term )
	{
		$a_json = array();
		$data = array();
		$Q = $this->db->query('SELECT idmeasure, name FROM tblmeasure WHERE name like "'.$term.'%"');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			//$data['id'] = $row['idmeasure'];
			//$data['value'] = $row['name'];
			$data['label'] = $row['name'];
			array_push($a_json, $data);
		}}
        return $a_json;
	}

	public function deldb()
	{
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tbldatabase');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblmeasure');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tbldetail');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblhirarkikpi');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblassigndb');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblassignview');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblcloningmeasure');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tbldataseries');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblmeasuregranttouser');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblperformanceranges');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblperiod');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblsecuritymeasure');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblviews');
		
		$this->db->where('iddb', $this->uri->segment(3) );
		$this->db->delete('tblweight');
	}
	
	public function savereport()
	{
		$data = array(
			'idreport' => rand(111111,999999),
			'namereport' => htmlentities(mysql_real_escape_string($this->input->post('reportname')), ENT_QUOTES),
			'descreport' => htmlentities(mysql_real_escape_string($this->input->post('reportdescription')), ENT_QUOTES),
			'periodname' => htmlentities(mysql_real_escape_string($this->input->post('month')), ENT_QUOTES),
			'year' => htmlentities(mysql_real_escape_string($this->input->post('year')), ENT_QUOTES),
			'iddb' => $_SESSION['dbuserlogged'],
			'idusers' => $_SESSION['iduserlogged']
		);
		$this->db->insert('tblreport', $data);
		
		redirect('maincontroller/setupreport');
	}
	
	public function getListReport( $iddb )
	{
		$data = array();
		$this->db->where( 'iddb', $iddb );
		$Q = $this->db->get( 'tblreport' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function listmeasurereport( $iddb )
	{
		$data = array();
		$Q = $this->db->query( 'SELECT tblmeasure.`idmeasure` , tblmeasure.`name` FROM tblmeasure WHERE cloning IS NULL ORDER BY tblmeasure.`name`' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getselectedmeasurereport( $iddb, $idreport )
	{
		$data = array();
		$Q = $this->db->query( 'SELECT tblmeasure.`idmeasure` , tblmeasure.`name`, tbldetailreport.idreport FROM tblmeasure INNER JOIN tbldetailreport ON tblmeasure.`idmeasure` = tbldetailreport.`idmeasure` WHERE tbldetailreport.`idreport` = "'.$idreport.'" AND tbldetailreport.iddb = "'.$iddb.'" ORDER BY tblmeasure.`name` ' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function addSelectedMeasureReport()
	{
		foreach($_POST['measurereport'] as $measurereportinput)
		{
			$data = array(
				'iddetailreport' => rand(111111,999999),
				'idreport' => htmlentities(mysql_real_escape_string($this->input->post('idreport')), ENT_QUOTES),
				'idmeasure' => $measurereportinput,
				'iddb' => $_SESSION['dbuserlogged']
			);
			$this->db->insert('tbldetailreport', $data);
		}
		redirect('setup/addmeasuresreport/'.$this->input->post('idreport'));
	}
	
	public function getdetailreport( $idreport , $periodname )
	{
		$data = array();
		$Q = $this->db->query( 'SELECT tblmeasure.name, tblchartline.`actual` , `tblchartline`.`target`, tblchartline.`actuallastyear` FROM `tblmeasure` INNER JOIN tblchartline ON tblmeasure.`idmeasure` = tblchartline.`idmeasure` WHERE tblchartline.idmeasure IN ( SELECT tbldetailreport.idmeasure FROM tbldetailreport WHERE idreport="'.$idreport.'" ) AND tblchartline.`month` = "'.$periodname.'" ' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getwarna( $iddb )
	{
		$data = array();
		$this->db->where( 'iddb', $iddb );
		$Q = $this->db->get( 'tblperformanceranges' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getinforeport( $idreport )
	{
		$data = array();
		$this->db->where( 'idreport', $idreport );
		$Q = $this->db->get( 'tblreport' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function delmeasurereport($idmeasure, $idreport)
	{
		$this->db->where('idmeasure', $idmeasure);
		$this->db->where('idreport', $idreport);
		$this->db->delete('tbldetailreport');
	}
	
	public function updatereport()
	{
		$data = array(
			'namereport' => htmlentities(mysql_real_escape_string($this->input->post('reportname')), ENT_QUOTES),
			'descreport' => htmlentities(mysql_real_escape_string($this->input->post('reportdescription')), ENT_QUOTES),
			'periodname' => htmlentities(mysql_real_escape_string($this->input->post('month')), ENT_QUOTES),
			'year' => htmlentities(mysql_real_escape_string($this->input->post('year')), ENT_QUOTES),
			'iddb' => $_SESSION['dbuserlogged'],
			'idusers' => $_SESSION['iduserlogged']
		);
		$this->db->where('idreport', $this->input->post('idreport'));
		$this->db->update('tblreport', $data);
		
		redirect('maincontroller/setupreport');
	}
	
	public function deletereport( $idreport )
	{
		$this->db->where('idreport', $idreport);
		$this->db->delete('tblreport');
		
		redirect('maincontroller/setupreport');
	}
	
	public function getperawalakhir()
	{
		$data = array();
		$this->db->select('startyear');
		$this->db->select('endyear');
		$this->db->where( 'iddb', $_SESSION['dbuserlogged'] );
		$Q = $this->db->get( 'tbldatabase' );
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function savesinkronisasi()
	{
		$Qexists = $this->db->query( 'SELECT year FROM tbldetail WHERE year = "'.$this->input->post('akhir').'" ' );
		if($Qexists->num_rows() > 0) {
			$this->db->query( 'DELETE FROM tbldetail WHERE year = "'.$this->input->post('akhir').'" AND iddb = "'.$_SESSION['dbuserlogged'].'" ' );
		}
		
		$Q = $this->db->query( 'SELECT * FROM tbldetail WHERE year = "'.$this->input->post('awal').'" AND iddb = "'.$_SESSION['dbuserlogged'].'" ' );
		
		if($Q->num_rows() > 0)
		{
			foreach($Q->result_array() as $row)
			{
				$data = array(
					'iddetail' => rand(111111,999999),
					'iddb' => $row['iddb'],
					'idview' => $row['idview'],
					'idmeasure' => $row['idmeasure'],
					'parent' => $row['parent'],
					'storageperiod' => $row['storageperiod'],
					'periodname' => $row['periodname'],
					'year' => $this->input->post('akhir'),
					'actual' => '0',
					'target' => '0',
					'targetvariance' => '0',
					'index' => '0',
					'weight' => '0',
					'series1' => '0',
					'series1variance' => '0',
					'series1index' => '0',
					'series2' => '0',
					'series2variance' => '0',
					'series2index' => '0',
					'owner' => $row['owner']
				);
				$this->db->insert('tbldetail', $data);
			}
		}
		
		redirect('maincontroller/setupdatabase');
	}
	
	public function accesssetup()
	{
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$data = array(
			'accesssetup' => 'signed'
		);
		$this->db->where('iddb' , $iddb);
		$this->db->where('idusers' , $idusers);
		$this->db->update('tblassigndb', $data);
		redirect('maincontroller/assignusersdb/'.$iddb);
	}
	
	public function remaccesssetup()
	{
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$data = array(
			'accesssetup' => 'unsigned'
		);
		$this->db->where('iddb' , $iddb);
		$this->db->where('idusers' , $idusers);
		$this->db->update('tblassigndb', $data);
		redirect('maincontroller/assignusersdb/'.$iddb);
	}
}

