<?php
/**
 * BoLogin class
 * @category controller
 * @package ICOSuisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class Authentication extends CI_Controller {
	public function __construct() {
		parent::__construct();

		
      	// echo insep_encode('2369');die;

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('BoLoginModel');		
		$this->load->database();
		$this->load->helper('url');
	}

	public function index() {
		
		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {
			wallet_redirect('BoDashboard');	
		}
		else {
			if(isset($_SESSION["siteLogout"])) {
				unset($_SESSION['siteLogout']);
				$siteDetails 			= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();
				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Login | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Login | ".$siteDetails['site_name'];
				$data['description'] 	= "Login | ".$siteDetails['site_name'];		
				$data['successMsg'] 	= 'You are now successfully Log out';
				$this->load->view('admin_wallet/boLogin/boLogin',$data);
			}
			else if(isset($_SESSION["changePasswordLogout"])) {
				unset($_SESSION['changePasswordLogout']);
				$siteDetails 			= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();
				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Login | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Login | ".$siteDetails['site_name'];
				$data['description'] 	= "Login | ".$siteDetails['site_name'];	
				$data['successMsg'] 	= 'Your password is updated successfully please log in again';
				$this->load->view('admin_wallet/boLogin/boLogin',$data);
			}			
			else {			
				$siteDetails 			= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();
				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Login | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Login | ".$siteDetails['site_name'];
				$data['description'] 	= "Login | ".$siteDetails['site_name'];
				$this->load->view('admin_wallet/boLogin/boLogin',$data);
			}
		}
	}
	function logincheck() {

		// echo insep_encode(2369);die;

	/*	echo "<pre>";
		print_r($_POST);die;*/


		if($this->input->post('signin')) {			

			$result = $this->BoLoginModel->logincheck_wallet();	

			if($result){
				// echo "hhhjhjhj";die;
				// wallet_redirect('BoDashboard');
				redirect('bitcowallet/BoDashboard','refresh');
			}	
	    	else {

	    		//$this->session->set_flashdata('error', 'Logged Out successfully.');
				$siteDetails 			= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Login | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Login | ".$siteDetails['site_name'];
				$data['description'] 	= "Login | ".$siteDetails['site_name'];    		
				$data['invalid_login']  = 'Invalid username, password or pattern';

				//$this->session->set_flashdata("error","Invalid username, password or pattern");

				$this->load->view('admin_wallet/boLogin/boLogin',$data);

			}			
		}else{

				wallet_redirect('Authentication');
		}
	}


	function logout() {
		$this->session->unset_userdata('loginUserName');
		$this->session->unset_userdata('loggedwalletuserid');
		//$this->session->set_flashdata('success', 'Logged Out successfully.');
		$_SESSION["siteLogout"] = "logoutSuccess";
		wallet_redirect('Authentication');
	}

}
?>