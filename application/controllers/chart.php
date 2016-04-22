<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();		
	}
	
	public function viewChart()
	{
		$this->load->model('mchart');
		$data['infoview'] = $this->hirarki->getinfoview($this->uri->segment(3));
		$data['content'] = 'charts/viewcharts';
		$data['listmeasure'] = $this->mchart->getMeasurePerView();
		$data['periodmonth'] = $this->mchart->getPeriodMonth();
		//print_r( $data['periodmonth']);exit;
		
		$data['num'] = $this->mchart->getNumeric($data['periodmonth'][0]['month']);
		
		$idmeasure = $this->uri->segment(4);
		$idview = $this->uri->segment(3);
		if(isset($idmeasure))
		{
			$data['series1exists'] = $this->mchart->getSeries1( $idmeasure , $_SESSION['dbuserlogged'] );
			$data['series2exists'] = $this->mchart->getSeries2( $idmeasure , $_SESSION['dbuserlogged'] );
			/*
			if( !empty($data['series1exists']) && !empty($data['series2exists']) )
			{
				$data['measurechart'] = $this->mchart->getMeasureChartSeries1_2( $idview , $idmeasure );
				$data['measurechartakumulasi'] = $this->mchart->getMeasureChartAkumulasiSeries1_2( $idmeasure );
			}
			else if( !empty($data['series1exists']) && empty($data['series2exists']) )
			{
				$data['measurechart'] = $this->mchart->getMeasureChartSeries1( $idview , $idmeasure );
				$data['measurechartakumulasi'] = $this->mchart->getMeasureChartAkumulasiSeries1( $idmeasure );
			}
			else if( empty($data['series1exists']) && empty($data['series2exists']) )
			{*/
				$data['measurechart'] = $this->mchart->getMeasureChart( $idview , $idmeasure );
				$data['measurechartakumulasi'] = $this->mchart->getMeasureChartAkumulasi( $idmeasure );
			//}
			
			
		} else {}
		
		
		$this->load->view('template', $data);
	}

	public function refreshData()
	{
		$this->load->model('mchart');
		//$data['listmeasure'] = $this->mchart->refreshData();
		$this->mchart->refreshData( $this->input->post('idview'), $this->input->post('listmeasure') );
		redirect('chart/viewChart/'.$this->input->post('idview').'/'.$this->input->post('listmeasure'));
	}
	
}

