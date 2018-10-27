<?php
/**
 * BoFaq class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoFaq extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Sharavana Kumar
	*/	
	public function __construct() {
		parent::__construct();
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {


		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('BoFaqModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable faq
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function index() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$data['getFaq'] 		= $this->BoFaqModel->getFaq();
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['title'] 			= "FAQ Page | ".$siteDetails['0']->site_name;
			$data['keywords']		= "FAQ Page | ".$siteDetails['0']->site_name;
			$data['description'] 	= "FAQ Page | ".$siteDetails['0']->site_name;

			$this->load->view('admin/boFaq/boFaq',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * Function use to prepare display the add faq form page
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function addFaq() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['title'] 			= "Add FAQ | ".$siteDetails['0']->site_name;
			$data['keywords']		= "Add FAQ | ".$siteDetails['0']->site_name;
			$data['description'] 	= "Add Page | ".$siteDetails['0']->site_name;

			$this->load->view('admin/boFaq/addFaq',$data);			
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
	public function saveFaq() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('saveFaqDetails')) {
				$addNewUser 			= $this->BoFaqModel->saveFaq();
				if($addNewUser) {
					$this->session->set_flashdata('success', ' Faq details added Successfully');
					redirect('BoFaq','refresh');				
				}	
		    	else {
					$this->session->set_flashdata('error', 'Sorry new faq details not added please try again later');
					redirect('BoFaq','refresh');
				}
			}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}			
	}

	/**
	 * Function is used for get the particular faq details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function editFaq($faqID) {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			$getParticularFaq 		= $this->BoFaqModel->getParticularFaq($faqID);
			
			if(isset($getParticularFaq) && !empty($getParticularFaq)) {
				foreach ($getParticularFaq as $value) {
					$data['faqID']			= $value->id;
					$data['faqQuestion']	= $value->question;
					$data['faqAnswer']		= $value->description;
					$data['status']			= $value->status;
				}
				$data['siteName'] 		= $siteDetails['0']->site_name;
				$data['title'] 			= "Edit FAQ | ".$siteDetails['0']->site_name;
				$data['keywords']		= "Edit FAQ | ".$siteDetails['0']->site_name;
				$data['description'] 	= "Edit FAQ | ".$siteDetails['0']->site_name;

				$this->load->view('admin/boFaq/editFaq',$data);		
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
	 * Function is used for to prepare update the faq details
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function updateFaq() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('updateFaqDetails')) {
				$faqID 	= $this->input->post('faqID');
				
				$result = $this->BoFaqModel->updateFaq($faqID);
				if($result) {
					$this->session->set_flashdata('success', ' Details has been updated successfully');			
					redirect('BoFaq','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Details has not been updated.');		
					redirect('BoFaq','refresh');
				}				
			}
		}		
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * Function is used for to prepare delete the faq details
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function deleteFaq($faqID) {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');

		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$deleteFaq 			= $this->BoFaqModel->deleteFaq($faqID);
			if($deleteFaq) {
				$this->session->set_flashdata('success', ' Faq details Deleted Successfully');
				redirect('BoFaq','refresh');				
			}	
	    	else {
				$this->session->set_flashdata('error', 'Sorry faq details not Deleted please try again later');
				redirect('BoFaq','refresh');
			}			
		}
	}	
}

/**
 * Filename: BoFaq.php
 * Location: /application/controllers/BoFaq.php
 */
?>