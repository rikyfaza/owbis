<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
	}
	
	/*-----------------------------------------------------------------------------------------
	*	Measure
	*/
	public function createmeasures()
	{
		$data['content'] = 'measure/createmeasures';
		$data['parentmeasure'] = $this->msetup->getAllMeasures();
		$data['unittype'] = $this->msetup->getAllUnitType();
		$data['users'] = $this->msetup->getAllUsers($_SESSION['userlevel']);
		$data['location'] = $this->msetup->getlocations();
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editmeasure()
	{
		$idmeasure = $this->uri->segment(3);
		$data['content'] = 'measure/editmeasures';
		$data['unittype'] = $this->msetup->getAllUnitType();
		$data['users'] = $this->msetup->getAllUsers($_SESSION['userlevel']);
		$data['location'] = $this->msetup->getlocations();
		$data['listMeasures'] = $this->msetup->getmeasurebyid($idmeasure);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function savemeasure()
	{
		$this->msetup->savemeasure();
	}
	
	public function proseseditmeasure()
	{
		$this->msetup->editmeasure();
	}
	
	public function deletemeasure()
	{
		$idmeasure = $this->uri->segment(3);
		$this->msetup->deletemeasure($idmeasure);
	}
	
	public function duplicatemeasure()
	{
		$idmeasure = $this->uri->segment(3);
		$this->msetup->duplicatemeasure($idmeasure);
	}
	
	public function deleteviews()
	{
		$idview = $this->uri->segment(3);
		$this->msetup->deleteviews($idview);
	}
	
	public function deletelocations()
	{
		$idlocation = $this->uri->segment(3); 
		$this->msetup->deletelocations($idlocation);
	}
	
	/*~ End measure */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Unit Type
	*/
	public function createunittype()
	{
		$data['content'] = 'measure/createunittype';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editunittype()
	{
		$data['content'] = 'measure/editunittype';
		$idunittype = $this->uri->segment(3);
		$data['listUnitType'] = $this->msetup->getunittypebyid($idunittype);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function saveunittype()
	{
		$this->msetup->saveunittype();
	}
	
	public function proseseditunittype()
	{
		$this->msetup->editunittype();
	}
	/*~ End unit type */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Location
	*/
	public function createlocations()
	{
		$data['content'] = 'measure/createlocations';
		$data['parentlocations'] = $this->msetup->getAllLocations();
		$data['users'] = $this->msetup->getAllUsers($_SESSION['userlevel']);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editlocations()
	{
		$data['content'] = 'measure/editlocations';
		$idlocation = $this->uri->segment(3);
		$data['listLocations'] = $this->msetup->getlocationsbyid($idlocation);
		$data['parentlocations'] = $this->msetup->getAllLocations();
		$data['users'] = $this->msetup->getAllUsers($_SESSION['userlevel']);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function savelocation()
	{
		$this->msetup->savelocation();
	}
	
	public function proseseditlocation()
	{
		$this->msetup->editlocation();
	}
	/*~ End location */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Users
	*/
	public function createusers()
	{
		$data['content'] = 'measure/createusers';
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editusers()
	{
		$data['content'] = 'measure/editusers';
		$iduser = $this->uri->segment(3);
		$data['listUsers'] = $this->msetup->getusersbyid($iduser);
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function saveusers()
	{
		$this->msetup->saveusers();
	}	
	
	public function proseseditusers()
	{
		$this->msetup->editusers();
	}	

	public function changepasswd()
	{
		$this->msetup->changepasswd();
	}

	public function checkduplicateloginname()
	{
		$this->msetup->checkduplicateloginname();
	}
	
	/*~ End users */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Views
	*/
	public function createviews()
	{
		$data['content'] = 'measure/createviews';
		$data['parentmeasure'] = $this->msetup->getAllMeasures();
		$data['parentlocations'] = $this->msetup->getAllLocations();
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function editviews()
	{
		$idview = $this->uri->segment(3);
		$data['content'] = 'measure/editviews';
		$data['listViews'] = $this->msetup->getviewbyid($idview);
		$data['parentmeasure'] = $this->msetup->getAllMeasures();
		$data['parentlocations'] = $this->msetup->getAllLocations();
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function saveviews()
	{
		$this->msetup->saveviews();
	}
	
	public function proseseditviews()
	{
		$this->msetup->editviews();
	}
	/* End views */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Submeasure
	*/
	public function savesubmeasure()
	{
		$this->msetup->savesubmeasure();
	}
	
	public function savesubmeasureweight()
	{
		$this->msetup->savesubmeasureweight();
	}
	/* End submeasure */
	
	
	/*-----------------------------------------------------------------------------------------
	*	Actual target value
	*/
	public function saveperiodmonth()
	{
		$this->msetup->saveperiodmonth();
	}
	
	public function saveperiodquarter()
	{
		$this->msetup->saveperiodquarter();
	}
	/* End actual target value */

	/*-----------------------------------------------------------------------------------------
	*	Setup period
	*/
	public function editperiod()
	{
		$data['activeperiod'] = $this->msetup->getactiveperiod();
		$data['starttoend'] = $this->msetup->getdatabasebyid($_SESSION['dbuserlogged']);
		$data['content'] = 'measure/editperiod';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}

	public function proseseditperiod()
	{
		$this->msetup->proseseditperiod();	
	}
	/* End setup period */

	/*-----------------------------------------------------------------------------------------
	*	Setup Performance Ranges
	*/
	public function saveranges()
	{
		$this->msetup->saveranges();
	}
	/* End performance ranges */

	public function createdatabase()
	{
		$this->msetup->createdatabase();
	}


	/*-----------------------------------------------------------------------------------------
	*	Setup Database
	*/
	public function savetouserdb()
	{
		$this->msetup->savetouserdb();
	}
	
	public function removefromuserdb()
	{
		$this->msetup->removefromuserdb();
	}

	public function savetouserview()
	{
		$this->msetup->savetouserview();
	}
	
	public function removefromuserview()
	{
		$this->msetup->removefromuserview();
	}

	public function verify()
	{
		if (htmlentities(mysql_real_escape_string($this->input->post('username')), ENT_QUOTES))
		{
			$u = htmlentities(mysql_real_escape_string($this->input->post('username')), ENT_QUOTES);
			$pw = htmlentities(mysql_real_escape_string($this->input->post('password')), ENT_QUOTES);
			$iddb = htmlentities(mysql_real_escape_string($this->input->post('dbname')), ENT_QUOTES);
			
			if($iddb=='0'){
	            $this->session->set_flashdata('error', 'Maaf, Anda belum memilih database!');
	            redirect('maincontroller/index','refresh');
	        } else {
				$this->muser->verifyUser($u,$pw,$iddb);
				
				if ( isset($_SESSION['logon'] ) )
				{
					redirect('maincontroller/index','refresh');
				}	
			}
		}
	}	
	
	public function copydb()
	{
		$iddb = $this->uri->segment(3);
		$this->msetup->copydb($iddb);
	}
	
	public function saveactcomm()
	{
		$this->msetup->saveactcomm();
	}
	
	public function companyprofile()
	{
		$this->muser->companyprofile();
	}
	
	public function editdatabase()
	{
		$this->msetup->editdatabase();
	}
	
	/* delete sub measure from hirarki kpi */
	public function delsubmeasure()
	{
		$idsubmeasure = $this->input->post('idsubmeasure');
		$idview = $this->input->post('idview');
		$parent = $this->input->post('parent');
		$this->msetup->delsubmeasure($idsubmeasure, $idview, $parent);
	}
	
	public function setSecurityMeasure()
	{
		$this->load->model('msetup2');
		
		$data = array();
		$data['listmeasure'] = $this->msetup->getmeasurebyid($this->uri->segment(3));
		//$data['listuser'] = $this->muser->getAllUser();
		$data['listuser'] = $this->muser->getUserNotSelected( $data['listmeasure'][0]['iddb'] , $data['listmeasure'][0]['idmeasure'] );
		$data['selecteduser'] = $this->msetup2->getSelectedUser( $data['listmeasure'][0]['iddb'], $data['listmeasure'][0]['idmeasure'] );
		$data['content'] = 'setup/setsecuritymeasure';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function addUserSecurityMeasure()
	{
		$this->load->model('msetup2');
		$this->msetup2->addUserSecurityMeasure();
	}
	
	public function grantUserSecurityMeasure()
	{
		$this->load->model('msetup2');
		$this->msetup2->grantUserSecurityMeasure();
	}
	
	public function delSecurityMeasure()
	{
		$this->load->model('msetup2');
		$this->msetup2->delSecurityMeasure();
	}
	
	public function customSeries()
	{
		$this->load->model('msetup2');
		$data = array();
		$data['listmeasure'] = $this->msetup->getmeasurebyid( $this->uri->segment(3) );
		$data['listdataseries'] = $this->msetup2->getListDataSeries( $this->uri->segment(3) , $_SESSION['dbuserlogged'] );
		$data['content'] = 'measure/dataseries';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function createseries()
	{
		$idmeasure = $this->uri->segment(3);
		$data['listmeasure'] = $this->msetup->getmeasurebyid( $this->uri->segment(3) );
		$data['content'] = 'measure/createdataseries';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function savedataseries()
	{
		$this->load->model('msetup2');
		$this->msetup2->savedataseries();
	}
	
	public function editDataSeries()
	{
		$this->load->model('msetup2');
		$idmeasure = $this->uri->segment(3);
		$data['inserteddataseries'] = $this->msetup2->getDataSeriesById( $this->uri->segment(3) );
		$data['content'] = 'measure/editdataseries';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function updateSataSeries()
	{
		$this->load->model('msetup2');
		$this->msetup2->updateSataSeries();
	}
	
	public function deleteDataSeries()
	{
		$this->load->model('msetup2');
		$this->msetup2->deleteDataSeries( $this->uri->segment(3), $this->uri->segment(4) );
	}
	
	public function companyConfig()
	{
		$this->load->model('msetup2');
		$this->msetup2->companyConfig();
	}
	
	public function deldb()
	{
		$this->load->model('msetup2');
		$this->msetup2->deldb();
	}
	
	public function createreport()
	{
		$data['content'] = 'report/createreport';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function addmeasuresreport()
	{
		$this->load->model('msetup2');
		$data['listmeasure'] = $this->msetup2->listmeasurereport( $_SESSION['dbuserlogged'] ); 
		$data['selectedmeasure'] = $this->msetup2->getselectedmeasurereport( $_SESSION['dbuserlogged'] , $this->uri->segment(3) );
		$data['content'] = 'report/addmeasuresreport';	
		$this->load->vars($data);
		$this->load->view('template', $data);
	} 
	
	public function savereport()
	{
		$this->load->model('msetup2');
		$this->msetup2->savereport();
	}
	
	public function addSelectedMeasureReport()
	{
		$this->load->model('msetup2');
		$this->msetup2->addSelectedMeasureReport();
	}
	
	public function viewgeneratereport()
	{
		$this->load->model('msetup2');
		$data['inforeport'] = $this->msetup2->getinforeport( $this->uri->segment(3) );
		$data['detailreport'] = $this->msetup2->getdetailreport( $this->uri->segment(3) ,  $data['inforeport'][0]['periodname'] );
		$data['warnabg'] = $this->msetup2->getwarna( $_SESSION['dbuserlogged'] );
		$data['content'] = 'report/viewgeneratereport';	
		
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function generatePDF()
	{
		$this->load->model('msetup2');
		$this->load->helper(array('dompdf', 'file'));
		
		$data['inforeport'] = $this->msetup2->getinforeport( $this->uri->segment(3) );
		$data['detailreport'] = $this->msetup2->getdetailreport( $this->uri->segment(3) ,  $data['inforeport'][0]['periodname'] );
		$data['warnabg'] = $this->msetup2->getwarna( $_SESSION['dbuserlogged'] );
		
		$this->load->vars($data);
		//$this->load->view('report/generatepdf', $data);
		
		$html = $this->load->view('report/generatepdf', $data, true);
		pdf_create($html, $data['inforeport'][0]['namereport']);
	}
	
	public function delmeasurereport()
	{
		$this->load->model('msetup2');
		$idmeasure = $this->input->post('idmeasure');
		$idreport = $this->input->post('idreport');
		
		$this->msetup2->delmeasurereport($idmeasure, $idreport);
	}
	
	public function editreport()
	{
		$this->load->model('msetup2');
		$data['content'] = 'report/editreport';	
		$data['detailreport'] = $this->msetup2->getinforeport( $this->uri->segment(3) );
		$this->load->vars($data);
		$this->load->view('template', $data);
	}
	
	public function updatereport()
	{
		$this->load->model('msetup2');
		$this->msetup2->updatereport();
	}
	
	public function deletereport()
	{
		$this->load->model('msetup2');
		$this->msetup2->deletereport( $this->uri->segment(3) );
	}
	
	public function SynchronizeReport()
	{
		$this->load->model('mchart');
		$this->mchart->SynchronizeReport();
	}

	public function SynchronizeView()
	{
		$this->msetup->SynchronizeView( $this->uri->segment(3) );
	}
	
	public function savesinkronisasi()
	{
		$this->load->model('msetup2');
		$this->msetup2->savesinkronisasi();
	}
	
	public function accesssetup()
	{
		$this->load->model('msetup2');
		$this->msetup2->accesssetup();
	}
	
	public function remaccesssetup()
	{
		$this->load->model('msetup2');
		$this->msetup2->remaccesssetup();
	}
}





