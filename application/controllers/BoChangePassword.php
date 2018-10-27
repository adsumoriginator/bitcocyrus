<?php
/**
 * BoChangePassword class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoChangePassword extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('BoChangePasswordModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}
	public function index() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$adminDetails = $this->CommonModel->getLoggedInAdminDetails();
			$data['userID'] 			= $adminDetails['0']->id;
			$data['getAdminUserInfo'] 	= $this->CommonModel->getLoggedInAdminDetails();
			$siteDetails 				= $this->CommonModel->getSiteConfigInfo();
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['copyRight'] 			= date('Y');
			$data['copySiteTitle'] 		= $siteDetails['0']->site_name." Admin";			
			$data['title'] 				= "Admin change password | ".$siteDetails['0']->site_name;
			$data['keywords'] 			= "Admin change password | ".$siteDetails['0']->site_name;
			$data['description'] 		= "Admin change password | ".$siteDetails['0']->site_name;
			$this->load->view('admin/boChangePassword/boChangePassword',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}
	function changePassword() {
		if($this->input->post('pwdchanges')) {
			$result = $this->BoChangePasswordModel->boChangePassword();	
			if($result) {
				$this->session->set_flashdata('success', ' Details has been updated Successfully');				
				$_SESSION["changePasswordLogout"] = "pwdChanged";
				redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');	
			}	
	    	else {
				$this->session->set_flashdata('error', 'Please enter correct current password');
				redirect('BoChangePassword','refresh');
			}			
		}
	}


	function changepattern(){
		if($this->input->post('patternchanges')) {

			$udata['bcc_pattern_key'] = $this->CommonModel->customEncode($this->input->post('patterncode'));

			$adminId = $this->session->userdata('loggedJTEAdminUserID');

			$result = $this->CommonModel->updateTableData("bcc_admin",array('id'=>$adminId),$udata);
			
			if($result) {
				$this->session->set_flashdata('success', ' Details has been updated Successfully');
									
				redirect('BoChangePassword','refresh');			
			}	
	    	else {
				$this->session->set_flashdata('error', 'Please enter correct current password');
				redirect('BoChangePassword','refresh');
			}			
		}
	}


	function checkpattern(){
		$old_password = $this->input->post('pattern');			
			
		$oldpattern = $this->CommonModel->getTableData("bcc_admin",array('id'=>$this->session->userdata('loggedJTEAdminUserID')))->row()->bcc_pattern_key;

		$pattern = $this->CommonModel->customDecode($oldpattern);							

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

		$udata['bcc_pattern_key'] = $this->CommonModel->customEncode($new_pattern);			 

		$result = $this->CommonModel->updateTableData("bcc_admin",$udata,array('id'=>$this->session->userdata('loggedJTEAdminUserID')));		
		
		if($result) {					
			$this->session->set_flashdata('error', 'Error Occrred While Update Pattern code');
			redirect('BoChangePassword','refresh');	
		}	
    	else {
    		$this->session->set_flashdata('success', 'Pattern Code has been updated Successfully');			
			redirect('BoChangePassword','refresh');		

		}		
	}
}
?>