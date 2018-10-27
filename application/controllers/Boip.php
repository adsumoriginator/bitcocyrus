<?php
/**
 * BoFaq class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BOip extends CI_Controller {
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
			
			$data["ipadd"]=$this->CommonModel->getTableData("admin_ips")->result();
			


			$this->load->view('admin/ip/ip',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}


	function change_status($id=""){

		$id=insep_decode($id);
		$condition=array("id"=>$id);
		$row=$this->CommonModel->getTableData("admin_ips",$condition)->row();
		echo "<pre>";
		if($row->status==1){
			$updata["status"]=0;

		}else{
			$updata["status"]=1;
		}
		

		$this->CommonModel->updateTableData("admin_ips",$updata,$con);
		$this->session->set_flashdata("success","Status updated successfully");
		redirect("boip");	


	}


	function delete($id=""){

		$id=insep_decode($id);
		$condition=array("id"=>$id);
		$this->CommonModel->deleteTableData("admin_ips",$condition);


		$this->session->set_flashdata("success","Ip  deleted successfully");
		redirect("boip");	





	}

	/**
	 * Function use to prepare display the add faq form page
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function addip() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

			if($this->input->post("save")){
				$inserdata['ip']=$this->input->post("ip");
				$inserdata['status']=$this->input->post("status");
				$this->CommonModel->addTableData("admin_ips",$inserdata);
				redirect("boip");

			}else{


			$this->load->view('admin/ip/addip');	

			}

			


			
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