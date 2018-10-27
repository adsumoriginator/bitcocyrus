<?php
/**
 * BoChangePassword class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class BoChangePassword extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('BoChangePasswordModel');		
		$this->load->database();
		$this->load->helper('url');
	}


	public function index() {
		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {

			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();
			    $data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin Wallet";
				$data['title'] 			= "Wallet change password | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Wallet change password | ".$siteDetails['site_name'];
				$data['description'] 	= "Wallet change password | ".$siteDetails['site_name'];
			$this->load->view('admin_wallet/boChangePassword/boChangePassword',$data);
		}
		else {
			wallet_redirect('Authentication');
		}
	}


	function changePassword() {
		if($this->input->post('pwdchanges')) {
			$result = $this->BoChangePasswordModel->boChangePassword_wallet();	
			if($result){
				$this->session->set_flashdata('success', ' Details has been updated Successfully');
				//redirect('BoChangePassword','refresh');
				$_SESSION["changePasswordLogout"] = "pwdChanged";
				wallet_redirect('Authentication');

				$this->session->set_flashdata('success', 'Password changed Successfully');
				wallet_redirect('BoChangePassword');
			}	
	    	else {
				$this->session->set_flashdata('error', 'Please enter correct current password');
				wallet_redirect('BoChangePassword');
			}			
		}
	}

	function changepattern(){
		
		if($this->input->post('patternchanges')) {

			$udata['info'] = insep_encode($this->input->post('patterncode'));

			$adminId = $this->session->userdata('loggedwalletuserid');

			$result = $this->Wallet_model->updateTableData(AWALLET,array('admin_id'=>$adminId),$udata);
			
			if($result) {
				$this->session->set_flashdata('success', ' Details has been updated Successfully');
				//redirect('BoChangePassword','refresh');					
				wallet_redirect('BoChangePassword');				
			}	
	    	else {
				$this->session->set_flashdata('error', 'Please enter correct current password');
				wallet_redirect('BoChangePassword');
			}			
		}
	}


	function checkpattern(){
		$old_password = $this->input->post('pattern');			
			
		$oldpattern = $this->Wallet_model->getTableData(AWALLET,array('admin_id'=>$this->session->userdata('loggedwalletuserid')))->row()->info;

		// echo $this->db->last_query();die;

		$pattern = insep_decode($oldpattern);							

		if ($old_password === trim($pattern))
		{ 		
			echo $old_password;			
		}					
		 else {
		 	echo '12346';			
		}
			
	}

	function set_pattern(){

		$new_pattern = trim($this->input->post('newpat'));

		$udata['info'] = insep_encode($new_pattern);			 

		$result = $this->Wallet_model->updateTableData(AWALLET,array('admin_id'=>$this->session->userdata('loggedwalletuserid')),$udata);
		
		if($result) {
			$this->session->set_flashdata('success', 'Pattern Code has been updated Successfully');			
			wallet_redirect('BoChangePassword');				
		}	
    	else {
			$this->session->set_flashdata('error', 'Error Occrred While Update Pattern code');
			wallet_redirect('BoChangePassword');
		}		
	}
}
?>