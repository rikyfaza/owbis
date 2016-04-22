<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maincontroller extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		
	}
	 
	public function logout(){
		$Qnonaktif = $this->db->query('UPDATE tblassigndb SET active = 0 WHERE idusers = "'.$_SESSION['iduserlogged'].'" AND iddb = "'.$_SESSION['dbuserlogged'].'" '); 
		unset($_SESSION['logon']);
		unset($_SESSION['iduserlogged']);
        unset($_SESSION['dbuserlogged']);
		unset($_SESSION['company']);
		unset($_SESSION['emailcompany']);
		unset($_SESSION['telpcompany']);
		unset($_SESSION['usernamelog']);
		unset($_SESSION['accesssetup']);
		redirect('maincontroller/index');
	}

	public function index()
	{
		//$this->dashboard();
		//$a = 'admin';
		//print $this->msetup->generateHash($a);
		//exit;
		
		if(!isset($_SESSION['logon'])) {
			$this->signin();
		} else {
			$this->dashboard();
		} 
	}
	
	public function dashboard()
	{
		$data['content'] = 'dashboard/index';
		$data['profile'] = $this->muser->getprofile();
		$_SESSION['company']=$data['profile'][0]['namecompany'];
		$_SESSION['telpcompany']=$data['profile'][0]['telpcompany'];
		$_SESSION['emailcompany']=$data['profile'][0]['emailcompany'];
		$data['listViews'] = $this->msetup->getAlViews($_SESSION['iduserlogged'], $_SESSION['userlevel']);
		
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	public function signin()
	{
		$data['listdb'] = $this->msetup->getlistdb();
		$data['content'] = 'dashboard/signin';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	/*
	*	function untuk mengenerate data json untuk pembentuk hirarki
	*/
	public function gethirarkikpi()
	{
		//echo $_SESSION['curperiod'];exit;
		$idview = $this->uri->segment(3);
		$idperiodname = $this->uri->segment(4);
		$yearname = $this->uri->segment(5);
		//echo $idperiodname;exit;
		$data['hirarkikpi'] = $this->hirarki->getHirarkiKPI2('0',$idview, $idperiodname, $yearname);
		//print_r($data['hirarkikpi']);exit;
		$write = json_encode($data['hirarkikpi']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function gethirarkikpibylocation()
	{
		$data['hirarkikpi'] = $this->hirarki->getHirarkiKPIbyLocation('0');
		$write = json_encode($data['hirarkikpi']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function gethirarkikpibyowner()
	{
		$data['hirarkikpi'] = $this->hirarki->getHirarkiKPIbyOwner('0');
		$write = json_encode($data['hirarkikpi']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function hirarkikpi()
	{
		$idview = $this->uri->segment(3);
		$data['content'] = 'dashboard/hirarkikpi';
		$data['idview'] = $this->uri->segment(3);
		$data['infoview'] = $this->hirarki->getinfoview($idview);
		$data['infomonthactive'] = $this->hirarki->getinfomonthactive($idview);
		$this->load->vars($data);
		$this->load->view('template', $data);
		
	}
	
	public function getdatachartxy()
	{
		$idview = $this->uri->segment(3);
		$idmeasure = $this->uri->segment(4);
		$this->load->library('fusioncharts');
		$data = array();
		
		$FC = new FusionCharts("MSLine","450","400");

		$FC->setSWFPath(base_url()."Charts/");
		
		$strParam="caption=Pencapaian Target;labelDisplay=Rotate;slantLabels=1;xAxisName=Periode;decimalPrecision=0;";

		$FC->setChartParams($strParam);
		
		
		
		$data['datachart'] = $this->hirarki->getdatachartxy($idview, $idmeasure);
		
		foreach($data['datachart'] as $row){
			$FC->addCategory($row['periodname']);
		}
			
			$FC->addDataset("Actual");
			foreach($data['datachart'] as $row1){
			$FC->addChartData($row1['actual']);
			}
			$FC->addDataset("Target");
			foreach($data['datachart'] as $row2){
			$FC->addChartData($row2['target']);
			}
			$FC->addDataset("Index");
			foreach($data['datachart'] as $row3){
			$FC->addChartData($row3['index']);
			}
		
		print $FC->getXML();
	}
	
	public function hirarkikpibylocation()
	{
		$data['content'] = 'dashboard/hirarkikpibylocation';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function hirarkikpibyowner()
	{
		$data['content'] = 'dashboard/hirarkikpibyowner';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setupmeasure()
	{
		$searchMeasureKeyword = $this->input->post('searchmeasure');
		
		$data = array();
		if(!isset($searchMeasureKeyword)){ $data['listMeasures'] = $this->msetup->getAllMeasures(); }
		else { $data['listMeasures'] = $this->msetup->getAllMeasuresKeyword($searchMeasureKeyword); }
		$data['content'] = 'measure/index';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setuplocations()
	{
		$data['content'] = 'measure/indexlocation';
		$data['listLocations'] = $this->msetup->getAllLocations();
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setupunittype()
	{
		$data['content'] = 'measure/indexunittype';
		$data['listUnitType'] = $this->msetup->getAllUnitType();
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setupusers()
	{
		$data['content'] = 'measure/indexusers';
		$data['listUsers'] = $this->msetup->getAllUsers($_SESSION['userlevel']);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setupviews()
	{
		$data['content'] = 'measure/indexview';
		$data['listViews'] = $this->msetup->getAlViews($_SESSION['iduserlogged'], $_SESSION['userlevel']);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function submeasures()
	{
		$data['content'] = 'measure/submeasure';
		$idmeasure = $this->uri->segment(3);
		
		$data['jmllistview'] = $this->msetup->getjmlregisteredview($idmeasure);
		$data['listview'] = $this->msetup->getregisteredview($idmeasure);
		$data['parentmeasure'] = $idmeasure;
		$data['listmeasure'] = $this->msetup->getlistmeasure($idmeasure);
		$data['idview'] = $this->msetup->getidview($idmeasure);
		$data['measurename'] = $this->msetup->getmeasurename($idmeasure);
		$data['terdaftardiview'] = $this->msetup->terdaftardiview($idmeasure);
		$data['submeasurediweight'] = $this->msetup->getsubmeasurediweight($idmeasure);
		
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function getinfomeasure()
	{
		$data = array();
		$idmeasure = $this->uri->segment(3);
		$data['jenismeasure'] = $this->hirarki->getinfomeasure($idmeasure);
		$write = json_encode($data['jenismeasure']);
		$baru = substr($write,1,-1);
		
		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	 
	public function getinfomeasureall() 
	{
		$data = array();
		$idmeasure = $this->uri->segment(3);
		$data['jenismeasure'] = $this->hirarki->getinfomeasureall();
		//echo json_encode($data);
	
		
		$write = json_encode($data['jenismeasure']);
		$baru = substr($write,1,-1);
		
		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
		
	}
	
	public function gettbldetail()
	{
		$data = array();
		
		$idview = $this->uri->segment(3);
		$idmeasure = $this->uri->segment(4);
		$periodname = $this->uri->segment(5);
		
		$data['perioddata'] = $this->hirarki->gettbldetail($idview, $idmeasure, $periodname);
		//$data['perioddata'] = $this->hirarki->gettbldetail($idview, $idmeasure);
		$write = json_encode($data['perioddata']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function getseries()
	{
		$data = array();
		
		$iddb = $this->uri->segment(3);
		$idmeasure = $this->uri->segment(4);
		$seriestype = $this->uri->segment(5);
		
		$data['dataseriesexists'] = $this->hirarki->getseries( $iddb, $idmeasure, $seriestype );
		$write = json_encode($data['dataseriesexists']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function setupperiod()
	{
		$data['activeperiod'] = $this->msetup->getactiveperiod();
		$data['content'] = 'measure/indexperiod';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
 
	public function getinfomonthperiod()
	{
	//	print 'a';exit;
		$data = array();
		
		$data['activeperiod'] = $this->msetup->getactiveperiod();
		$write = json_encode($data['activeperiod']);
		$baru = substr($write,1,-1);
		
		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
	
	public function setupdatabase()
	{
		$data['listdatabases'] = $this->msetup->listdatabases();
		$data['content'] = 'databases/indexdatabase';
		$this->load->vars($data);
		$this->load->view('template', $data);
	} 

	public function setupperformanceranges()
	{
		$data['content'] = 'setup/indexperformanceranges';
		$data['dataranges'] = $this->hirarki->gettblranges($_SESSION['dbuserlogged']);
		$this->load->vars($data); 
		$this->load->view('template', $data);	
	}

	public function gettblranges()
	{
		$data = array();
		
		$iddb = $_SESSION['dbuserlogged'];
		$ranges = $this->uri->segment(4);
		$data['rangesdata'] = $this->hirarki->gettblranges($iddb, $ranges);
		
		$write = json_encode($data['rangesdata']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}


	/*-----------------------------------------------------------------------------------------
	*	Setup Database
	*/
	public function createdatabase()
	{
		$data['content'] = 'databases/createdatabase';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editdatabase()
	{
		$iddb = $this->uri->segment(3);
		$data['content'] = 'databases/editdatabase';
		$data['database'] = $this->msetup->getdatabasebyid($iddb);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	public function assignusersdb()
	{
		$iddb = $this->uri->segment(3);
		$data['dbname']	= $this->msetup->getdb();
		$data['daftarusers'] = $this->msetup->daftarusers($iddb);
		$data['content'] = 'databases/indexassign';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	public function listviews()
	{
		$iddb = $this->uri->segment(3);
		$data['daftarview']	= $this->msetup->getdbview();
		$data['content'] = 'databases/indexviews';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	public function assignusersview()
	{
		$iddb = $this->uri->segment(3);
		$idview = $this->uri->segment(4);
		$data['idviewx'] = $idview;
		$data['viewname'] = $this->msetup->getviewname($idview);
		$data['daftaruserview']	= $this->msetup->daftaruserview($idview);
		$data['content'] = 'databases/indexviewusers';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	/* End database */

	public function getactcomm()
	{
		$data = array();
		
		$iddb = $this->uri->segment(3);
		$idmeasure = $this->uri->segment(4);
		
		$data['actcomm'] = $this->hirarki->getactcomm($iddb, $idmeasure);
		$write = json_encode($data['actcomm']);
		$baru = substr($write,1,-1);

		$order = '"data":""';
		$replace = '"data":{}';
		$baru = str_replace($order, $replace, $baru);
		echo $baru;
	}
		
	public function profile()
	{
		$data['siteTitle'] = 'Performance Information System';
		$data['profile'] = $this->muser->getprofile();
		$data['content'] = 'dashboard/profile';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function setupCompany()
	{
		$this->load->model('msetup2');
		$data['profile'] = $this->muser->getprofile();
		$data['companyConfig'] = $this->msetup2->getCompanyConfig();
		$data['content'] = 'dashboard/companyconfig';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function searchMeasure()
	{
		$this->load->model('msetup2');
		$data = array();
		$term = trim(strip_tags($_GET['term'])); 
		$a_json = array();
		$a_json_row = array();
		$data['searchTerm'] = $this->msetup2->searchMeasure( $term );
		echo json_encode($data['searchTerm']);
	}
	
	public function setupreport()
	{
		$this->load->model('msetup2');
		$data['listreport'] = $this->msetup2->getListReport( $_SESSION['dbuserlogged'] );
		$data['content'] = 'report/indexreport';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function sinkronisasidatabase(){
		$this->load->model('msetup2');
		$data['getperawalakhir'] = $this->msetup2->getperawalakhir();
		$data['content'] = 'databases/sinkronisasidatabase';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
}



