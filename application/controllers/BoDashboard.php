<?php
/**
 * BoDashboard class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 

 * @link http://osiztechnologies.com/
 */

class BoDashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
				$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {


		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('BoDashboardModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}
	public function index() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
					
			
			$data["siteUserCount"]=$this->CommonModel->get_count("userdetails");

			$data['currency_count'] 		= $this->CommonModel->get_count("currency");

			$data['trade_pair'] 		= $this->CommonModel->get_count("trade_pairs");

			$data['trade_pair'] 		= $this->CommonModel->get_count("trade_pairs");
			$or_condition=array("status"=>"1");
			$this->db->or_where($or_condition);
			$or_condition=array("status"=>"open");
			$this->db->or_where($or_condition);

			$data['support_count'] 		= $this->CommonModel->get_count("support_ticket");

		
			$condition=array('type'=>2,'status'=>"Pending");
			$data['withdraw_request'] 		= $this->CommonModel->get_count("tansation",$condition);

	
			$condition=array('type'=>1);
			 $data['deposits'] 		= $this->CommonModel->get_count("tansation",$condition);

			$data['subscribers'] 		= $this->CommonModel->get_count("subscribers");


	/*

			$chartdata 						= array();
			$chartdata[0] 					= new stdclass();
			$chartdata[1]					= new stdclass();
			$chartdata[2]					= new stdclass();
			$chartdata[3]					= new stdclass(); // LTC
			$chartdata[4]					= new stdclass(); // XRP
			
			$chartdata[0]->name 			= 'BTC';
			$chartdata[1]->name 			= 'ETH';
			$chartdata[2]->name 			= 'DOGE';
			$chartdata[3]->name 			= 'LTC';
			$chartdata[4]->name 			= 'XRP';

			$chartdata[0]->data 			= array();
			$chartdata[1]->data 			= array();
			$chartdata[2]->data 			= array();
			$chartdata[3]->data 			= array();
			$chartdata[4]->data 			= array();
			
			$categories 					= array();
			for($i=0;$i<8;$i++) {
				$categories[]=date('d-M-y',strtotime('-'.$i.' days'));                
                $date1=date('Y-m-d',strtotime('-'.$i.' days'));
                $chartdata[0]->data[]=floatval($this->BoDashboardModel->chart_profit('BTC',$date1));
                $chartdata[1]->data[]=floatval($this->BoDashboardModel->chart_profit('ETH',$date1));
                $chartdata[2]->data[]=floatval($this->BoDashboardModel->chart_profit('DOGE',$date1));
                $chartdata[3]->data[]=floatval($this->BoDashboardModel->chart_profit('LTC',$date1));
                $chartdata[4]->data[]=floatval($this->BoDashboardModel->chart_profit('XRP',$date1));
            }
            $chart=new stdclass();
            $chart->xaxis=$categories;
            $chart->series=$chartdata;
            $data['chartdata']				= json_encode($chart);			
			/* chart */
	
			$siteDetails 					= $this->CommonModel->getSiteConfigInfo();				
			$data['siteName'] 				= $siteDetails['0']->site_name;
			$data['copyRight'] 				= date('Y');
			$data['copySiteTitle'] 			= $siteDetails['0']->site_name." Admin";
			$data['title'] 					= "Dashboard | ".$siteDetails['0']->site_name;
			$data['keywords'] 				= "Dashboard | ".$siteDetails['0']->site_name;
			$data['description'] 			= "Dashboard | ".$siteDetails['0']->site_name;

		


			$this->load->view('admin/boDashboard/boDashboard',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}
}
?>