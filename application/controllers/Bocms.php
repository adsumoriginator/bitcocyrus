<?php
/**
 * Bocms class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class Bocms extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Sharavana Kumar
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->cms==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		




		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}	

		$this->load->library('form_validation');
		$this->load->model('BocmsModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable cms pages of the site
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function index() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$data['getcmsPages'] 	= $this->BocmsModel->getcmsPages();
			$data['getAdminUserInfo'] 	= $this->CommonModel->getLoggedInAdminDetails();
			$siteDetails 				= $this->CommonModel->getSiteConfigInfo();
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['title'] 				= "CMS Pages | ".$siteDetails['0']->site_name;
			$data['keywords']			= "CMS Pages | ".$siteDetails['0']->site_name;
			$data['description'] 		= "CMS Pages | ".$siteDetails['0']->site_name;

			$this->load->view('admin/bocms/bocms',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * Function is used for get the particular cms page details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function editcms($cmsID) {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			$getParticularcms 		= $this->BocmsModel->getParticularcms($cmsID);
			
			if(isset($getParticularcms) && !empty($getParticularcms)) {
				foreach ($getParticularcms as $value) {
					$data['cmsID']			= $value->id;
					$data['page']			= $value->link;
					$data['cmsTitle']		= $value->title;
					$data['cmsDescription'] = $value->content_description;
					
					$data['status']			= $value->status;
				}
				$data['siteName'] 			= $siteDetails['0']->site_name;
				$data['title'] 				= "Edit cms page details | ".$siteDetails['0']->site_name;
				$data['keywords']			= "Edit cms page details | ".$siteDetails['0']->site_name;
				$data['description'] 		= "Edit cms page details | ".$siteDetails['0']->site_name;
				$this->load->view('admin/bocms/editcms',$data);	
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
	 * Function is used for to prepare update the cms page details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function updatecmspage() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('updatecmspage')) {
				$cmsID 	= $this->input->post('cmsID');
				
				$result = $this->BocmsModel->updatecmspage($cmsID);
				if($result) {
					$this->session->set_flashdata('success', ' Details has been updated successfully');			
					redirect('Bocms','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Details not updated successfully please try again later');
					redirect('Bocms','refresh');
				}				
			}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}

	function add_notification(){
		if($this->input->post("notification")){

			$insertdata["notification"]=$this->input->post("message");
			$insertdata["status"]=$this->input->post("status");
			$this->CommonModel->addTableData("notification",$insertdata);
			$this->session->set_flashdata("success","Notification added successfully");
			 redirect("Bocms/notification");


		}else{

			$this->load->view('admin/bocms/add_notification');
		}
	}

	function notification(){

		$data["notification"]=$this->CommonModel->getTableData("notification");
		$this->load->view('admin/bocms/notification',$data);	
	

	}



		function edit_notification($id=""){

		$condition=array("id"=>$id);

		if($this->input->post("notification")){

		$insertdata["notification"]=$this->input->post("message");
			$insertdata["status"]=$this->input->post("status");
			$this->CommonModel->updateTableData("notification",$insertdata,$condition);
			$this->session->set_flashdata("success","Notification updated successfully");
			redirect("Bocms/notification");


		}else{
			$data["notification"]=$this->CommonModel->getTableData("notification",$condition)->row();

			$this->load->view('admin/bocms/edit_notification',$data);
		}
	}




	function deletenotification($id){

		$condition=array("id"=>$id);

		$this->CommonModel->deleteTableData("notification",$condition);

		$this->session->set_flashdata("success","Notification deleted successfully");
		redirect("Bocms/notification");

	}



}

/**
 * Filename: Bocms.php
 * Location: /application/controllers/Bocms.php
 */
?>