<?php
/**
 * BoEmailTemplate class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoEmailTemplate extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Sharavana Kumar
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('BoEmailTemplateModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable email templates of the site
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function index() {
		

			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->template==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }


		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$data['getMailTemplateDetails'] = $this->BoEmailTemplateModel->getMailTemplateDetails();
			$data['getAdminUserInfo'] 		= $this->CommonModel->getLoggedInAdminDetails();
			$siteDetails 					= $this->CommonModel->getSiteConfigInfo();

			$data['siteName'] 				= $siteDetails['0']->site_name;
			$data['title'] 					= "Email template | ".$siteDetails['0']->site_name;
			$data['keywords'] 				= "Email template | ".$siteDetails['0']->site_name;
			$data['description'] 			= "Email template | ".$siteDetails['0']->site_name;
			$this->load->view('admin/boEmailTemplate/boEmailTemplate',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * Function use to prepare display the add email template form page
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function addEmailTemplate() {

				$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->template==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();

			$data['siteName'] 		= $siteDetails['0']->site_name;
			$data['title'] 			= "Add Email Template | ".$siteDetails['0']->site_name;
			$data['keywords']		= "Add Email Template | ".$siteDetails['0']->site_name;
			$data['description'] 	= "Add Email Template | ".$siteDetails['0']->site_name;
			
			$this->load->view('admin/boEmailTemplate/addEmailTemplate',$data);			
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');	
		}		
	}	

	/**
	 * Function use to prepare save the new faq
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function addNewEmailtemplate() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			//if($this->input->post('saveEmailTemplate')) {
				$addNewUser 			= $this->BoEmailTemplateModel->saveTemplate();
				if($addNewUser) {
					$this->session->set_flashdata('success', ' Email template added Successfully');
					redirect('BoEmailTemplate','refresh');				
				}	
		    	else {
					$this->session->set_flashdata('error', 'Sorry new email template not added please try again later');
					redirect('BoEmailTemplate','refresh');
				}
			//}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}			
	}	

	/**
	 * Function is used for to prepare update the user details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function editEmailTemplate($mailId) {

				$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->template==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }


		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 						= $this->CommonModel->getSiteConfigInfo();
			$getParticularEmailTemplates 		= $this->BoEmailTemplateModel->getParticularEmailTemplates($mailId);
			
			if(isset($getParticularEmailTemplates) && !empty($getParticularEmailTemplates)) {
				foreach ($getParticularEmailTemplates as $value) {
					$data['mailID']				= $value->id;
					$data['mailName']			= $value->name;
					$data['mailSubject']		= $value->subject;
					$data['mailTemplate']		= $value->template;
					$data['status']				= $value->status;
				}
				
				$data['siteName'] 	= $siteDetails['0']->site_name;
				$data['title'] 		= "Edit Email Template | ".$siteDetails['0']->site_name;
				$data['keywords']	= "Edit Email Template | ".$siteDetails['0']->site_name;
				$data['description']= "Edit Email Template | ".$siteDetails['0']->site_name;				
				$this->load->view('admin/boEmailTemplate/editEmailTemplate',$data);		
			}
			else {
				redirect('BoError404','refresh');
			}			
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}

	/**
	 * Function is used for to prepare update the user details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function saveEmailTemplateDetails() {

				$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->template==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			//if($this->input->post('updateEmailTemplate')) {
				$mailID 	= $this->input->post('mailID');
				
				$result = $this->BoEmailTemplateModel->saveEmailTemplateDetails($mailID);
				if($result) {
					$this->session->set_flashdata('success', ' Details has been updated successfully');			
					redirect('BoEmailTemplate','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Details not updated successfully please try again later');
					redirect('BoEmailTemplate','refresh');
				}				
			//}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}		
}

/**
 * Filename: BoEmailTemplate.php
 * Location: /application/controllers/BoEmailTemplate.php
 */
?>