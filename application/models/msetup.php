<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetup extends CI_Model
{
	public $var1;
	public $peruse;
	/*
	*	Contructor
	*/
	public function __construct()
    {
        parent::__construct();
    }
	
	
	/*------------------------------------------------------------------------------------------------------------------
	*	Measure
	*/
	public function getAllMeasures()
	{
		$data = array();
		/*
		$Qcreatevu = $this->db->query('CREATE VIEW vu AS SELECT tblmeasuregranttouser.* FROM tblmeasuregranttouser WHERE tblmeasuregranttouser.`idusers` = '.$_SESSION['iduserlogged']);

		$Q = $this->db->query('SELECT distinct `tblmeasure`.* , vu.`accessmodifier` FROM `tblmeasure` LEFT JOIN vu ON tblmeasure.`idmeasure` = vu.`idmeasure` WHERE tblmeasure.iddb = "'.$_SESSION['dbuserlogged'].'" ORDER BY tblmeasure.name');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
		
		$Qdropvu = $this->db->query('DROP VIEW vu');
		
        return $data;
		*/
		
		$Q = $this->db->query('SELECT DISTINCT tblmeasure.`idmeasure` , tblmeasure.`name` , tblmeasure.`type`, tblmeasure.`storageperiod`, tblsecuritymeasure.`view`, tblsecuritymeasure.`edit`, tblsecuritymeasure.`entry` FROM tblmeasure INNER JOIN tblsecuritymeasure  ON tblmeasure.`idmeasure` = tblsecuritymeasure.`idmeasure` AND tblmeasure.`iddb` = tblsecuritymeasure.`iddb` WHERE tblsecuritymeasure.`idusers` = "'.$_SESSION['iduserlogged'].'" AND tblsecuritymeasure.`iddb` = "'.$_SESSION['dbuserlogged'].'" AND tblsecuritymeasure.`view` = "1" AND tblmeasure.cloning IS NULL ORDER BY tblmeasure.`name` ASC ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getAllMeasuresKeyword($searchMeasureKeyword)
	{
		$data = array();
		$Q = $this->db->query('SELECT DISTINCT tblmeasure.`idmeasure` , tblmeasure.`name` , tblmeasure.`type`, tblmeasure.`storageperiod`, tblsecuritymeasure.`view`, tblsecuritymeasure.`edit`, tblsecuritymeasure.`entry` FROM tblmeasure INNER JOIN tblsecuritymeasure  ON tblmeasure.`idmeasure` = tblsecuritymeasure.`idmeasure` AND tblmeasure.`iddb` = tblsecuritymeasure.`iddb` WHERE tblsecuritymeasure.`idusers` = "'.$_SESSION['iduserlogged'].'" AND tblsecuritymeasure.`iddb` = "'.$_SESSION['dbuserlogged'].'" AND tblsecuritymeasure.`view` = "1" AND tblmeasure.`name` like "%'.$searchMeasureKeyword.'%" AND tblmeasure.cloning IS NULL ORDER BY tblmeasure.`name` ASC  ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getmeasurebyid($idmeasure)
	{
		$data = array();
		$this->db->where('idmeasure', $idmeasure); 
        $Q = $this->db->get('tblmeasure');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getlistmeasure($idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT idmeasure, name, iddb FROM tblmeasure WHERE idmeasure <> "'.$idmeasure.'" AND cloning IS NULL ORDER BY name ASC ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getmeasurename($idmeasure)
	{
		$data = array();
		$this->db->where('idmeasure', $idmeasure); 
        $Q = $this->db->get('tblmeasure');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function terdaftardiview($idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT COUNT(`idmeasure`) AS jmlmeasure FROM tblhirarkikpi WHERE idmeasure = "'.$idmeasure.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function savemeasure()
	{
		$idmeasure = rand(111111,999999);
		$data = array(
			'idmeasure' => $idmeasure,
			'iddb' => $_SESSION['dbuserlogged'],
			'name' => htmlentities(mysql_real_escape_string($this->input->post('measurename')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('measuredescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('measurecategories')), ENT_QUOTES),
			'type'    => htmlentities(mysql_real_escape_string($this->input->post('measuretype')), ENT_QUOTES),
			'critical'    => htmlentities(mysql_real_escape_string($this->input->post('critical')), ENT_QUOTES),
			//'parentmeasure'    => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
			'polarity'    => htmlentities(mysql_real_escape_string($this->input->post('measurepolarity')), ENT_QUOTES),
			'storageperiod'    => htmlentities(mysql_real_escape_string($this->input->post('storageperiod')), ENT_QUOTES),
			'unittype'    => htmlentities(mysql_real_escape_string($this->input->post('unittype')), ENT_QUOTES),
			'defaultowner'    => htmlentities(mysql_real_escape_string($this->input->post('owner')), ENT_QUOTES),
			'consolidationfunctions'    => htmlentities(mysql_real_escape_string($this->input->post('consf')), ENT_QUOTES),
			'notes'    => htmlentities(mysql_real_escape_string($this->input->post('measurenotes')), ENT_QUOTES),
			'location'    => htmlentities(mysql_real_escape_string($this->input->post('location')), ENT_QUOTES)
		);
		$this->db->insert('tblmeasure', $data);
			
		/* do proses insert pada tblmeasuregranttouser sebagai hak akses user pada measure */
		$datagrant = array(
			'idgrant' => rand(111111,999999),
			'iddb' => $_SESSION['dbuserlogged'],
		//	'idview' => $idview,
			'idmeasure' => $idmeasure,
			'idusers' => $_SESSION['iduserlogged'],
			'accessmodifier' => 'rw'
		);
		$this->db->insert('tblmeasuregranttouser', $datagrant);
	
		/* insert into tblsecurity measure for grant access to admin */
		$datagrantadmin = array(
			'idsecurity' => rand(111111,999999),
			'iddb' => $_SESSION['dbuserlogged'],
			'idmeasure' => $idmeasure,
			'idusers' => '190890',
			'view' => '1',
			'edit' => '1',
			'entry' => '1'
		);
		$this->db->insert('tblsecuritymeasure', $datagrantadmin);
		
		redirect('maincontroller/setupmeasure');
		/*
		$datahirarki = array(
			'idmeasure' => $idmeasure,
			'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
			'data' => '0'
		);
		$this->db->insert('tblhirarkikpi', $datahirarki);
		
		$datadetail = array(
			'idmeasure' => $idmeasure,
			'actual' => rand(0,200),
			'target' => rand(0,200),
			'index' => rand(0,200),
			'weight' => rand(0,200)
		);
		$this->db->insert('tbldetail', $datadetail);
		*/
		
	}
	
	public function updatetbldetail( $fstorage , $nstorage , $idmeasure )
	{
		if( $fstorage == 'quarter' && $nstorage == 'month' )
		{
			$storageperiod = array('Q1' , 'Q2' , 'Q3' , 'Q4');
			$storageperiodname = 'quarter';
		}
		else if( $fstorage == 'week' && $nstorage == 'month' )
		{
			$storageperiod = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
			$storageperiodname = 'week';
		}
		else if( $fstorage == 'month' && $nstorage == 'quarter' )
		{
			$storageperiod = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
			$storageperiodname = 'month';
		}
		else if( $fstorage == 'week' && $nstorage == 'quarter' )
		{
			$storageperiod = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
			$storageperiodname = 'week';
		}
		else if( $fstorage == 'month' && $nstorage == 'week' )
		{
			$storageperiod = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
			$storageperiodname = 'month';
		}
		else if( $fstorage == 'quarter' && $nstorage == 'week' )
		{
			$storageperiod = array('Q1' , 'Q2' , 'Q3' , 'Q4');
			$storageperiodname = 'quarter';
		}
			
		/* insert baru dengan storage period tipe baru */
		$Qtbldetail = $this->db->query('SELECT * FROM tbldetail WHERE idmeasure = "'.$idmeasure.'" LIMIT 1');
		if($Qtbldetail->num_rows() > 0){foreach($Qtbldetail->result_array() as $row){
			$storageperiodawal = $row['storageperiod']; 
			foreach($storageperiod as $k => $v){
			
				$data = array(
					'iddetail' => rand(111111,999999),
					'iddb' => $row['iddb'],
					'idview' => $row['idview'],
					'idmeasure' => $row['idmeasure'],
					'parent' => $row['parent'],
					'storageperiod' => $storageperiodname,
					'periodname' => $v,
					'year' => $row['year'],
					'actual' => '',
					'target' => '',
					'targetvariance' => '',
					'index' => '',
					'weight' => '',
					'series1' => '',
					'series1variance' => '',
					'series1index' => '',
					'series2' => '',
					'series2variance' => '',
					'series2index' => '',
					'owner' => ''
				);
				$this->db->insert('tbldetail', $data);		
			}
		}}
		
		/* hapus dari tbldetail dengan tipe storageperiod yang lama */
		$this->db->query('DELETE FROM tbldetail WHERE idmeasure = "'.$idmeasure.'" AND storageperiod = "'.$storageperiodawal.'" ');
		
		$this->db->query('UPDATE tbldetail SET actual = NULL,target = NULL,targetvariance = NULL,`index` = NULL,weight = NULL,series1 = NULL,series1variance = NULL,series1index = NULL,series2 = NULL,series2variance = NULL,series2index = NULL, OWNER = NULL WHERE idmeasure = "'.$idmeasure.'" ');
	}
	
	public function editmeasure()
	{
		$idmeasure = htmlentities(mysql_real_escape_string($this->input->post('idmeasure')), ENT_QUOTES);
		
		$Qcloning = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasureasli = "'.$idmeasure.'" ');
		
		$Qtipestorageperiod = $this->db->query( 'SELECT storageperiod FROM tbldetail WHERE idmeasure = "'.$idmeasure.'" LIMIT 1' );
		if($Qtipestorageperiod->num_rows() > 0){foreach($Qtipestorageperiod->result_array() as $row){
			$sp = $row['storageperiod']; }}
		
		/* proses perubahan tipe measure dari month ke quarter */
		if( $this->input->post('storageperiod')=='quarter' && $sp='month' ) { $this->updatetbldetail( 'quarter' , 'month', $idmeasure); }
		
		/* proses perubahan tipe measure dari month ke week */
		else if( $this->input->post('storageperiod')=='week' && $sp='month' ) { $this->updatetbldetail( 'week' , 'month', $idmeasure); }
		
		/* proses perubahan tipe measure dari quarter ke month */
		else if( $this->input->post('storageperiod')=='month' && $sp='quarter' ) { $this->updatetbldetail( 'month' , 'quarter', $idmeasure); }
		
		/* proses perubahan tipe measure dari quarter ke week */
		else if( $this->input->post('storageperiod')=='week' && $sp='quarter' ) { $this->updatetbldetail( 'week' , 'quarter', $idmeasure); }
		
		/* proses perubahan tipe measure dari week ke month */
		else if( $this->input->post('storageperiod')=='month' && $sp='week' ) { $this->updatetbldetail( 'month' , 'week', $idmeasure); }
		
		/* proses perubahan tipe measure dari week ke quarter */
		else if( $this->input->post('storageperiod')=='quarter' && $sp='week' ) { $this->updatetbldetail( 'quarter' , 'week', $idmeasure); }
		
		$data = array(
			
			'name' => htmlentities(mysql_real_escape_string($this->input->post('measurename')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('measuredescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('measurecategories')), ENT_QUOTES),
			'type'    => htmlentities(mysql_real_escape_string($this->input->post('measuretype')), ENT_QUOTES),
			'critical'    => htmlentities(mysql_real_escape_string($this->input->post('critical')), ENT_QUOTES),
			//'parentmeasure'    => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
			'polarity'    => htmlentities(mysql_real_escape_string($this->input->post('measurepolarity')), ENT_QUOTES),
			'storageperiod'    => htmlentities(mysql_real_escape_string($this->input->post('storageperiod')), ENT_QUOTES),
			'unittype'    => htmlentities(mysql_real_escape_string($this->input->post('unittype')), ENT_QUOTES),
			'defaultowner'    => htmlentities(mysql_real_escape_string($this->input->post('owner')), ENT_QUOTES),
			'consolidationfunctions'    => htmlentities(mysql_real_escape_string($this->input->post('consf')), ENT_QUOTES),
			'notes'    => htmlentities(mysql_real_escape_string($this->input->post('measurenotes')), ENT_QUOTES),
			'location'    => htmlentities(mysql_real_escape_string($this->input->post('location')), ENT_QUOTES)
		);
		//print_r($data);exit;
		$this->db->where('idmeasure',$idmeasure);
		$this->db->update('tblmeasure', $data);
		
		/* jika perubahan measure type menjadi group atau formula maka update nilai actual,target,index menjadi 0, karena perhitungannya berbeda dan tidak bisa diinput */
		if( $this->input->post('measuretype')=='group' || $this->input->post('measuretype')=='formula' )
		{
			$data = array(
				'actual' => 0,
				'target' => 0,
				'index' => 0
			);
			$this->db->where('idmeasure', $idmeasure);
			$this->db->update('tbldetail', $data);	
		}
		
		/* handle data changed on cloning measure */
		if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
			$data = array(
				
				'name' => htmlentities(mysql_real_escape_string($this->input->post('measurename')), ENT_QUOTES),
				'description'  => htmlentities(mysql_real_escape_string($this->input->post('measuredescription')), ENT_QUOTES),
				'categories' => htmlentities(mysql_real_escape_string($this->input->post('measurecategories')), ENT_QUOTES),
				'type'    => htmlentities(mysql_real_escape_string($this->input->post('measuretype')), ENT_QUOTES),
				'critical'    => htmlentities(mysql_real_escape_string($this->input->post('critical')), ENT_QUOTES),
				//'parentmeasure'    => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
				'polarity'    => htmlentities(mysql_real_escape_string($this->input->post('measurepolarity')), ENT_QUOTES),
				'storageperiod'    => htmlentities(mysql_real_escape_string($this->input->post('storageperiod')), ENT_QUOTES),
				'unittype'    => htmlentities(mysql_real_escape_string($this->input->post('unittype')), ENT_QUOTES),
				'defaultowner'    => htmlentities(mysql_real_escape_string($this->input->post('owner')), ENT_QUOTES),
				'consolidationfunctions'    => htmlentities(mysql_real_escape_string($this->input->post('consf')), ENT_QUOTES),
				'notes'    => htmlentities(mysql_real_escape_string($this->input->post('measurenotes')), ENT_QUOTES),
				'location'    => htmlentities(mysql_real_escape_string($this->input->post('location')), ENT_QUOTES)
			);
			//print_r($data);exit;
			$this->db->where('idmeasure',$row['idmeasurecloning']);
			$this->db->update('tblmeasure', $data);
			
			/* jika perubahan measure type menjadi group atau formula maka update nilai actual,target,index menjadi 0, karena perhitungannya berbeda dan tidak bisa diinput */
			if( $this->input->post('measuretype')=='group' || $this->input->post('measuretype')=='formula' )
			{
				$data = array(
					'actual' => 0,
					'target' => 0,
					'index' => 0
				);
				$this->db->where('idmeasure',$row['idmeasurecloning']);
				$this->db->update('tbldetail', $data);	
			}
		}}

		redirect('maincontroller/setupmeasure');
	}
	
	public function deleterecursive($idmeasure)
	{
		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasure.'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
		
			$idmeasurechildlevel1 = $row['idmeasure'];
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->delete('tblhirarkikpi');

			/* delete from tbldetail */
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->delete('tbldetail');
			
			/* delete from tblweight	 */
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->delete('tblweight');
			
			$this->deleterecursive($idmeasurechildlevel1);
		}}
	}
	
	public function deletemeasure($idmeasure)
	{
		/* delete from tblmeasure */
		$this->db->where('idmeasure', $idmeasure);
		$this->db->delete('tblmeasure');
		
		/* delete from tblhirarkikpi */
		$this->db->where('idmeasure', $idmeasure);
		$this->db->delete('tblhirarkikpi');
		
		/* delete from tbldetail */
		$this->db->where('idmeasure', $idmeasure);
		$this->db->delete('tbldetail');
		
		/* delete turunan measurenya */
		$this->deleterecursive($idmeasure);
		
		/* delete from tbldetail */
		$this->db->where('idmeasure', $idmeasure);
		$this->db->delete('tblmeasuregranttouser');
		
		$this->db->where('idmeasure', $idmeasure);
		$this->db->delete('tblsecuritymeasure');
		/* hapus turunan level 1 
		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasure.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$idmeasurechildlevel1 = $row['idmeasure'];
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->delete('tblhirarkikpi');

			/* delete from tbldetail 
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->delete('tbldetail');
			
			/* hapus turunan level 2 
			$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel1.'" ');
			if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
				$idmeasurechildlevel2 = $row['idmeasure'];
				$this->db->where('idmeasure', $idmeasurechildlevel2);
				$this->db->delete('tblhirarkikpi');
				
				/* delete from tbldetail 
				$this->db->where('idmeasure', $idmeasurechildlevel2);
				$this->db->delete('tbldetail');
			
				/* hapus turunan level 3 
				$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel2.'" ');
				if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
					$idmeasurechildlevel3 = $row['idmeasure'];
					$this->db->where('idmeasure', $idmeasurechildlevel3);
					$this->db->delete('tblhirarkikpi');
						
					/* delete from tbldetail 
					$this->db->where('idmeasure', $idmeasurechildlevel3);
					$this->db->delete('tbldetail');
				
					/* hapus turunan level 4
					$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel3.'" ');
					if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
						$idmeasurechildlevel4 = $row['idmeasure'];
						$this->db->where('idmeasure', $idmeasurechildlevel4);
						$this->db->delete('tblhirarkikpi');
							
						/* delete from tbldetail 
						$this->db->where('idmeasure', $idmeasurechildlevel4);
						$this->db->delete('tbldetail');
					
						/* hapus turunan level 5 
						$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel4.'" ');
						if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
							$idmeasurechildlevel5 = $row['idmeasure'];
							$this->db->where('idmeasure', $idmeasurechildlevel5);
							$this->db->delete('tblhirarkikpi');
						
							/* delete from tbldetail 
							$this->db->where('idmeasure', $idmeasurechildlevel5);
							$this->db->delete('tbldetail');
						
							/* hapus turunan level 6 
							$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel5.'" ');
							if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
								$idmeasurechildlevel6 = $row['idmeasure'];
								$this->db->where('idmeasure', $idmeasurechildlevel6);
								$this->db->delete('tblhirarkikpi');
									
								/* delete from tbldetail 
								$this->db->where('idmeasure', $idmeasurechildlevel6);
								$this->db->delete('tbldetail');
							
								/* hapus turunan level 7 
								$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasurechildlevel6.'" ');
								if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
									$idmeasurechildlevel7 = $row['idmeasure'];
									$this->db->where('idmeasure', $idmeasurechildlevel7);
									$this->db->delete('tblhirarkikpi');
								
									/* delete from tbldetail 
									$this->db->where('idmeasure', $idmeasurechildlevel7);
									$this->db->delete('tbldetail');
								}}
							}}
						}}
					}}
				}}
			}}
		}}
		*/
		redirect('maincontroller/setupmeasure');
	}
	
	public function duplicatemeasure($idmeasure)
	{
		$idmeasurenew = rand(111111,999999);
		
		$data = array();
		$this->db->where('idmeasure', $idmeasure);
        $Q = $this->db->get('tblmeasure');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			
			// create copy measure 
			$data = array(
				'idmeasure' => $idmeasurenew,
				'iddb' => $row['iddb'],
				'name' => 'Copy '.$row['name'],
				'description'  => $row['description'],
				'categories' => $row['categories'],
				'type'    => $row['type'],
				'critical'    => $row['critical'],
				//'parentmeasure'    => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
				'polarity'    => $row['polarity'],
				'storageperiod'    => $row['storageperiod'],
				'unittype'    => $row['unittype'],
				'defaultowner'    => $row['defaultowner'],
				'consolidationfunctions'    => $row['consolidationfunctions'],
				'notes'    => $row['notes'],
				'location'    => $row['location']
			);
			$this->db->insert('tblmeasure', $data);
			
			/* ambil nilai hak akses dari measure lama */
			$Qmeasureonsecurity = $this->db->query('SELECT view, edit, entry from tblsecuritymeasure WHERE idmeasure = "'.$idmeasure.'" AND iddb = "'.$row['iddb'].'" AND idusers = "'.$_SESSION['iduserlogged'].'" LIMIT 1 ');
			if($Qmeasureonsecurity->num_rows() > 0){foreach($Qmeasureonsecurity->result_array() as $rowmeasureonsecurity){
				$view = $rowmeasureonsecurity['view'];
				$edit = $rowmeasureonsecurity['edit'];
				$entry = $rowmeasureonsecurity['entry'];
			}}
			
			/* insert into tblsecurity measure */
			$datasecurity = array(
				'idsecurity' => rand(111111,999999),
				'iddb' => $row['iddb'],
				'idmeasure' => $idmeasurenew,
				'idusers' => $_SESSION['iduserlogged'],
				'view' => $view,
				'edit' => $edit,
				'entry' => $entry
			);
			$this->db->insert('tblsecuritymeasure', $datasecurity);
			
		}}
		
		
		
		// dicari berdasarkan iduser yang ada di tblassignview
		// diambil idviewnya dan dilooping jika lebih dari satu
		// diambil idview dan iddb
		// idmeasure udah ada iduser diambil dari session iduser
		
		$Qx1 = $this->db->query('SELECT * from tblassignview WHERE idusers = '. $_SESSION['iduserlogged']);
		
		if($Qx1->num_rows() > 0){foreach($Qx1->result_array() as $rowx1){
			//$idviewx1 = $rowx1['idviews'];
			$iddbx1 = $rowx1['iddb'];
			
			$QExists = $this->db->query('SELECT idmeasure FROM tblmeasuregranttouser WHERE iddb = "'.$iddbx1.'" AND idusers = "'.$_SESSION['iduserlogged'].'" AND idmeasure = "'.$idmeasurenew.'"');
			if($QExists->num_rows() > 0){ continue; }

			/* do proses insert pada tblmeasuregranttouser sebagai hak akses user pada measure */
			$datagrant = array(
				'idgrant' => rand(111111,999999),
				'iddb' => $iddbx1,
				//'idview' => $idviewx1,
				'idmeasure' => $idmeasurenew,
				'idusers' => $_SESSION['iduserlogged'],
				'accessmodifier' => 'rw'
			);
			$this->db->insert('tblmeasuregranttouser', $datagrant);
			}
		}
		
		redirect('maincontroller/setupmeasure');
	}
	
	public function record_count() {
        return $this->db->count_all("tblmeasure");
    }
	/*~ end measure */
	
	
	/*------------------------------------------------------------------------------------------------------------------
	*	Unit Type
	*/
	public function getAllUnitType()
	{
		$data = array();
        $Q = $this->db->get('tblunittype');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getunittypebyid($idunittype)
	{
		$data = array();
		$this->db->where('idunittype', $idunittype);
        $Q = $this->db->get('tblunittype');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function saveunittype()
	{
		$data = array(
			'idunittype' => rand(111111,999999),
			'name' => htmlentities(mysql_real_escape_string($this->input->post('unitname')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('unitdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('unitcategories')), ENT_QUOTES),
			'prefix'    => htmlentities(mysql_real_escape_string($this->input->post('unitprefix')), ENT_QUOTES),
			'suffix'    => htmlentities(mysql_real_escape_string($this->input->post('unitsuffix')), ENT_QUOTES),
			'numberdigit' => htmlentities(mysql_real_escape_string($this->input->post('numberdigits')), ENT_QUOTES),
			'decimalplace' => htmlentities(mysql_real_escape_string($this->input->post('decimalplaces')), ENT_QUOTES)
		);

		$this->db->insert('tblunittype', $data);
		redirect('maincontroller/setupunittype');
	}
	
	public function editunittype()
	{
		$idunittype = htmlentities(mysql_real_escape_string($this->input->post('idunittype')), ENT_QUOTES);
		$data = array(
			
			'name' => htmlentities(mysql_real_escape_string($this->input->post('unitname')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('unitdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('unitcategories')), ENT_QUOTES),
			'prefix'    => htmlentities(mysql_real_escape_string($this->input->post('unitprefix')), ENT_QUOTES),
			'suffix'    => htmlentities(mysql_real_escape_string($this->input->post('unitsuffix')), ENT_QUOTES),
			'numberdigit' => htmlentities(mysql_real_escape_string($this->input->post('numberdigits')), ENT_QUOTES),
			'decimalplace' => htmlentities(mysql_real_escape_string($this->input->post('decimalplaces')), ENT_QUOTES)
		);

		$this->db->where('idunittype', $idunittype);
		$this->db->update('tblunittype', $data);
		redirect('maincontroller/setupunittype');
	}
	/*~ end unit type */
	
	
	/*------------------------------------------------------------------------------------------------------------------
	*	Users
	*/
	public function getAllUsers($userlevel)
	{
		if($userlevel == 'admin') {
			$data = array();
	        $Q = $this->db->get('tblusers');
	        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
	        return $data;
        } else {
        	$data = array();
        	$this->db->where('idusers', $_SESSION['iduserlogged']);
	        $Q = $this->db->get('tblusers');
	        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
	        return $data;
        }
	}
	
	public function getusersbyid($iduser)
	{
		$data = array();
		$this->db->where('idusers' , $iduser);
        $Q = $this->db->get('tblusers');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function saveusers()
	{
		// hitung jumlah user, maksimal 10 record
		$Qrecord = $this->db->query("SELECT COUNT(idusers) as JMLUSERS FROM tblusers");
		if($Qrecord->num_rows() > 0){ foreach($Qrecord->result_array() as $row){ $jml = $row['JMLUSERS']; } }
		
		$Qmaxuser = $this->db->query('SELECT maxuser FROM tblcompanyconfig');
		if($Qmaxuser->num_rows() > 0){ foreach($Qmaxuser->result_array() as $row){ $maxuser = $row['maxuser']; } }
		
		if($jml > $maxuser){
			$this->session->set_flashdata('error', 'Maximum user account '.$maxuser.' record!');
            redirect('setup/createusers','refresh');
		}
		
		$password = $this->generateHash(htmlentities(mysql_real_escape_string($this->input->post('password')), ENT_QUOTES));
		$data = array(
			'idusers' => rand(111111,999999),
			'name' => htmlentities(mysql_real_escape_string($this->input->post('username')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('userdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('usercategories')), ENT_QUOTES),
			'email'    => htmlentities(mysql_real_escape_string($this->input->post('emailaddress')), ENT_QUOTES),
			'loginname' => htmlentities(mysql_real_escape_string($this->input->post('loginname')), ENT_QUOTES),
			'password' => $password
		);

		$this->db->insert('tblusers', $data);
				
		redirect('maincontroller/setupusers');
	}
	
	public function editusers()
	{
		$idusers = htmlentities(mysql_real_escape_string($this->input->post('idusers')), ENT_QUOTES);
		$data = array(
			'name' => htmlentities(mysql_real_escape_string($this->input->post('username')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('userdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('usercategories')), ENT_QUOTES),
			'loginname' => htmlentities(mysql_real_escape_string($this->input->post('loginname')), ENT_QUOTES),
			'email'    => htmlentities(mysql_real_escape_string($this->input->post('emailaddress')), ENT_QUOTES)
		);
		
		$this->db->where('idusers', $idusers);
		$this->db->update('tblusers', $data);
		redirect('maincontroller/setupusers');
	}

	public function generateHash($password)
    {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH)
        {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }

    public function changepasswd(){
    	$idusers = htmlentities(mysql_real_escape_string($_POST['iduser']), ENT_QUOTES);
    	$data = array(
    		'password' => $this->generateHash(htmlentities(mysql_real_escape_string($_POST['passwd']), ENT_QUOTES))
    	);
    	$this->db->where('idusers',$idusers);
		$this->db->update('tblusers', $data);
    }

    public function checkduplicateloginname(){
    	$exists = 0;
    	$loginname = htmlentities(mysql_real_escape_string($_GET['username']), ENT_QUOTES);
    	$Q = $this->db->query('SELECT loginname FROM tblusers WHERE loginname = "'.$loginname.'"');
    	if($Q->num_rows() > 0){
    		$exists = 1;
    	} else {
    		$exists = 0;
    	}	
    	echo $exists;
    }

	/*~ End users */
	
	
	/*------------------------------------------------------------------------------------------------------------------
	*	Locations
	*/
	
	
	public function getlocations ()
	{
		$data = array();
		$this->db->select ( 'idlocation, name' );
        $Q = $this->db->get ( 'tbllocation' );
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	
	public function getAllLocations()
	{
		$data = array();
        $Q = $this->db->get('tbllocation');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function getlocationsbyid($idlocation)
	{
		$data = array();
		$this->db->where('idlocation' , $idlocation);
        $Q = $this->db->get('tbllocation');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function savelocation()
	{
		$data = array(
			'idlocation' => rand(111111,999999),
			'name' => htmlentities(mysql_real_escape_string($this->input->post('locationname')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('locationdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('locationcategories')), ENT_QUOTES),
			'locationowner'    => htmlentities(mysql_real_escape_string($this->input->post('owner')), ENT_QUOTES),
			'parentlocation'    => htmlentities(mysql_real_escape_string($this->input->post('parentlocation')), ENT_QUOTES)
		);

		$this->db->insert('tbllocation', $data);
		redirect('maincontroller/setuplocations');
	}
	
	public function editlocation()
	{
		$idlocation = htmlentities(mysql_real_escape_string($this->input->post('idlocation')), ENT_QUOTES);
		$data = array(	
			'name' => htmlentities(mysql_real_escape_string($this->input->post('locationname')), ENT_QUOTES),
			'description'  => htmlentities(mysql_real_escape_string($this->input->post('locationdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('locationcategories')), ENT_QUOTES),
			'locationowner'    => htmlentities(mysql_real_escape_string($this->input->post('owner')), ENT_QUOTES),
			'parentlocation'    => htmlentities(mysql_real_escape_string($this->input->post('parentlocation')), ENT_QUOTES)
		);

		$this->db->where('idlocation', $idlocation);
		$this->db->update('tbllocation', $data);
		redirect('maincontroller/setuplocations');
	}
	/*~ End locations*/
	
	
	/*------------------------------------------------------------------------------------------------------------------
	*	Views
	*/
	public function getAlViews($iduser, $level)
	{
		if($level == 'admin') {
			
			/* admin bisa membaca semua data view di tblviews */
			$data = array();
	        $Q = $this->db->query('SELECT `tblviews`.`idview`, `tblviews`.`name`, tblviews.`description`, tblviews.`categories`, tblviews.`title`, tblmeasure.`name` AS topmeeasures, `tbllocation`.`name` AS toplocations , tblviews.`displayby` FROM tblviews INNER JOIN tblmeasure ON tblviews.`topmeasure` = tblmeasure.`idmeasure` INNER JOIN tbllocation ON tblviews.`toplocation` = tbllocation.`idlocation` WHERE tblviews.iddb = "'.$_SESSION['dbuserlogged'].'" ORDER BY tblviews.`datecreated` DESC');
	        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
	        return $data;

        } else {

        	/* client hanya bisa membaca data view sesuai dengan akses yang diberikan padanya yang terdapat pada tabel tblassignview */
        	$data = array();
	        $Q = $this->db->query('SELECT `tblviews`.`idview`, `tblviews`.`name`, tblviews.`description`, tblviews.`categories`, tblviews.`title`, tblmeasure.`name` AS topmeeasures, `tbllocation`.`name` AS toplocations , tblviews.`displayby` FROM tblviews INNER JOIN tblmeasure ON tblviews.`topmeasure` = tblmeasure.`idmeasure` INNER JOIN tbllocation ON tblviews.`toplocation` = tbllocation.`idlocation` WHERE `tblviews`.`idview` IN ( SELECT idviews FROM tblassignview WHERE idusers =  "'.$iduser.'" ) ORDER BY tblviews.`datecreated` DESC');

	        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
	        return $data;

        }
	}
	
	public function getviewbyid($idview)
	{
		$data = array();
		$this->db->where("idview", $idview); 
        $Q = $this->db->get('tblviews');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function saveviews()
	{
		$idview = rand(111111,999999);
		/* data saved to tblviews */
		$data = array(
			'idview' => $idview,
			'iddb' => $_SESSION['dbuserlogged'],
			'name' => htmlentities(mysql_real_escape_string($this->input->post('viewname')), ENT_QUOTES),
			'description' => htmlentities(mysql_real_escape_string($this->input->post('viewdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('viewcategories')), ENT_QUOTES),
			'title' => htmlentities(mysql_real_escape_string($this->input->post('viewtitle')), ENT_QUOTES),
			'subtitle' => htmlentities(mysql_real_escape_string($this->input->post('viewsubtitle')), ENT_QUOTES),
			'topmeasure' => htmlentities(mysql_real_escape_string($this->input->post('topmeasure')), ENT_QUOTES),
			'toplocation' => htmlentities(mysql_real_escape_string($this->input->post('toplocation')), ENT_QUOTES),
			'displayby'  => htmlentities(mysql_real_escape_string($this->input->post('displayby')), ENT_QUOTES),
			'datecreated' => date("Y-m-d H:i:s")
		);
		$this->db->insert('tblviews', $data);
		
		/* data saved to tblhirarkikpi */
		$idmeasure = htmlentities(mysql_real_escape_string($this->input->post('topmeasure')), ENT_QUOTES);
		$datahirarki = array(
			'idview' => $idview,
			'iddb' => $_SESSION['dbuserlogged'],
			'idmeasure' => $idmeasure,
			'parent' => '0',
			'data' => '0',
			'datecreated' => date("Y-m-d H:i:s")
		);
		$this->db->insert('tblhirarkikpi', $datahirarki);
		
		/* insert detail of the measure into tbldetail */
		$this->insertintodetailview ( $idview, $idmeasure , '0' );
		
		redirect('maincontroller/setupviews');
	}
	
	public function editviews()
	{
		$idview = htmlentities(mysql_real_escape_string($this->input->post('idview')), ENT_QUOTES);
		/* data saved to tblviews */
		$data = array(
			'name' => htmlentities(mysql_real_escape_string($this->input->post('viewname')), ENT_QUOTES),
			'description' => htmlentities(mysql_real_escape_string($this->input->post('viewdescription')), ENT_QUOTES),
			'categories' => htmlentities(mysql_real_escape_string($this->input->post('viewcategories')), ENT_QUOTES),
			'title' => htmlentities(mysql_real_escape_string($this->input->post('viewtitle')), ENT_QUOTES),
			'subtitle' => htmlentities(mysql_real_escape_string($this->input->post('viewsubtitle')), ENT_QUOTES),
			'topmeasure' => htmlentities(mysql_real_escape_string($this->input->post('topmeasure')), ENT_QUOTES),
			'toplocation' => htmlentities(mysql_real_escape_string($this->input->post('toplocation')), ENT_QUOTES),
			'displayby'  => htmlentities(mysql_real_escape_string($this->input->post('displayby')), ENT_QUOTES)
		);
		
		$this->db->where('idview', $idview);
		$this->db->update('tblviews', $data);
		
		redirect('maincontroller/setupviews');
	}
	
	public function insertintodetailview ( $idview, $idmeasure , $parent )
	{
		/* get period type of the measure */
		$periodtype = '';
		$Q = $this->db->query('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$idmeasure.'" limit 1');
		if($Q->num_rows() > 0){ foreach($Q->result_array() as $row){ $periodtype = $row['storageperiod']; } }
		
		
		/* declare array for period name */
		$month = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
		$quarter = array('Q1','Q2','Q3','Q4');
		$week = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
		
		if ( $periodtype == 'month' )
		{
			foreach ( $month as $k => $v )
			{
				$iddetail = rand(111111,999999);
				/* data saved to tbldetail in month period */
				$datadetail = array(
					'iddetail' => $iddetail,
					'iddb' => $_SESSION['dbuserlogged'],
					'idview' => $idview,
					'idmeasure' => $idmeasure,
					'parent' => $parent,
					'storageperiod' => $periodtype,
					'year' => date('Y'),
					'periodname' => $v,
					'actual' => '0',
					'target' => '0',
					'index' => '0',
					'weight' => '0'
				);
				$this->db->insert('tbldetail', $datadetail);
			}
		}
		else if ( $periodtype == 'quarter' )
		{
			foreach ( $quarter as $k => $v )
			{
				$iddetail = rand(111111,999999);
				/* data saved to tbldetail in quarter period */
				$datadetail = array(
					'iddetail' => $iddetail,
					'iddb' => $_SESSION['dbuserlogged'],
					'idview' => $idview,
					'idmeasure' => $idmeasure,
					'parent' => $parent,
					'storageperiod' => $periodtype,
					'periodname' => $v,
					'year' => date('Y'),
					'actual' => '0',
					'target' => '0',
					'index' => '0',
					'weight' => '0'
				);
				$this->db->insert('tbldetail', $datadetail);
			}
		}
		else if ( $periodtype == 'week' )
		{
			foreach ( $week as $k => $v )
			{
				$iddetail = rand(111111,999999);
				/* data saved to tbldetail in week period */
				$datadetail = array(
					'iddetail' => $iddetail,
					'iddb' => $_SESSION['dbuserlogged'],
					'idview' => $idview,
					'idmeasure' => $idmeasure,
					'parent' => $parent,
					'storageperiod' => $periodtype,
					'periodname' => $v,
					'year' => date('Y'),
					'actual' => '0',
					'target' => '0',
					'index' => '0',
					'weight' => '0'
				);
				$this->db->insert('tbldetail', $datadetail);
			}
		}
	}
	
	
	public function getregisteredview($idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT DISTINCT tblviews.`name`, tblviews.`idview` FROM tblviews INNER JOIN tblhirarkikpi ON tblviews.`idview` = tblhirarkikpi.`idview` WHERE tblhirarkikpi.`idmeasure` = "'.$idmeasure.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	
	public function getjmlregisteredview($idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT COUNT(tblviews.`idview`) AS jml FROM tblviews INNER JOIN tblhirarkikpi ON tblviews.`idview` = tblhirarkikpi.`idview` WHERE tblhirarkikpi.`idmeasure` = "'.$idmeasure.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	
	public function getidview($idmeasure)
	{
		$data = array();
        $Q = $this->db->query('SELECT idview FROM tblhirarkikpi WHERE idmeasure = "'.$idmeasure.'" ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	/* End views*/
	
	
	/*-----------------------------------------------------------------------------------------
	*	Submeasure
	*/
	public function savesubmeasure()
	{
		$idview = '';
		if($jmllistview[0]['jml'] > 0)
		{
			$idview = htmlentities(mysql_real_escape_string($this->input->post('listview')), ENT_QUOTES);
		}
		else if($jmllistview[0]['jml'] < 1)
		{
			$idview = htmlentities(mysql_real_escape_string($this->input->post('idviewparent')), ENT_QUOTES);
		}
		
		foreach($_POST['checksubmeasure'] as $checksubmeasureinput)
		{
			$Qduplicate = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE idmeasure = "'.$checksubmeasureinput.'" AND parent = "'.$this->input->post('parentmeasure').'" AND idview = "'.$idview.'" ');
			//print ('SELECT idmeasure FROM tblhirarkikpi WHERE idmeasure = "'.$checksubmeasureinput.'" AND parent = "'.$this->input->post('parentmeasure').'" AND idview = "'.$idview.'" ');
			//exit;
			if($Qduplicate->num_rows() > 0){
				$this->session->set_flashdata('Error', 'Duplicate Submeasure!');
				redirect('maincontroller/submeasures/'.$this->input->post('parentmeasure'));
			} else if($Qduplicate->num_rows() < 1) { 
			
				$idmeasurecloning = rand(111111,999999);
				
				/* cari measure dengan idview dan idmeasure yang sama */
				$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE iddb = "'.$_SESSION['dbuserlogged'].'" AND idview = "'.$idview.'" AND idmeasure = "'.$checksubmeasureinput.'" ');
			
				if($Q->num_rows() > 0){
					/* gunakan id measure cloning */
					
					/* insert into tblweight */
					$data = array(
						'iddb' =>  $_SESSION['dbuserlogged'],
						'idview' => $idview, 
						'idmeasure' => $idmeasurecloning,
						'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
						'weight' => null,
						'datecreated' => date("Y-m-d H:i:s")
					);
					$this->db->insert('tblweight', $data);
					
					/* insert into tlhirarkikpi */
					$data = array(
						'iddb' =>  $_SESSION['dbuserlogged'],
						'idview' => $idview,
						'idmeasure' => $idmeasurecloning,
						'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
						'data' => '',
						'datecreated' => date("Y-m-d H:i:s")
					);
					$this->db->insert('tblhirarkikpi', $data);
					
					/* cloning measure for multi parent */
					$this->cloningMeasure( $idview , $checksubmeasureinput , $this->input->post('parentmeasure') , $idmeasurecloning );
					
				} else {
				
					/* gunakan id measure asli */
					
					/* insert into tblweight */
					$data = array(
						'idview' => $idview, 
						'idmeasure' => $checksubmeasureinput,
						'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
						'weight' => null,
						'datecreated' => date("Y-m-d H:i:s")
					);
					$this->db->insert('tblweight', $data);
					
					/* insert into tlhirarkikpi */
					$data = array(
						'iddb' =>  $_SESSION['dbuserlogged'],
						'idview' => $idview,
						'idmeasure' => $checksubmeasureinput,
						'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
						'data' => '',
						'datecreated' => date("Y-m-d H:i:s")
					);
					$this->db->insert('tblhirarkikpi', $data);
					
					/* insert detail of the measure into tbldetail */
					$this->insertintodetailview ( $idview, $checksubmeasureinput, $this->input->post('parentmeasure') );
				}
				
			}
		}
		
		redirect('maincontroller/submeasures/'.$_POST['parentmeasure']);
	}
	
	public function cloningMeasure( $idview , $idmeasure , $parent , $idmeasurecloning )
	{	
		
		
		/* jika ditemukan maka input penanda pada tblcloningmeasure */
		$data = array(
			'idcloning' => rand(111111,999999),
			'idmeasureasli' => $idmeasure,
			'idmeasurecloning' => $idmeasurecloning,
			'iddb' => $_SESSION['dbuserlogged'],
			'idview' => $idview
		);
		$this->db->insert('tblcloningmeasure', $data);
		
		/* lakukan cloning pada tblmeasure */
		$Qtblmeasure = $this->db->query('SELECT * FROM tblmeasure WHERE iddb= "'.$_SESSION['dbuserlogged'].'" AND idmeasure = "'.$idmeasure.'" ');
		if($Qtblmeasure->num_rows() > 0){foreach($Qtblmeasure->result_array() as $row){
			$datameasurecloningan = array(
				'idmeasure' => $idmeasurecloning,
				'iddb' => $row['iddb'],
				'name' => $row['name'],
				'description' => $row['description'],
				'categories' => $row['categories'],
				'type' => $row['type'],
				'critical' => $row['critical'],
				'polarity' => $row['polarity'],
				'storageperiod' => $row['storageperiod'],
				'unittype' => $row['unittype'],
				'defaultowner' => $row['defaultowner'],
				'ownerbylocation' => $row['ownerbylocation'],
				'consolidationfunctions' => $row['consolidationfunctions'],
				'notes' => $row['notes'],
				'location' => $row['location'],
				'cloning' => '1'
			);
			$this->db->insert('tblmeasure', $datameasurecloningan);
		}}
	
		/* lakukan cloning pada tbldetail */
		$Qtblhirarkikpi = $this->db->query('SELECT * FROM tbldetail WHERE idview = "'.$idview.'" AND idmeasure = "'.$idmeasure.'" ');
		if($Qtblhirarkikpi->num_rows() > 0){foreach($Qtblhirarkikpi->result_array() as $row){
			$datadetailcloning = array(
				'iddetail' => rand(111111,999999),
				'iddb' => $row['iddb'],
				'idview' => $idview,
				'idmeasure' => $idmeasurecloning,
				'storageperiod' => $row['storageperiod'],
				'parent'  => $parent,
				'periodname' => $row['periodname'],
				'year' => $row['year'],
				'actual' => $row['actual'],
				'target' => $row['target'],
				'targetvariance' => $row['targetvariance'],
				'index' => $row['index'],
				'weight' => $row['weight'],
				'series1' => $row['series1'],
				'series1variance' => $row['series1variance'],
				'series1index' => $row['series1index'],
				'series2' => $row['series2'],
				'series2variance' => $row['series2variance'],
				'series2index' => $row['series2index'],
				'owner' => $row['owner']
			);
			$this->db->insert('tbldetail', $datadetailcloning);
		}}
		
		/* lakukan cloning pada tblsecurity measure */
		$Qtblsecuritymeasure = $this->db->query('SELECT * FROM tblsecuritymeasure WHERE iddb = "'.$_SESSION['dbuserlogged'].'" AND idmeasure = "'.$idmeasure.'" ');
		if($Qtblsecuritymeasure->num_rows() > 0){foreach($Qtblsecuritymeasure->result_array() as $row){
			$datasecuritymeasure = array(
				'idsecurity' => rand(111111,999999),
				'iddb' => $row['iddb'],
				'idmeasure' => $idmeasurecloning,
				'idusers' => $row['idusers'],
				'view' => $row['view'],
				'edit' => $row['edit'],
				'entry' => $row['entry']
			);
			$this->db->insert('tblsecuritymeasure', $datasecuritymeasure);
		}}
	}
	
	public function cloningWeight( $idview , $idmeasure )
	{
		
		/* lakukan cloning pada tblweight */
		$Qtblweight = $this->db->query('SELECT * FROM tblweight WHERE idview = "'.$idview.'" AND idmeasure = "'.$idmeasure.'" ');
		if($Qtblweight->num_rows() > 0){foreach($Qtblweight->result_array() as $row){
			$dataweightcloning = array(
				'idview' => $idview,
				'idmeasure' => $idmeasurecloning,
				'iddb' => $row['iddb'],
				'parent' => $row['parent'],
				'weight' => $row['weight'],
				'datecreated' => $row['datecreated']
			);
			$this->db->insert('tblweight', $dataweightcloning);
		}}
	}
	public function savesubmeasureweight()
	{
		/* update weigth for each submeasure */
		$i = 1;
		foreach($_POST['measureweight'] as $measureweightin)
		{
			$data = array(
				'weight' => htmlentities(mysql_real_escape_string($this->input->post($i)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $measureweightin);
			$this->db->update('tblweight', $data);	
			$i++;
		}
		
		/* cari dulu data pada tblmeasure cloning, kemudian lakukan cloning weight */
		$this->cloningWeight( $idview , $idmeasure );
		
		/* insert into tblhirarki for valid submeasure within it's weight
		$i = 1;
		foreach($_POST['measureweight'] as $measureweightin)
		{
			/* check first if idmeasure already inserted to tblhirarki, if yes then do nothing, if no then insert 
			$datacurrent = array();
			$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE idmeasure = "'.$measureweightin.'" ');
			
			if($Q->num_rows() > 0){
				// do nothing
			} else if($Q->num_rows() < 1) { 
				$data = array(
					'idmeasure' => $measureweightin,
					'parent' => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
					'data' => '',
					'datecreated' => date("Y-m-d H:i:s")
				);
				$this->db->insert('tblhirarkikpi', $data);
			}
		}*/
		
		
		/* return page */
		redirect('maincontroller/submeasures/'.$_POST['parentmeasure']);
		
	}
	
	public function getsubmeasurediweight($idmeasure)
	{
		$Qx = $this->db->query('UPDATE tblweight SET weight = NULL WHERE weight = 0');

		$data = array();
        $Q = $this->db->query('SELECT	tblweight.`idmeasure`, tblmeasure.`name`, tblweight.`weight` FROM tblmeasure INNER JOIN tblweight ON tblmeasure.`idmeasure` = tblweight.`idmeasure` WHERE tblweight.`parent` = "'.$idmeasure.'" ORDER BY tblweight.`datecreated`');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function delsubmeasurerekursif($idsubmeasure, $idview, $parent)
	{
		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasure.'" AND idview = "'.$idview.'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
		
			$idmeasurechildlevel1 = $row['idmeasure'];
			$idviewlevel1 = $row['idview'];
			
			/* delete from tblhirarki */
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->where('idview', $idviewlevel1);
			$this->db->where('parent', $parent);
			$this->db->delete('tblhirarkikpi');

			/* delete from tblweight */
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->where('idview', $idviewlevel1);
			$this->db->where('parent', $parent);
			$this->db->delete('tblweight');
		
			$this->db->where('idmeasure', $idmeasurechildlevel1);
			$this->db->where('idview', $idviewlevel1);
			$this->db->delete('tbldetail');
			
			$this->delsubmeasure($idmeasurechildlevel1, $idviewlevel1);
		}}
	}
	
	public function delsubmeasure($idsubmeasure, $idview, $parent)
	{
		$this->db->where('idmeasure', $idsubmeasure);
		$this->db->where('idview', $idview);
		$this->db->where('parent', $parent);
		$this->db->delete('tblhirarkikpi');
		
		$this->db->where('idmeasure', $idsubmeasure);
		$this->db->where('idview', $idview);
		$this->db->where('parent', $parent);
		$this->db->delete('tblweight');
		
		$this->db->where('idmeasure', $idsubmeasure);
		$this->db->where('idview', $idview);
		$this->db->where('parent', $parent);
		$this->db->delete('tbldetail');
		
		$this->delsubmeasurerekursif($idsubmeasure, $idview, $parent);
	}
	
	
	/* End submeasure */
	
	public function basicReport()
	{
	}
	
	/*-----------------------------------------------------------------------------------------
	*	Actual target value
	*/
	public function saveperiodmonth2()
	{
		$data['activeperiod'] = $this->getactiveperiod();
		$months = array();
		
		switch( $data['activeperiod'][0]['month'])
		{
			case 'Jan': {$months = array('jan'=>'janact');
						 $monthstar = array('jan'=>'jantar'); break;
						}
			case 'Feb': {$months = array('jan'=>'jantar','feb'=>'febtar');
						 $monthstar = array('jan'=>'jantar','feb'=>'febtar'); break;
						}
			case 'Mar': {$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract');
						 $monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar'); break;
						}
			case 'Apr' :{$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract');
						 $monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar'); break;
						}
			case 'May' :{$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact');
						 $monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar'); break;
						}
			case 'Jun' : {$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact');
						 $monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar'); break;
						}
			case 'Jul' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>'julact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>'jultar'); break;
						}
			case 'Aug' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>	'julact','aug'=>'augact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>'jultar','aug'=>'augtar'); break;
						}
			case 'Sep' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>	'julact','aug'=>'augact','sep'=>'sepact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>	'jultar','aug'=>'augact','sep'=>'septar'); break;
						}
			case 'Oct' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>	'julact','aug'=>'augact','sep'=>'sepact','okt'=>'oktact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>	'jultar','aug'=>'augact','sep'=>'septar','okt'=>'okttar'); break;
						}
			case 'Nov' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>	'julact','aug'=>'augact','sep'=>'sepact','okt'=>'oktact','nop'=>'nopact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>	'jultar','aug'=>'augact','sep'=>'septar','okt'=>'okttar','nop'=>'noptar'); break;
						}
			case 'Dec' :{
						$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>	'julact','aug'=>'augact','sep'=>'sepact','okt'=>'oktact','nop'=>'nopact','des'=>'desact');
						$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>	'jultar','aug'=>'augact','sep'=>'septar','okt'=>'okttar','nop'=>'noptar','des'=>'destar'); break;
						}
		}
		
		$Qcloning = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasureasli = "'.$_POST['idmeasure'].'" AND idview = "'.$_POST['idview'].'" ');
		
		$Qasli = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasurecloning = "'.$_POST['idmeasure'].'" AND idview = "'.$_POST['idview'].'" ');
		
		/* save actual value */
		//$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>'julact','aug'=>'augact','sep'=>'sepact','okt'=>'oktact','nop'=>'nopact','des'=>'desact');
		foreach($months as $k=>$v)
		{
			$data = array(
				'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$dataclon = array(
					'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->update('tbldetail', $dataclon);	
			}}
		}
		/* save target value */
		//$monthstar = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>'jultar','aug'=>'augtar','sep'=>'septar','okt'=>'okttar','nop'=>'noptar','des'=>'destar');
		foreach($monthstar as $k=>$v)
		{
			$data = array(
				'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$dataclon = array(
					'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->update('tbldetail', $dataclon);	
			}}
		}
		/* hitung index */
		$this->hitungindex ( $_POST['idmeasure'] , $_POST['idview'] );
		
		if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
			$this->hitungindex ( $row['idmeasurecloning'] , $row['idview'] );
		}}
		
		if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
			$this->hitungindex ( $row['idmeasureasli'] , $row['idview'] );
		}}
		
		redirect('maincontroller/hirarkikpi/'.$_POST['idview']);
	}
	
	//public function idxparent($_POST['idmeasure'], $_POST['idview'], $monthz[$i] )
	public function idxparent($idmeasure, $idview, $monthzpilih )
	{
		$monthz = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
		switch( $monthzpilih )
		{
			case 'Jan' :{
				for($i=0;$i<1;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Feb' :{
				for($i=0;$i<2;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Mar' :{
				for($i=0;$i<3;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Apr' :{
				for($i=0;$i<4;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'May' :{
				for($i=0;$i<5;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Jun' :{
				for($i=0;$i<6;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Jul' :{
				for($i=0;$i<7;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Aug' :{
				for($i=0;$i<8;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Sep' :{
				for($i=0;$i<9;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Oct' :{
				for($i=0;$i<10;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Nov' :{
				for($i=0;$i<11;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
			case 'Dec' :{
				for($i=0;$i<12;$i++){ $this->calculateparentactualtarget( $idmeasure, $idview, $monthz[$i] ); }
			}
		}
		
		$Qparent = $this->db->query('SELECT parent FROM tblhirarkikpi WHERE idmeasure = "'.$_POST['idmeasure'].'" ');
		if($Qparent->num_rows() > 0){foreach($Qparent->result_array() as $row){
			$this->idxparent($row['parent'], $idview, $monthzpilih );
		}}
	}
								
	public function saveperiodmonth()
	{
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;

		/* searching idcloning, if exists then do exactly like real measure */
		$Qcloning = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasureasli = "'.$_POST['idmeasure'].'" AND idview = "'.$_POST['idview'].'" ');
		
		$Qasli = $this->db->query('SELECT * FROM tblcloningmeasure WHERE idmeasurecloning = "'.$_POST['idmeasure'].'" AND idview = "'.$_POST['idview'].'" ');
		
		/* save actual value */
		$months = array('jan'=>'janact','feb'=>'febact','mar'=>'maract','apr'=>'apract','mei'=>'meiact','jun'=>'junact','jul'=>'julact','aug'=>'augact','sep'=>'sepact','okt'=>'oktact','nop'=>'nopact','des'=>'desact');
		foreach($months as $k=>$v)
		{
			$data = array(
				'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$dataclon = array(
					'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
		}
		
		/* save target value */
		$months = array('jan'=>'jantar','feb'=>'febtar','mar'=>'martar','apr'=>'aprtar','mei'=>'meitar','jun'=>'juntar','jul'=>'jultar','aug'=>'augtar','sep'=>'septar','okt'=>'okttar','nop'=>'noptar','des'=>'destar');
		foreach($months as $k=>$v)
		{
			$data = array(
				'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$dataclon = array(
					'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
		}
		
		
		/* hitung index */
		$this->hitungindex ( $_POST['idmeasure'] , $_POST['idview'] );
		
		if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
			$this->hitungindex ( $row['idmeasurecloning'] , $row['idview'] );
		}}
		
		if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
			$this->hitungindex ( $row['idmeasureasli'] , $row['idview'] );
		}}
		
		/* save series 1 */
		$months = array('jan'=>'series1janact','feb'=>'series1febact','mar'=>'series1maract','apr'=>'series1apract','mei'=>'series1meiact','jun'=>'series1junact','jul'=>'series1julact','aug'=>'series1augact','sep'=>'series1sepact','okt'=>'series1oktact','nop'=>'series1nopact','des'=>'series1desact');
		foreach($months as $k=>$v)
		{
			$data = array(
				'series1' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$dataclon = array(
					'series1' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$dataclon = array(
					'series1' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $dataclon);	
			}}
			
		}

		/* save series 2 */
		$months = array('jan'=>'series2janact','feb'=>'series2febact','mar'=>'series2maract','apr'=>'series2apract','mei'=>'series2meiact','jun'=>'series2junact','jul'=>'series2julact','aug'=>'series2augact','sep'=>'series2sepact','okt'=>'series2oktact','nop'=>'series2nopact','des'=>'series2desact');
		foreach($months as $k=>$v)
		{
			$data = array(
				'series2' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
			
			if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
				$data = array(
					'series2' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasurecloning']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $data);	
			}}
			
			if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
				$data = array(
					'series2' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
				);
				$this->db->where('idmeasure', $row['idmeasureasli']);
				$this->db->where('idview', $row['idview']);
				$this->db->where('periodname', $k);
				$this->db->where('year', $years[0]['year']);
				$this->db->update('tbldetail', $data);	
			}}
		}
		
		$monthz = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
		$data['activeperiod'] = $this->getactiveperiod();
		//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $data['activeperiod'][0]['month'] ); 
		switch( $data['activeperiod'][0]['month'] )
		{
			case 'Jan' :{
							for($i=0;$i<1;$i++){ 
								$this->calculateparentactualtarget( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Feb' : {
							for($i=0;$i<2;$i++){ 
								$this->calculateparentactualtarget( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Mar' : {
							for($i=0;$i<3;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Apr' : {
							for($i=0;$i<4;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'May' : {
							for($i=0;$i<5;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Jun' : {
							for($i=0;$i<6;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Jul' : {
							for($i=0;$i<7;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Aug' : {
							for($i=0;$i<8;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Sep' : {
							for($i=0;$i<9;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Oct' : {
							for($i=0;$i<10;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Nov' : {
							for($i=0;$i<11;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
			case 'Dec' : {
							for($i=0;$i<12;$i++){ 
								$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								//$this->idxparent( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								$this->calculateTargetVariance($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
								$this->calculateSeriesVariance( $_POST['idmeasure'], $_POST['idview'], $monthz[$i] ); 
								
								if($Qcloning->num_rows() > 0){foreach($Qcloning->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasurecloning'], $row['idview'], $monthz[$i] ); 
								}}
								
								if($Qasli->num_rows() > 0){foreach($Qasli->result_array() as $row){
									$this->calculateparentactualtarget( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateTargetVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
									$this->calculateSeriesVariance( $row['idmeasureasli'], $row['idview'], $monthz[$i] ); 
								}}
							} 
							break;
						}
		}

		/* return to base */
		redirect('maincontroller/hirarkikpi/'.$_POST['idview']);
	}
	
	public function calculateSeriesVariance( $idmeasure, $idview, $periodname )
	{
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;
		
		$Q = $this->db->query('SELECT actual, series1, series2 FROM tbldetail WHERE idview = "'.$idview.'" AND idmeasure = "'.$idmeasure.'" AND periodname = "'.$periodname.'" AND `year` = "'.$years[0]['year'].'"  ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$series1Variance = $row['actual'] - $row['series1'];
			$series2Variance = $row['actual'] - $row['series2'];
			
			$data = array(
				'series1variance' => $series1Variance,
				'series2variance' => $series2Variance
			);
			$this->db->where('idmeasure', $idmeasure);
			$this->db->where('idview', $idview);
			$this->db->where('periodname', $periodname);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
		}}	
	}
	
	public function calculateTargetVariance( $idmeasure, $idview, $periodname )
	{
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;
		
		$Q = $this->db->query('SELECT actual, target FROM tbldetail WHERE idview = "'.$idview.'" AND idmeasure = "'.$idmeasure.'" AND periodname = "'.$periodname.'" AND `year` = "'.$years[0]['year'].'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$targetVariance = $row['actual'] - $row['target'];
			
			$data = array(
				'targetvariance' => $targetVariance
			);
			$this->db->where('idmeasure', $idmeasure);
			$this->db->where('idview', $idview);
			$this->db->where('periodname', $periodname);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $data);	
		}}	
	}
	
	public function rekursivparent( $idview , $idmeasure)
	{
		$Q = $this->db->query('SELECT * FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND parent = "'.$idmeasure.'" LIMIT 1');
		//print ('SELECT * FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND parent = "'.$idmeasure.'" LIMIT 1<br/>');
		if($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$this->rekursivparent( $idview , $row['idmeasure'] );
				
			}
		}else{
			$this->var1=$idmeasure;
		}
		//else
		//print substr($idmeasure.'-',0,6);
		return $this->var1;
	}
	
	public function SynchronizeView( $idview )
	{
		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND parent = 0 LIMIT 1');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$idmeasure = $row['idmeasure'];
		}}
		//$data['activeperiod'] = $this->msetup->getactiveperiod();
		//$idm = substr($this->rekursivparent( $idview , $idmeasure),0,6);
		//$idm = substr($this->rekursivparent( $idview , $idmeasure),0,6);
		//print $idm;
		//exit;
		//print($this->rekursivparent( $idview , $idmeasure));
		//exit;
		//$this->rekursivparent( $idview , $idmeasure);
		
		//$this->rekursivparent( $idview , $idmeasure);
		//exit;
		//$this->calculateparentactualtarget( $idmeasureget, $idview, $data['activeperiod'][0]['month'] );
		
		// dari idmeasure get ambil parent nya kemudian panggil indexrecursiveparent begitu seterusnya sampe abis parentnya
		$this->sinycParent($this->rekursivparent( $idview , $idmeasure), $idview);
		redirect('maincontroller/hirarkikpi/'.$idview , 'refresh');
	}
	
	public function sinycParent($idmeasureget, $idview)
	{
		$Qparent = $this->db->query('SELECT parent FROM tblhirarkikpi WHERE idmeasure = "'.$idmeasureget.'" ');
		if($Qparent->num_rows() > 0){foreach($Qparent->result_array() as $row){
			$this->recursiveIndexParent( $row['parent'] , $idview )	;
			$this->sinycParent($row['parent'], $idview);
		}}
	}
	
	public function calculateparentactualtarget( $idmeasure, $idview, $periodname )
	{
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;
		/**
			Scenario
			1.	cari parent dari measure yang telah melakukan input data
			2. 	cari sekumpulan child dari measure parent yang sudah didapat sebelumnya
			3.	ambil target dan actual dari masing-masing measure yang ditemukan
			4.	ambil weight dari masing-masing measure yang ditemukan
			5.	untuk mendapatkan actual  dan target parent maka kalikan antara actual * weight dan target * weight
				dan diulang sebanyak jumlah child measure dan diakumulasikan menjadi actual dan target parent
		*/
		
		/* search for parent measure by idmeasure and idview */ 
		$idmeasureparent='';
        $Q = $this->db->query('SELECT parent FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND idmeasure = "'.$idmeasure.'" ');
		
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			$idmeasureparent = $row['parent'];
			
        
			/* do calculation for actual and target belongs to parent measure */
			$actualparent = 0;
			$targetparent = 0;
			$sumchildindex = 0;
			$actualtemp = 0;
			$targettemp = 0;
			$childweight = 0;
			$indexparent = 0;
			$i = 0;
			
			
			/* get a bunch of child measure from current parent measure */
			$Q1 = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasureparent.'" AND idview = "'.$idview.'" ');
			//print ('SELECT idmeasure FROM tblhirarkikpi WHERE parent = "'.$idmeasureparent.'" AND idview = "'.$idview.'" ');exit;
			if($Q1->num_rows() > 0){foreach($Q1->result_array() as $row1){
				$idmeasurechild = $row1['idmeasure'];
				$this->peruse = '';
				// handle jika ternyata pada satu parent yang sama, child lain berbeda period type nya, misal ada yang month, ada yang quarter, na untuk itu, periodname yang dgunakan untuk mengambil tbldetail menjadi mengikuti periodtype dari masing-masing child
				$Qperchild = $this->db->query('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$idmeasurechild.'" LIMIT 1');
				//print ('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$idmeasurechild.'" LIMIT 1 <br/>');
				if($Qperchild->num_rows() > 0){foreach($Qperchild->result_array() as $rowx){
					$perchild = $rowx['storageperiod'];
					
				}}
				
				switch($perchild)
				{
					case 'month':
						switch($periodname)
						{
							case 'Q1':	$this->peruse = 'mar';
							break;
							case 'Q2':	$this->peruse = 'jun';
							break;
							case 'Q3':	$this->peruse = 'sep';
							break;
							case 'Q4':	$this->peruse = 'des';
							break;
							default: $this->peruse = $periodname;
							break;
						}
					break;
					case 'quarter':
						switch($periodname)
						{
							case 'jan':
							case 'feb':
							case 'mar':
								$this->peruse = 'Q1';
							break;
							case 'apr':
							case 'mei':
							case 'jun':
								$this->peruse = 'Q2';
							break;
							case 'jul':
							case 'aug':
							case 'sep':
								$this->peruse = 'Q3';
							break;
							case 'okt':
							case 'nop':
							case 'des':
								$this->peruse = 'Q4';
							break;
							default: $this->peruse = $periodname;
							break;
						}
					break;
				}
				
				/* for every loop reset actual and target and index to 0 */
				$childactual = 0;
				$childtarget = 0;
				$childindex = 0;
				
				/* get actual and target from child measure */
				//$Q2 = $this->db->query('SELECT `actual`, `target`, `index` FROM tbldetail WHERE idmeasure = "'.$idmeasurechild.'" AND idview = "'.$idview.'"  AND periodname ="'.$periodname.'" limit 1 ');
				$Q2 = $this->db->query('SELECT `actual`, `target`, `index` FROM tbldetail WHERE idmeasure = "'.$idmeasurechild.'" AND idview = "'.$idview.'"  AND periodname ="'.$this->peruse.'" AND `year` = "'.$years[0]['year'].'" limit 1 ');
			
				if($Q2->num_rows() > 0){foreach($Q2->result_array() as $row2){
					$childactual = $row2['actual'];
					$childtarget = $row2['target'];
					$childindex = $row2['index'];
				}}
				
				/* get weight from child measure */
				$Q3 = $this->db->query('SELECT weight FROM tblweight WHERE idmeasure = "'.$idmeasurechild.'" AND idview = "'.$idview.'" limit 1 ');
				if($Q3->num_rows() > 0){foreach($Q3->result_array() as $row3){
					$childweight = $row3['weight'];
					
				}}
				
				$actualtemp = $childactual * $childweight / 100;
				$actualparent += $actualtemp;
				
				$targettemp = $childtarget * $childweight / 100;
				$targetparent += $targettemp;
				
				$indextemp = $childindex * $childweight / 100;
				$indexparent += $indextemp;
				
				//$sumchildindex += $childindex;
				$i++;
				
			}}
			
			//$realchildindex = $sumchildindex / $i;
			
			/* do save data for the actual parent and target parent */
			$Qperiodtype = $this->db->query('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$idmeasureparent.'" LIMIT 1');
			if($Qperiodtype->num_rows() > 0){foreach($Qperiodtype->result_array() as $rowperiodtype){
					$periodtypeparent = $rowperiodtype['storageperiod'];
			}}
			
			$idxpar = number_format($indexparent,1);
			
			switch( $periodtypeparent )
			{	
				case 'month':
					switch( $periodname )
					{
						case 'Q1':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname IN("jan","feb","mar") AND `year` = "'.$years[0]['year'].'" ');
						break;
						case 'Q2':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname IN("apr","mei","jun") AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'Q3':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname IN("jul","aug","sep") AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'Q4':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname IN("okt","nop","des") AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'jan':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "jan" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'feb':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "feb" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'mar':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "mar" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'apr':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "apr" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'mei':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "mei" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'jun':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "jun" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'jul':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "jul" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'aug':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "aug" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'sep':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "sep" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'okt':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "okt" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'nop':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "nop" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'des':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname = "des" AND `year` = "'.$years[0]['year'].'"  ');
						break;
					}
				break;
				case 'quarter':
					switch( $periodname )
					{
						case 'jan':
						case 'feb':
						case 'mar':
						case 'Q1':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname ="Q1" AND `year` = "'.$years[0]['year'].'"  ');
							
						break;
						case 'apr':
						case 'mei':
						case 'jun':
						case 'Q2':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname ="Q2" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'jul':
						case 'aug':
						case 'sep':
						case 'Q3':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname ="Q3" AND `year` = "'.$years[0]['year'].'"  ');
						break;
						case 'okt':
						case 'nop':
						case 'des':
						case 'Q4':
							$this->db->query('UPDATE tbldetail SET actual = "'.$actualparent.'", target = "'.$targetparent.'", `index` = "'.$idxpar.'" WHERE idmeasure = "'.$idmeasureparent.'" AND idview = "'.$idview.'" AND periodname ="Q4" AND `year` = "'.$years[0]['year'].'"  ');
						break;
					}
				break;
				case 'week':
				break;
			}
		
		}}
		
		//$this->calculateparentactualtarget( $idmeasureparent, $idview, $periodname );
		//$this->recursiveIndexParent( $idmeasureparent , $idview )	;
	}
	
	public function saveperiodquarter()
	{
		/* save actual value */
		$months = array('Q1'=>'q1act','Q2'=>'q2act','Q3'=>'q3act','Q4'=>'q4act');
		foreach($months as $k=>$v)
		{
			$data = array(
				'actual' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->update('tbldetail', $data);	
		}
		
		/* save target value */
		$months = array('Q1'=>'q1tar','Q2'=>'q2tar','Q3'=>'q3tar','Q4'=>'q4tar');
		foreach($months as $k=>$v)
		{
			$data = array(
				'target' => htmlentities(mysql_real_escape_string($this->input->post($v)), ENT_QUOTES)
			);
			$this->db->where('idmeasure', $_POST['idmeasure']);
			$this->db->where('idview', $_POST['idview']);
			$this->db->where('periodname', $k);
			$this->db->update('tbldetail', $data);	
		}
		
		$this->hitungindex ( $_POST['idmeasure'] , $_POST['idview'] );
		
		//~ original code
		//~$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $_POST['periodset']);
		
		
		// define array periodtype
		$monthz = array();
		// define period type set on tblperiod
		$periodtype = '';
		
		// get parent from current measure
		//$Q = $this->db->query('SELECT parent FROM tblhirarkikpi WHERE idview = "'.$_POST['idview'].'" AND idmeasure = "'.$_POST['idmeasure'].'" LIMIT 1 ');
       // if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			//$idmeasureparent = $row['parent'];
			// get period type of the current parent measure
			$Qperiodtype = $this->db->query('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$_POST['idmeasure'].'" LIMIT 1');
			if($Qperiodtype->num_rows() > 0){foreach($Qperiodtype->result_array() as $rowperiodtype){
				$periodtype = $rowperiodtype['storageperiod'];
			}}
		//}}
		
		if( $periodtype == 'month' )
		{
			$monthz = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
			//print_r( $monthz);exit();
			
			foreach($monthz as $key => $value) {
				switch( $monthz[$key] )
				{
					case 'jan' :{ for($i=0;$i<1;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'feb' :{ for($i=0;$i<2;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'mar' :{ for($i=0;$i<3;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'apr' :{ for($i=0;$i<4;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'mei' :{ for($i=0;$i<5;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'jun' :{ for($i=0;$i<6;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'jul' :{ for($i=0;$i<7;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'aug' :{ for($i=0;$i<8;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'sep' :{ for($i=0;$i<9;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'okt' :{ for($i=0;$i<10;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'nop' :{ for($i=0;$i<11;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'des' :{ for($i=0;$i<12;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
				}
			}
		}
		else if( $periodtype == 'quarter' )
		{
			$monthz = array('Q1','Q2','Q3','Q4');
			foreach($monthz as $key => $value) {
				switch( $monthz[$key] )
				{
					case 'Q1' :{ for($i=0;$i<1;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'Q2' :{ for($i=0;$i<2;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'Q3' :{ for($i=0;$i<3;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
					case 'Q4' :{ for($i=0;$i<4;$i++){ $this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); } break; }
				}
			}
		}
		else if( $periodtype == 'week' )
		{
			$monthz = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
		}
		/*
		print_r($monthz);exit();
		//$data['activeperiod'] = $this->getactiveperiod();
		//~echo $data['activeperiod'][0]['month'];exit();
		
		
		if($data['activeperiod'][0]['month']=='Jan' || $data['activeperiod'][0]['month']=='Feb' || $data['activeperiod'][0]['month']=='Mar' )
		{ 
			for($i=0;$i<1;$i++)
			{ 
				$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
			} 
		}
		else if($data['activeperiod'][0]['month']=='Apr' || $data['activeperiod'][0]['month']=='May' || $data['activeperiod'][0]['month']=='Jun' )
		{ 
			for($i=0;$i<2;$i++)
			{ 
				$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
			} 
		}
		else if($data['activeperiod'][0]['month']=='Jul' || $data['activeperiod'][0]['month']=='Aug' || $data['activeperiod'][0]['month']=='Sep' )
		{ 
			for($i=0;$i<3;$i++)
			{ 
				$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
			} 
		}
		else if($data['activeperiod'][0]['month']=='Oct' || $data['activeperiod'][0]['month']=='Nov' || $data['activeperiod'][0]['month']=='Dec' )
		{ 
			for($i=0;$i<4;$i++)
			{ 
				$this->calculateparentactualtarget($_POST['idmeasure'], $_POST['idview'], $monthz[$i]); 
			} 
		}
		*/

		redirect('maincontroller/hirarkikpi/'.$_POST['idview']);
	}
	
	public function recursiveIndexParent( $idmeasureparent , $idview )
	{
		/**
		*	Recursive function to update parent from parent from parent and so on
		*/
		$Qperiodtype = $this->db->query('SELECT storageperiod FROM tblmeasure WHERE idmeasure = "'.$idmeasureparent.'" LIMIT 1');
		if($Qperiodtype->num_rows() > 0){foreach($Qperiodtype->result_array() as $rowperiodtype){
			$periodtype = $rowperiodtype['storageperiod'];
		}}

		
		if( $periodtype == 'month' )
		{
			$monthz = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
			//print_r( $monthz);exit();
			
			foreach($monthz as $key => $value) {
				switch( $monthz[$key] )
				{
					case 'jan' :{ for($i=0;$i<1;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'feb' :{ for($i=0;$i<2;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'mar' :{ for($i=0;$i<3;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'apr' :{ for($i=0;$i<4;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'mei' :{ for($i=0;$i<5;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'jun' :{ for($i=0;$i<6;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'jul' :{ for($i=0;$i<7;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'aug' :{ for($i=0;$i<8;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'sep' :{ for($i=0;$i<9;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'okt' :{ for($i=0;$i<10;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'nop' :{ for($i=0;$i<11;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'des' :{ for($i=0;$i<12;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
				}
			}
		}
		else if( $periodtype == 'quarter' )
		{
			$monthz = array('Q1','Q2','Q3','Q4');
			foreach($monthz as $key => $value) {
				switch( $monthz[$key] )
				{
					case 'Q1' :{ for($i=0;$i<1;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'Q2' :{ for($i=0;$i<2;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'Q3' :{ for($i=0;$i<3;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
					case 'Q4' :{ for($i=0;$i<4;$i++){ $this->calculateparentactualtarget($idmeasureparent, $idview, $monthz[$i]); } break; }
				}
			}
		}
		else if( $periodtype == 'week' )
		{
			$monthz = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
		}
		/**
		*	Recursive function to update parent from parent from parent and so on
		*/
	}
	
	
	/* perhitungan index dihitung berdasarkan tipe consolidation functions 
	 * jika bertipe sum maka dihitung total dari awal periode sampai periode yang terakhir
	 * jika bertipe avg maka dihitung rata-rata dari semua periode
	 * jika takelastknownvalue maka diambil dari periode terakhir
	*/
	public function hitungindex ( $idmeasure , $idview )
	{
		/* get tipe consolidation functions */
		$Q = $this->db->query('SELECT consolidationfunctions , storageperiod , polarity FROM tblmeasure WHERE idmeasure = "'.$idmeasure.'" limit 1');
        if($Q->num_rows() > 0){
			foreach($Q->result_array() as $row){
				$tipeconsf = $row['consolidationfunctions'];
				$storperiod = $row['storageperiod'];
				$polarity =  $row['polarity'];
			}
		}
		
		$this->indexmonth( $idmeasure , $idview , $polarity , $tipeconsf , $storperiod );
	}
	
	public function indexmonth( $idmeasure , $idview , $polarity , $tipeconsf , $storperiod )
	{
		$years = $this->getPeriodMonth();
		$yearsmin1 = $years[0]['year'] - 1;

		//echo $storperiod;exit;
		if ( $storperiod == 'month' )
		{
			$dataperiod = array('jan','feb','mar','apr','mei','jun','jul','aug','sep','okt','nop','des');
		}
		else if ( $storperiod == 'quarter' )
		{
			$dataperiod = array('Q1','Q2','Q3','Q4');
		}
		else if ( $storperiod == 'week' )
		{
			$dataperiod = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
		}
		
		$totalactual = 0;
		$totaltarget = 0;
		$totalseries1 = 0;
		$totalseries2 = 0;
		
		$i = 0;
		foreach($dataperiod as $k=>$v)
		{
			$Q = $this->db->query('SELECT actual , target, series1, series2 FROM tbldetail WHERE idmeasure = "'.$idmeasure.'" AND idview = "'.$idview.'" AND periodname = "'.$v.'" AND `year`="'.$years[0]['year'].'" limit 1');
			
			if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
				$actual = $row['actual'];
				$target = $row['target'];
				$series1 = $row['series1'];
				$series2 = $row['series2'];
			}}
			
			$totalactual += $actual;
			$totaltarget += $target;
			$totalseries1 += $series1;
			$totalseries2 += $series2;
			
			/* nilai counter untuk menghitung rata-rata */
			$i += 1;
			
			/* pemilihan kondisi consolidation sum atau avg */
			if ( $tipeconsf == 'sum' )
			{
				$realactual = $totalactual;
				$realtarget = $totaltarget;
				$realseries1 = $totalseries1;
				$realseries2 = $totalseries2;
			}
			else if ( $tipeconsf == 'avg' )
			{
				$realactual = $totalactual / $i;
				$realtarget = $totaltarget / $i;
				$realseries1 = $totalseries1 / $i;
				$realseries2 = $totalseries2 / $i;
			}
			else if ( $tipeconsf == 'lastval' )
			{
				$realactual = $actual;
				$realtarget = $target;	
				$realseries1 = $series1;
				$realseries2 = $series2; 
			}
			/* pemilihan kondisi polarity good atau bad */
			if ( $polarity == 'good' ) 
			{
				/* official index formula 
					"good"	index = (100+((Actual-Target)/Target) x 100%)
				*/
				if ( $actual == 0 && $target == 0 ) { $index = 0; } else 
				{ $index = 100 + ((( $realactual - $realtarget ) / $realtarget )*100); }
				
				/* index series1 */
				if ( $series1 == 0 && $target == 0 ) { $indexseries1 = 0; } else 
				{ $indexseries1 = 100 + ((( $realseries1 - $realtarget ) / $realtarget )*100); }
				
				/* index series2 */
				if ( $series2 == 0 && $target == 0 ) { $indexseries2 = 0; } else 
				{ $indexseries2 = 100 + ((( $realseries2 - $realtarget ) / $realtarget )*100); }
			}
			else if ( $polarity == 'bad' ) 
			{
				/* official index formula 
					"bad"	index = (100-((Actual-Target)/Target) x 100%)
				*/
				if ( $actual == 0 && $target == 0 ) { $index = 0; } else 
				{ $index = 100 - ((( $realactual - $realtarget ) / $realtarget )*100); }
				
				/* series 1 */
				if ( $series1 == 0 && $target == 0 ) { $indexseries1 = 0; } else 
				{ $indexseries1 = 100 - ((( $realseries1 - $realtarget ) / $realtarget )*100); }
				
				/* series 2 */
				if ( $series2 == 0 && $target == 0 ) { $indexseries2 = 0; } else 
				{ $indexseries2 = 100 - ((( $realseries2 - $realtarget ) / $realtarget )*100); }
			}
			
			$dataindex = array(
				'index' => number_format( $index,1 ),
				'series1index' => number_format( $indexseries1,1 ),
				'series2index' => number_format( $indexseries2,1 )
			);
			$this->db->where('idmeasure', $idmeasure);
			$this->db->where('idview', $idview);
			$this->db->where('periodname', $v);
			$this->db->where('year', $years[0]['year']);
			$this->db->update('tbldetail', $dataindex);	
			
		}
		
	}
	/* End actual target value */

	/*	proses edit active period
	*/
	public function proseseditperiod()
	{
		$data = array(
			'name' => $this->input->post('monthperiod').' '.$this->input->post('yearperiod'),
			'month' => htmlentities(mysql_real_escape_string($this->input->post('monthperiod')), ENT_QUOTES),
			'year' => htmlentities(mysql_real_escape_string($this->input->post('yearperiod')), ENT_QUOTES)
		);
		//print_r($data);exit;
		$this->db->where('iddb', $_SESSION['dbuserlogged']);
		$this->db->where('idperiod', $this->input->post('idperiod'));
		$this->db->update('tblperiod', $data);	

		redirect('maincontroller/setupperiod');
	}	

	public function getactiveperiod()
	{
		$data = array();
		$this->db->where('iddb', $_SESSION['dbuserlogged']);
        $Q = $this->db->get('tblperiod');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function deleteviews($idview)
	{
		/* delete from tblmeasure */
		$this->db->where('idview', $idview);
		$this->db->delete('tblviews');
		
		$this->db->where('idview', $idview);
		$this->db->delete('tblhirarkikpi');
		
		$this->db->where('idview', $idview);
		$this->db->delete('tbldetail');
		
		$this->db->where('idview', $idview);
		$this->db->delete('tblweight');
		
		redirect('maincontroller/setupviews');
	}
	
	public function deletelocations($idlocation)
	{
		$this->db->where('idlocation', $idlocation);
		$this->db->delete('tbllocation');
		
		redirect('maincontroller/setuplocations');
	}

	/*-----------------------------------------------------------------------------------------
	*	Setup Performance Ranges
	*/
	public function saveranges()
	{
		$iddb = $_SESSION['dbuserlogged'];
		
		/*	lakukan pencarian iddb berdasarkan iddb yang diterima */
		$this->db->where('iddb', $iddb);
		$Q = $this->db->get('tblperformanceranges');

        if($Q->num_rows() > 0){
        	/*	jika iddb sudah ada pada tabel maka do update */
        	$data = array(
				'namerange1' => htmlentities(mysql_real_escape_string($this->input->post('identifier1')), ENT_QUOTES),
				'valuebottom1' => htmlentities(mysql_real_escape_string($this->input->post('begins1')), ENT_QUOTES),
				'valuetop1' => htmlentities(mysql_real_escape_string($this->input->post('ends1')), ENT_QUOTES),
				'colors1' => htmlentities(mysql_real_escape_string($this->input->post('colors1')), ENT_QUOTES),
				'namerange2' => htmlentities(mysql_real_escape_string($this->input->post('identifier2')), ENT_QUOTES),
				'valuebottom2' => htmlentities(mysql_real_escape_string($this->input->post('begins2')), ENT_QUOTES),
				'valuetop2' => htmlentities(mysql_real_escape_string($this->input->post('ends2')), ENT_QUOTES),
				'colors2' => htmlentities(mysql_real_escape_string($this->input->post('colors2')), ENT_QUOTES),
				'namerange3' => htmlentities(mysql_real_escape_string($this->input->post('identifier3')), ENT_QUOTES),
				'valuebottom3' => htmlentities(mysql_real_escape_string($this->input->post('begins3')), ENT_QUOTES),
				'valuetop3' => htmlentities(mysql_real_escape_string($this->input->post('ends3')), ENT_QUOTES),
				'colors3' => htmlentities(mysql_real_escape_string($this->input->post('colors3')), ENT_QUOTES),
				'namerange4' => htmlentities(mysql_real_escape_string($this->input->post('identifier4')), ENT_QUOTES),
				'valuebottom4' => htmlentities(mysql_real_escape_string($this->input->post('begins4')), ENT_QUOTES),
				'valuetop4' => htmlentities(mysql_real_escape_string($this->input->post('ends4')), ENT_QUOTES),
				'colors4' => htmlentities(mysql_real_escape_string($this->input->post('colors4')), ENT_QUOTES),
				'namerange5' => htmlentities(mysql_real_escape_string($this->input->post('identifier5')), ENT_QUOTES),
				'valuebottom5' => htmlentities(mysql_real_escape_string($this->input->post('begins5')), ENT_QUOTES),
				'valuetop5' => htmlentities(mysql_real_escape_string($this->input->post('ends5')), ENT_QUOTES),
				'colors5' => htmlentities(mysql_real_escape_string($this->input->post('colors5')), ENT_QUOTES)
			);
			$this->db->where('iddb', $iddb);
			$this->db->update('tblperformanceranges', $data);

        } else if($Q->num_rows() < 1){
        	/* 	jika iddb belum ada pada tabel maka do insert */
        	$data = array(
				'idranges' => rand(111111,999999),
				'iddb' => $iddb,
				'namerange1' => htmlentities(mysql_real_escape_string($this->input->post('identifier1')), ENT_QUOTES),
				'valuebottom1' => htmlentities(mysql_real_escape_string($this->input->post('begins1')), ENT_QUOTES),
				'valuetop1' => htmlentities(mysql_real_escape_string($this->input->post('ends1')), ENT_QUOTES),
				'colors1' => htmlentities(mysql_real_escape_string($this->input->post('colors1')), ENT_QUOTES),
				'namerange2' => htmlentities(mysql_real_escape_string($this->input->post('identifier2')), ENT_QUOTES),
				'valuebottom2' => htmlentities(mysql_real_escape_string($this->input->post('begins2')), ENT_QUOTES),
				'valuetop2' => htmlentities(mysql_real_escape_string($this->input->post('ends2')), ENT_QUOTES),
				'colors2' => htmlentities(mysql_real_escape_string($this->input->post('colors2')), ENT_QUOTES),
				'namerange3' => htmlentities(mysql_real_escape_string($this->input->post('identifier3')), ENT_QUOTES),
				'valuebottom3' => htmlentities(mysql_real_escape_string($this->input->post('begins3')), ENT_QUOTES),
				'valuetop3' => htmlentities(mysql_real_escape_string($this->input->post('ends3')), ENT_QUOTES),
				'colors3' => htmlentities(mysql_real_escape_string($this->input->post('colors3')), ENT_QUOTES),
				'namerange4' => htmlentities(mysql_real_escape_string($this->input->post('identifier4')), ENT_QUOTES),
				'valuebottom4' => htmlentities(mysql_real_escape_string($this->input->post('begins4')), ENT_QUOTES),
				'valuetop4' => htmlentities(mysql_real_escape_string($this->input->post('ends4')), ENT_QUOTES),
				'colors4' => htmlentities(mysql_real_escape_string($this->input->post('colors4')), ENT_QUOTES),
				'namerange5' => htmlentities(mysql_real_escape_string($this->input->post('identifier5')), ENT_QUOTES),
				'valuebottom5' => htmlentities(mysql_real_escape_string($this->input->post('begins5')), ENT_QUOTES),
				'valuetop5' => htmlentities(mysql_real_escape_string($this->input->post('ends5')), ENT_QUOTES),
				'colors5' => htmlentities(mysql_real_escape_string($this->input->post('colors5')), ENT_QUOTES)
			);
			$this->db->insert('tblperformanceranges', $data);	
        }
		
		redirect('maincontroller/setupperformanceranges');
	}
	/* End performance ranges */
	
	/*-------------------------------------------------------------------------------------------------------------
	 *	Database
	*/
	
	public function editdatabase()
	{
		$iddb = htmlentities(mysql_real_escape_string($this->input->post('iddb')), ENT_QUOTES);
		$data = array(
			'dbname'  => htmlentities(mysql_real_escape_string($this->input->post('databasename')), ENT_QUOTES),
			'startyear'  => htmlentities(mysql_real_escape_string($this->input->post('startyear')), ENT_QUOTES),
			'endyear'  => htmlentities(mysql_real_escape_string($this->input->post('endyear')), ENT_QUOTES),
			'yearfirstday'  => htmlentities(mysql_real_escape_string($this->input->post('yearstart')), ENT_QUOTES)
		);
		$this->db->where('iddb', $iddb);
		$this->db->update('tbldatabase', $data);
		redirect('maincontroller/setupdatabase');	
	}
	
	public function getdatabasebyid($iddb)
	{
		$data = array();
		$this->db->where('iddb', $iddb);
        $Q = $this->db->get('tbldatabase');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function createdatabase()
	{
		/* 	lakukan pencarian admin pada tbldbuser sesuai dengan admin yang login
			jika tidak ada maka do insert admin baru, jika tidak merubah userdb maka admin tsb
			memiliki lebih dari satu db 
		
		$Qrecord = $this->db->query("SELECT COUNT(iddb) as JMLDB FROM tbldatabase");
		if($Qrecord->num_rows() > 0){
			foreach($Qrecord->result_array() as $row){
				$jml = $row['JMLDB'];
			}
		}
		
		if($jml >= 2){
			$this->session->set_flashdata('error', 'Maximum database 2 record!');
            redirect('maincontroller/createdatabase','refresh');
		}
		*/
		$Qrecord = $this->db->query("SELECT COUNT(iddb) as JMLDB FROM tbldatabase");
		if($Qrecord->num_rows() > 0){ foreach($Qrecord->result_array() as $row){ $jml = $row['JMLDB']; } }
		
		$Qmaxdb = $this->db->query('SELECT maxdb FROM tblcompanyconfig');
		if($Qmaxdb->num_rows() > 0){ foreach($Qmaxdb->result_array() as $row){ $maxdb = $row['maxdb']; } }
		
		if($jml >= $maxdb){
			$this->session->set_flashdata('error', 'Maximum database '.$maxdb.' record');
            redirect('maincontroller/createdatabase','refresh');
		}
		
		$startyear = htmlentities(mysql_real_escape_string($this->input->post('startyear')), ENT_QUOTES);
		$endyear = htmlentities(mysql_real_escape_string($this->input->post('endyear')), ENT_QUOTES);
		if($endyear - $startyear > 10){
			$this->session->set_flashdata('error', 'Maximum period 10 years!');
            redirect('maincontroller/createdatabase','refresh');
		}
			
		$iddb = rand(111111,999999);

		$data = array(
			'iddb' => $iddb, 
			'dbname' => htmlentities(mysql_real_escape_string($this->input->post('databasename')), ENT_QUOTES), 
			'startyear' => htmlentities(mysql_real_escape_string($this->input->post('startyear')), ENT_QUOTES), 
			'endyear' => htmlentities(mysql_real_escape_string($this->input->post('endyear')), ENT_QUOTES), 
			'yearfirstday' => htmlentities(mysql_real_escape_string($this->input->post('yearstart')), ENT_QUOTES), 
		);
		$this->db->insert('tbldatabase', $data);
		
		$dataperiod = array(
			'iddb' => $iddb, 
			'idperiod' => rand(111111,999999),
			'name' => substr(htmlentities(mysql_real_escape_string($this->input->post('yearstart')), ENT_QUOTES),0,3).' '.htmlentities(mysql_real_escape_string($this->input->post('startyear')), ENT_QUOTES),
			'month' => substr(htmlentities(mysql_real_escape_string($this->input->post('yearstart')), ENT_QUOTES),0,3),
			'year' => htmlentities(mysql_real_escape_string($this->input->post('startyear')), ENT_QUOTES)
		);
		$this->db->insert('tblperiod', $dataperiod);
		
		/* add hak akses khusus admin pada setiap pembuatan database baru */
		$Quseradmin = $this->db->query('SELECT idusers FROM tblusers WHERE level = "admin" ');
		if($Quseradmin->num_rows() > 0){ foreach($Quseradmin->result_array() as $row){ 
			$dataassigndb = array(
				'iddb' => $iddb,
				'idusers' => $row['idusers'],
				'status' => 'signed',
				'active' => '0',
				'accesssetup' => 'signed'
			);
			$this->db->insert('tblassigndb', $dataassigndb);
		} }
		
		
		redirect('maincontroller/setupdatabase');	
	}

	/* mengambil daftar database dari tbldatabase */
	public function listdatabases()
	{
		$data = array();
        $Q = $this->db->get('tbldatabase');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}

	/* menampilkan data user yang memiliki hak akses pada database */
	public function daftarusers($iddb)
	{
		$data = array();
		
		$Qcreateview = $this->db->query('CREATE VIEW vassigndb AS SELECT * FROM tblassigndb WHERE iddb = '.$iddb );
		
        $Q = $this->db->query('SELECT `tblusers`.`idusers`, `tblusers`.`name`, `tblusers`.`description`, `tblusers`.`email`, `vassigndb`.`status`, `vassigndb`.`accesssetup`  FROM `tblusers` LEFT JOIN `vassigndb` ON `tblusers`.`idusers` = `vassigndb`.`idusers` WHERE `tblusers`.level != "admin" ORDER BY `tblusers`.`name` ');
		
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
		
		/* drop view assigndb for next use, when idview was changed */
        $Qdropview = $this->db->query('DROP VIEW vassigndb');
		
        return $data;
	}

	/* menambahkan hak akses user pada sebuah database */
	public function savetouserdb()
	{
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$data = array(
			'iddb' => $iddb,
			'idusers' => $idusers,
			'status' => 'signed'
		);
		$this->db->insert('tblassigndb', $data);
		redirect('maincontroller/assignusersdb/'.$iddb);
	}
	
	/* menghapus hak akses user pada sebuah database */
	public function removefromuserdb()
	{
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$this->db->where('iddb', $iddb);
		$this->db->where('idusers', $idusers);
		$this->db->delete('tblassigndb');
		redirect('maincontroller/assignusersdb/'.$iddb);
	}

	/* menambil dbname dari sebuah database */
	public function getdb()
	{
		$data = array();
		$iddb = $this->uri->segment(3);
		$this->db->select('dbname');
		$this->db->where('iddb', $iddb);
		$Q = $this->db->get('tbldatabase');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}

	/* menampilkan daftar view dari sebuah database */
	public function getdbview()
	{
		$data = array();
		$iddb = $this->uri->segment(3);
		$Q = $this->db->query('SELECT  tblviews.`idview`, tblviews.`name`, tblviews.`description`, tblmeasure.`name` AS topmeasure, tblviews.`displayby` FROM tblviews INNER JOIN tblmeasure ON tblviews.`topmeasure` = tblmeasure.`idmeasure` WHERE tblviews.`iddb` = '.$iddb);
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}

	/* mengambil data user yang memiliki hak akses terhadap view */
	public function daftaruserview($idview)
	{
		$data = array();
        
        /* create temporary view to save data per idview on tblassignview */
		$Qcreateview = $this->db->query('CREATE VIEW vassignview AS SELECT * FROM tblassignview WHERE idviews = '.$idview.' AND iddb = '.$_SESSION['dbuserlogged']);

		/* display user per accessed view */
        $Q = $this->db->query('SELECT DISTINCT `tblusers`.`idusers`, `tblusers`.`name`, `tblusers`.`description`, `tblusers`.`email`, `vassignview`.`idviews`, `vassignview`.`status` FROM `tblusers` LEFT JOIN `vassignview` ON `tblusers`.`idusers` = `vassignview`.`idusers`   WHERE `tblusers`.`idusers` IN (SELECT tblassigndb.idusers FROM tblassigndb WHERE tblassigndb.iddb = '.$_SESSION['dbuserlogged'].') ORDER BY `tblusers`.`name` ');

        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}

        /* drop view assignview for next use, when idview was changed */
        $Qdropview = $this->db->query('DROP VIEW vassignview');

        return $data;
	}

	public function getviewname($idview){
		$data = array();
        $Q = $this->db->query('SELECT tblviews.`name` FROM tblviews WHERE idview = '.$idview);
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}

	/*	menambahkan hak akses user pada view yang terdapat pada sebuah database */
	public function savetouserview()
	{
		$idview = $this->uri->segment(5);
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$data = array(
			'iddb' => $iddb,
			'idusers' => $idusers,
			'idviews' => $idview,
			'status' => 'signed'
		);
		$this->db->insert('tblassignview', $data);

		/* 	menambahkan daftar measure yang dapat diakses oleh user sesuai dengan view yang dapat diaksesnya data diambil dari tblhirarkikpi 
		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND iddb = "'.$iddb.'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
			
			/* cek apakah idmeasure yang sama dari db dan user yang sama sudah tersimpan untuk menghindari duplikasi, jika duplikat maka skip looping 
			$QExists = $this->db->query('SELECT idmeasure FROM tblmeasuregranttouser WHERE iddb = "'.$iddb.'" AND idusers = "'.$idusers.'" AND idmeasure = "'.$row['idmeasure'].'" ');
			if($QExists->num_rows() > 0){ continue; }

			/* do proses insert pada tblmeasuregranttouser sebagai hak akses user pada measure 
			$datagrant = array(
				'idgrant' => rand(111111,999999),
				'iddb' => $iddb,
				'idview' => $idview,
				'idmeasure' => $row['idmeasure'],
				'idusers' => $idusers,
				'accessmodifier' => 'rw'
			);
			$this->db->insert('tblmeasuregranttouser', $datagrant);
		}}
		*/

		$Q = $this->db->query('SELECT idmeasure FROM tblhirarkikpi WHERE idview = "'.$idview.'" AND iddb = "'.$iddb.'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){
		/* cek apakah idmeasure yang sama dari db dan user yang sama sudah tersimpan untuk menghindari duplikasi, jika duplikat maka skip looping */
		$QExists = $this->db->query('SELECT idmeasure FROM tblmeasuregranttouser WHERE iddb = "'.$iddb.'" AND idusers = "'.$idusers.'" AND idmeasure = "'.$row['idmeasure'].'" ');

		if($QExists->num_rows() > 0){
		}
		else {
			/* do proses insert pada tblmeasuregranttouser sebagai hak akses user pada measure */
			$datagrant = array(
				'idgrant' => rand(111111,999999),
				'iddb' => $iddb,
			//	'idview' => $idview,
				'idmeasure' => $row['idmeasure'],
				'idusers' => $idusers,
				'accessmodifier' => 'rw'
			);
			$this->db->insert('tblmeasuregranttouser', $datagrant);
		}
		}}

		redirect('maincontroller/assignusersview/'.$iddb.'/'.$idview);
	}
	
	/* menghapus hak akses user dari sebuah view */
	public function removefromuserview()
	{
		$idview = $this->uri->segment(5);
		$iddb = $this->uri->segment(4);
		$idusers = $this->uri->segment(3);
		$this->db->where('iddb', $iddb);
		$this->db->where('idusers', $idusers);
		//$this->db->where('idviews', $idview);
		$this->db->delete('tblassignview');

		/* menghapus hak akses user pada measure ketika hak akses terhadap view dicabut */
		$Q = $this->db->query('DELETE FROM tblmeasuregranttouser WHERE iddb ="'.$iddb.'" AND idusers = "'.$idusers.'" ');

		redirect('maincontroller/assignusersview/'.$iddb.'/'.$idview);
	}

	public function getlistdb()
	{
		$data = array();
        $Q = $this->db->query('SELECT * FROM tbldatabase ');
        if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
	public function processcopydatabase($iddb, $iddbNew)
	{
		$Qrecord = $this->db->query("SELECT COUNT(iddb) as JMLDB FROM tbldatabase");
		if($Qrecord->num_rows() > 0){
			foreach($Qrecord->result_array() as $row){
				$jml = $row['JMLDB'];
			}
		}
		
		if($jml >= 2){
			$this->session->set_flashdata('error', 'Maximum database 2 record!');
            redirect('maincontroller/setupdatabase','refresh');
		}
		
		// membuat database baru dengan data sama hanya beda iddb
		$QselectDB = $this->db->query("SELECT * FROM tbldatabase WHERE iddb = '".$iddb."' LIMIT 1 ");
		if($QselectDB->num_rows() > 0){foreach($QselectDB->result_array() as $row){
			$dataDB = array(
				'iddb' => $iddbNew,
				'dbname' => 'Copy '.$row['dbname'],
				'startyear' => $row['startyear'],
				'endyear' => $row['endyear'],
				'yearfirstday' => $row['yearfirstday']
			);
			$this->db->insert('tbldatabase', $dataDB);
		}}
	}
	
	public function processtbltemp($iddb, $iddbNew)
	{
		// mengcopy view dengan iddb baru dan idview baru disimpan di table tbltemp
		$Qselectviews = $this->db->query("SELECT idview FROM tblviews WHERE iddb = '".$iddb."' ");
		if($Qselectviews->num_rows() > 0){foreach($Qselectviews->result_array() as $rowviews){
			$idviewbaru = rand(111111,999999);
			$datatemp = array(
				'iddbbaru' => $iddbNew,
				'idviewlama' => $rowviews['idview'],
				'idviewbaru' => $idviewbaru
			);
			$this->db->insert('tbltemp', $datatemp);
		}}
	}
	
	public function processcopytblmeasure($iddb, $iddbNew)
	{
		// mengganti idmeasure dengan yang baru dan menggunakan iddb yang baru, mencari measure ke tblmeasure
		$QselectMeasure = $this->db->query("SELECT * FROM tblmeasure WHERE iddb = '".$iddb."' ORDER BY idmeasure");
		if($QselectMeasure->num_rows() > 0){foreach($QselectMeasure->result_array() as $rowmeasure){
			$idnewmeasure = rand(111111,999999);
				
			$data = array(
				'idmeasure' => $idnewmeasure,
				'iddb' => $iddbNew,
				'name' => $rowmeasure['name'],
				'description'  => $rowmeasure['description'],
				'categories' => $rowmeasure['categories'],
				'type'    => $rowmeasure['type'],
				'critical'    => $rowmeasure['critical'],
				//'parentmeasure'    => htmlentities(mysql_real_escape_string($this->input->post('parentmeasure')), ENT_QUOTES),
				'polarity'    => $rowmeasure['polarity'],
				'storageperiod'    => $rowmeasure['storageperiod'],
				'unittype'    => $rowmeasure['unittype'],
				'defaultowner'    => $rowmeasure['defaultowner'],
				'consolidationfunctions'    => $rowmeasure['consolidationfunctions'],
				'notes'    => $rowmeasure['notes'],
				'location'    => $rowmeasure['location']
			);
			$this->db->insert('tblmeasure', $data);
		
			$datatbltempmeasure = array(
				'iddbbaru' => $iddbNew,
				'idmeasurelama' => $rowmeasure['idmeasure'],
				'idmeasurebaru' => $idnewmeasure
			);
			$this->db->insert('tbltempmeasure', $datatbltempmeasure);
			
			
			// masing masing untuk iddb dan idmeasure yang lama maka dicopy dengan iddb dan idmeasure yang baru
			$Qselectdatagrant = $this->db->query("SELECT idusers FROM tblmeasuregranttouser WHERE iddb = '".$iddb."' AND idmeasure = '".$rowmeasure['idmeasure']."' LIMIT 1 ");
			if($Qselectdatagrant->num_rows() > 0){foreach($Qselectdatagrant->result_array() as $rowdatagrant){
				
				$datagrant = array(
					'idgrant' => rand(111111,999999),
					'iddb' => $iddbNew,
				//	'idview' => $idview,
					'idmeasure' => $idnewmeasure,
					'idusers' => $rowdatagrant['idusers'],
					'accessmodifier' => 'rw'
				);
				$this->db->insert('tblmeasuregranttouser', $datagrant);
			}}
			
			/*
			// mengganti idmeasure yang lama dengan yang baru
			$Qupdateidmeasure = $this->db->query("UPDATE tblhirarkikpi SET idmeasure = '".$idnewmeasure."' WHERE idmeasure = '".$rowmeasure['idmeasure']."' AND iddb = '".$iddbNew."' ");
			
			// mengganti idparent yang lama sesuai perubahan idmeasure yang baru
			$Qupdateidmeasure = $this->db->query("UPDATE tblhirarkikpi SET parent = '".$idnewmeasure."' WHERE parent = '".$rowmeasure['idmeasure']."' AND iddb = '".$iddbNew."' ");
			*/
			
			$Qselectdetail = $this->db->query("SELECT * FROM tbldetail WHERE idmeasure = '".$rowmeasure['idmeasure']."'");
			if($Qselectdetail->num_rows() > 0){foreach($Qselectdetail->result_array() as $rowdetail){
				
				// cari idview baru berdasarkan iddbbaru dan idview lama pada tbltemp
				$Qselectidviewlama = $this->db->query("SELECT idviewbaru FROM tbltemp WHERE iddbbaru = '".$iddbNew."' AND idviewlama = '".$rowdetail['idview']."' LIMIT 1");
				if($Qselectidviewlama->num_rows() > 0){foreach($Qselectidviewlama->result_array() as $rowidviewlama){ 
					$idviewbarux = $rowidviewlama['idviewbaru']; 
				}}
				
				$datadetail = array(
					'idview' => $idviewbarux,
					'idmeasure' => $idnewmeasure,
					'storageperiod' => $rowdetail['storageperiod'],
					'periodname' => $rowdetail['periodname'],
					'year' => $rowdetail['year'],
					'actual' => $rowdetail['actual'],
					'target' => $rowdetail['target'],
					'index' => $rowdetail['index'],
				);
				$this->db->insert('tbldetail', $datadetail);
			}}
			
			// mengcopy tabel tblweight dengan mengcopy dulu seluruh isi tabel weight dengan idmeasure yang terpanggil lalu ganti dengan yang baru, setelah selesai maka lakukan update satu-satu pada field parent dengan mengambil data dari tbltempmeasure, lalu update satu per satu lagi pada idview dengan data diambil dari tabel tbltemp
			$Qselecttblweight = $this->db->query("SELECT * FROM tblweight WHERE iddb = '".$iddb."' AND idmeasure = '".$rowmeasure['idmeasure']."' LIMIT 1 ");
			if($Qselecttblweight->num_rows() > 0){foreach($Qselecttblweight->result_array() as $rowtblweight){
				$datatblweight = array(
					'idview'		=> $rowtblweight['idview'],
					'idmeasure'		=> $idnewmeasure,
					'iddb'			=> $iddbNew,
					'parent'		=> $rowtblweight['parent'],
					'weight'		=> $rowtblweight['weight'],
					'datecreated'	=> $rowtblweight['datecreated']
				);
				$this->db->insert('tblweight', $datatblweight);
			}}
		}}
	}
	
	public function update_idview_tblweight($iddb, $iddbNew)
	{
		$Qselectidview = $this->db->query("SELECT * FROM tblweight WHERE iddb = '".$iddb."' ");
		if($Qselectidview->num_rows() > 0){foreach($Qselectidview->result_array() as $rowidviews){
		
			// mengganti idview lama di tabel tblweight dengan idview baru
			$Qselectidviewbaru = $this->db->query("SELECT idviewbaru FROM tbltemp WHERE iddbbaru = '".$iddbNew."' AND idviewlama = '".$rowidviews['idview']."' LIMIT 1 ");
			if($Qselectidviewbaru->num_rows() > 0){foreach($Qselectidviewbaru->result_array() as $rowidviewlama){ 
				//$idviewbarux = $rowidviewlama['idviewbaru']; 
				$this->db->query("UPDATE tblweight SET idview = '".$rowidviewlama['idviewbaru']."' WHERE iddb = '".$iddbNew."' AND idview = '".$rowidviews['idview']."' ");
			}}
			
			// mengganti parent lama di tabel tblweight dengan parent baru
			$Qselectidmeasurebaru = $this->db->query("SELECT idmeasurebaru FROM tbltempmeasure WHERE iddbbaru = '".$iddbNew."' AND idmeasurelama = '".$rowidviews['parent']."' LIMIT 1");
			if($Qselectidmeasurebaru->num_rows() > 0){foreach($Qselectidmeasurebaru->result_array() as $rowidmeasurelama){ 		
				//$idmeasurebarux = $rowidmeasurelama['idmeasurebaru']; 
				$this->db->query("UPDATE tblweight SET parent = '".$rowidmeasurelama['idmeasurebaru']."' WHERE iddb = '".$iddbNew."' AND parent = '".$rowidviews['parent']."' ");
			}}
		}}
	}
	
	public function processcopytblviews($iddb, $iddbNew)
	{
		// mengcopy tblviews dengan iddb dan idview yang baru
		$Qselectviews = $this->db->query("SELECT * FROM tblviews WHERE iddb = '".$iddb."' ");
		if($Qselectviews->num_rows() > 0){foreach($Qselectviews->result_array() as $rowviews){
			
			$idmeasurebarux = '';
			$idviewbarux = '';
			
			$Qselectidmeasurebaru = $this->db->query("SELECT idmeasurebaru FROM tbltempmeasure WHERE iddbbaru = '".$iddbNew."' AND idmeasurelama = '".$rowviews['topmeasure']."' LIMIT 1");
			if($Qselectidmeasurebaru->num_rows() > 0){foreach($Qselectidmeasurebaru->result_array() as $rowidmeasurelama){ $idmeasurebarux = $rowidmeasurelama['idmeasurebaru']; }}
			
			// cari idview baru berdasarkan iddbbaru dan idview lama pada tbltemp
			$Qselectidviewlama = $this->db->query("SELECT idviewbaru FROM tbltemp WHERE iddbbaru = '".$iddbNew."' AND idviewlama = '".$rowviews['idview']."' LIMIT 1 ");
			if($Qselectidviewlama->num_rows() > 0){foreach($Qselectidviewlama->result_array() as $rowidviewlama){ $idviewbarux = $rowidviewlama['idviewbaru']; }}
			
			$dataviews = array(
				'idview' => $idviewbarux,
				'iddb' => $iddbNew,
				'name' => $rowviews['name'],
				'description' => $rowviews['description'],
				'categories' => $rowviews['categories'],
				'title' => $rowviews['title'],
				'subtitle' => $rowviews['subtitle'],
				'topmeasure' => $idmeasurebarux,
				'toplocation' => $rowviews['toplocation'],
				'datecreated' => $rowviews['datecreated'],
				'displayby' => $rowviews['displayby']
			);
			
			$this->db->insert('tblviews', $dataviews);
		}}
	}
	
	public function processcopytblhirarkikpi($iddb, $iddbNew)
	{
		// mengcopy data hirarki lama dengan iddb baru
		//$idviewbarux = '';
		//$dviewlamax
		$Qcopyhirarki = $this->db->query("SELECT * FROM tblhirarkikpi WHERE iddb = '".$iddb."' " );
		if($Qcopyhirarki->num_rows() > 0){foreach($Qcopyhirarki->result_array() as $rowcopyhirarki){
			$datacopyhirarki = array(
				'idview' => $rowcopyhirarki['idview'],
				'iddb' => $iddbNew,
				'idmeasure' => $rowcopyhirarki['idmeasure'],
				'parent' => $rowcopyhirarki['parent'],
				'data' => $rowcopyhirarki['data'],
				'datecreated' => $rowcopyhirarki['datecreated']
			);
			$this->db->insert('tblhirarkikpi', $datacopyhirarki);
		}}
		
		/*
		// cari idview baru berdasarkan iddbbaru dan idview lama pada tbltemp
		$Qselectidviewlama = $this->db->query("SELECT idviewbaru, idviewlama FROM tbltemp WHERE iddbbaru = '".$iddbNew."' ");
		if($Qselectidviewlama->num_rows() > 0){foreach($Qselectidviewlama->result_array() as $rowidviewlama){ 
			$idviewbarux = $rowidviewlama['idviewbaru']; 
			$idviewlamax =  $rowidviewlama['idviewlama']; 
		}}
		$Qupdateidmeasure = $this->db->query("UPDATE tblhirarkikpi SET idview = '".$idviewbarux."' WHERE idview = '".$idviewlamax."' AND iddb = '".$iddbNew."' ");
			
		$Qselectidmeasurebaru = $this->db->query("SELECT idmeasurebaru FROM tbltempmeasure WHERE iddbbaru = '".$iddbNew."' AND idmeasurelama = '".$rowviews['topmeasure']."' LIMIT 1");
		if($Qselectidmeasurebaru->num_rows() > 0){foreach($Qselectidmeasurebaru->result_array() as $rowidmeasurelama){ $idmeasurebarux = $rowidmeasurelama['idmeasurebaru']; }}
		*/
	}
	
	public function update_idviewidmeasure_tblhirarkikpi($iddb, $iddbNew)
	{
		$Qselecttblhirarkikpi = $this->db->query("SELECT idview, idmeasure FROM tblhirarkikpi WHERE iddb = '".$iddbNew."' ");
		if($Qselecttblhirarkikpi->num_rows() > 0){foreach($Qselecttblhirarkikpi->result_array() as $rowtblhirarkikpi){ 
			
			$Qselectidviewbaru = $this->db->query("SELECT idviewbaru FROM tbltemp WHERE iddbbaru = '".$iddbNew."' AND idviewlama = '".$rowtblhirarkikpi['idview']."' LIMIT 1 ");
			if($Qselectidviewbaru->num_rows() > 0){foreach($Qselectidviewbaru->result_array() as $rowidviewlama){ 
				//$idviewbarux = $rowidviewlama['idviewbaru']; 
				$this->db->query("UPDATE tblhirarkikpi SET idview = '".$rowidviewlama['idviewbaru']."' WHERE iddb = '".$iddbNew."' AND idview = '".$rowtblhirarkikpi['idview']."' ");
			}}
			
			$Qselectidmeasurebaru = $this->db->query("SELECT idmeasurebaru FROM tbltempmeasure WHERE iddbbaru = '".$iddbNew."' AND idmeasurelama = '".$rowtblhirarkikpi['idmeasure']."' LIMIT 1");
			if($Qselectidmeasurebaru->num_rows() > 0){foreach($Qselectidmeasurebaru->result_array() as $rowidmeasurelama){ 		
				//$idmeasurebarux = $rowidmeasurelama['idmeasurebaru']; 
				$this->db->query("UPDATE tblhirarkikpi SET idmeasure = '".$rowidmeasurelama['idmeasurebaru']."' WHERE iddb = '".$iddbNew."' AND idmeasure = '".$rowtblhirarkikpi['idmeasure']."' ");
				
				//echo "UPDATE tblhirarkikpi SET idmeasure = '".$rowidmeasurelama['idmeasurebaru']."' WHERE iddb = '".$iddbNew."' AND idmeasure = '".$rowtblhirarkikpi['idmeasure']."' "; exit;
			}}
			
		}}
	}
	
	public function processcopyperformancerange($iddb, $iddbNew)
	{
		// mengcopy performance range dengan iddb yang baru
		$Qcopyrange = $this->db->query("SELECT * FROM tblperformanceranges WHERE iddb = '".$iddb."' " );
		if($Qcopyrange->num_rows() > 0){foreach($Qcopyrange->result_array() as $rowcopyrange){
			$datacopyrange = array(
				'idranges' => rand(111111,999999),
				'iddb' => $iddbNew,
				'namerange1' => $rowcopyrange['namerange1'],
				'valuebottom1' => $rowcopyrange['valuebottom1'],
				'valuetop1' => $rowcopyrange['valuetop1'],
				'colors1' => $rowcopyrange['colors1'],
				'namerange2' => $rowcopyrange['namerange2'],
				'valuebottom2' => $rowcopyrange['valuebottom2'],
				'valuetop2' => $rowcopyrange['valuetop2'],
				'colors2' => $rowcopyrange['colors2'],
				'namerange3' => $rowcopyrange['namerange3'],
				'valuebottom3' => $rowcopyrange['valuebottom3'],
				'valuetop3' => $rowcopyrange['valuetop3'],
				'colors3' => $rowcopyrange['colors3'],
				'namerange4' => $rowcopyrange['namerange4'],
				'valuebottom4' => $rowcopyrange['valuebottom4'],
				'valuetop4' => $rowcopyrange['valuetop4'],
				'colors4' => $rowcopyrange['colors4'],
				'namerange5' => $rowcopyrange['namerange5'],
				'valuebottom5' => $rowcopyrange['valuebottom5'],
				'valuetop5' => $rowcopyrange['valuetop5'],
				'colors5' => $rowcopyrange['colors5']
			);
			$this->db->insert('tblperformanceranges', $datacopyrange);
		}}
	}
	
	public function processcopytblperiod($iddb, $iddbNew)
	{
		$idperiod = rand(111111,999999);
		$Qselecttblperiod = $this->db->query("SELECT * FROM tblperiod WHERE iddb = '".$iddb."' ");
		if($Qselecttblperiod->num_rows() > 0){foreach($Qselecttblperiod->result_array() as $rowtblperiod){
			$datatblperiod = array(
				'iddb'		=> $iddbNew,
				'idperiod'	=> $idperiod,
				'name'		=> $rowtblperiod['name'],
				'month'		=> $rowtblperiod['month'],
				'year'		=> $rowtblperiod['year']
			);
			$this->db->insert('tblperiod', $datatblperiod);
		}}
	}
	
	public function processcopytblassigndb($iddb, $iddbNew)
	{
		$Qselecttblassigndb = $this->db->query("SELECT * FROM tblassigndb WHERE iddb = '".$iddb."' ");
		if($Qselecttblassigndb->num_rows() > 0){foreach($Qselecttblassigndb->result_array() as $rowtblassigndb){
			$datatblassigndb = array(
				'iddb'		=> $iddbNew,
				'idusers'	=> $rowtblassigndb['idusers'],
				'status'	=> $rowtblassigndb['status'],
				'active'	=> '0'
			);
			$this->db->insert('tblassigndb', $datatblassigndb);
		}}
	}
	
	public function processcopytblassignview($iddb, $iddbNew)
	{
		$Qseelecttblassignview = $this->db->query("SELECT * FROM tblassignview WHERE iddb = '".$iddb."' ");
		if($Qseelecttblassignview->num_rows() > 0){foreach($Qseelecttblassignview->result_array() as $rowtblassignview){
			
			$idviewbarux = '';
			
			$Qselectidviewbaru = $this->db->query("SELECT idviewbaru FROM tbltemp WHERE iddbbaru = '".$iddbNew."' AND idviewlama = '".$rowtblassignview['idviews']."' LIMIT 1 ");
			
			if($Qselectidviewbaru->num_rows() > 0){foreach($Qselectidviewbaru->result_array() as $rowidviewlama){ 
				$idviewbarux = $rowidviewlama['idviewbaru']; 
			}}
			
			$dataassignview = array(
				'iddb'		=> $iddbNew,
				'idviews'	=> $idviewbarux,
				'idusers'	=> $rowtblassignview['idusers'],
				'status'	=> $rowtblassignview['status']
			);
			$this->db->insert('tblassignview', $dataassignview);
		}}
	}
	
	public function copydb($iddb)
	{
		/* hitung jumlah maks database pada satu company */
		$Qmaxdb = $this->db->query('SELECT maxdb FROM tblcompanyconfig');
		if($Qmaxdb->num_rows() > 0){ foreach($Qmaxdb->result_array() as $row){ $maxdb = $row['maxdb']; } }
		
		if($jml >= $maxdb){
			$this->session->set_flashdata('error', 'Maximum database '.$maxdb.' record');
            redirect('maincontroller/setupdatabase','refresh');
		}
		
		// create new database
		$iddbNew = rand(111111,999999);
		
		$this->processcopydatabase($iddb, $iddbNew);
		
		$this->processtbltemp($iddb, $iddbNew);
		
		$this->processcopytblmeasure($iddb, $iddbNew);
		
		$this->update_idview_tblweight($iddb, $iddbNew);
		
		$this->processcopytblviews($iddb, $iddbNew);
		
		$this->processcopytblhirarkikpi($iddb, $iddbNew);
		
		$this->update_idviewidmeasure_tblhirarkikpi($iddb, $iddbNew);
		
		$this->processcopyperformancerange($iddb, $iddbNew);
		
		$this->processcopytblperiod($iddb, $iddbNew);
		
		$this->processcopytblassigndb($iddb, $iddbNew);
		
		$this->processcopytblassignview($iddb, $iddbNew);
		
		redirect('maincontroller/setupdatabase');
	}
	
	/* End database */

	
	public function saveactcomm()
	{
		$idmeasure = htmlentities(mysql_real_escape_string($this->input->post('idmeasureactcomm')), ENT_QUOTES);
		
		$Qselectactcomm = $this->db->query("SELECT * FROM tblactcomm WHERE iddb = '".$_SESSION['dbuserlogged']."' AND idmeasure = '".$idmeasure."' ");
		
		if($Qselectactcomm->num_rows() > 0){
			$data = array(
				'commentary' => htmlentities(mysql_real_escape_string($this->input->post('comments')), ENT_QUOTES),
				'actionplan' => htmlentities(mysql_real_escape_string($this->input->post('actionplans')), ENT_QUOTES),
			);
			$this->db->where('iddb',$_SESSION['dbuserlogged']);
			$this->db->where('idmeasure',$idmeasure);
			$this->db->update('tblactcomm', $data);
		}
		else if($Qselectactcomm->num_rows() < 1){
			$data = array(
				'iddb' => $_SESSION['dbuserlogged'],
				'idmeasure' => $idmeasure,
				'commentary' => htmlentities(mysql_real_escape_string($this->input->post('comments')), ENT_QUOTES),
				'actionplan' => htmlentities(mysql_real_escape_string($this->input->post('actionplans')), ENT_QUOTES),
			);
			$this->db->insert('tblactcomm', $data);
		}		
	}
	
	public function getPeriodMonth()
	{
		$data = array();
		$Q = $this->db->query('SELECT month,`year` FROM tblperiod WHERE iddb = "'.$_SESSION['dbuserlogged'] .'" ');
		if($Q->num_rows() > 0){foreach($Q->result_array() as $row){$data[] = $row;}}
        return $data;
	}
	
}






