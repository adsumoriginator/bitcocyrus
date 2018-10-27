<?php
/**
 * BoFaq class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class Subadmin extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	*/	
	public function __construct() {
		parent::__construct();
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

			if($loggedUserId!=1){

				redirect('bodashboard','refresh');

			}


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

			$condition=array("id !="=>1);

		 	$data["subadmin"]=$this->CommonModel->getTableData("admin",$condition)->result();

	
			$this->load->view('admin/admin/view',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * Function use to prepare display the add faq form page
	 * @access public
	 * @return response success get the set of records or fail
	 */	
	public function add() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			
			
			if($this->input->post("add")){

					$password 	= md5($this->input->post('password'));
      				$pattern 	= $this->CommonModel->customEncode($this->input->post('patterncode'));


					$admindata["admin_name"]=$this->input->post("username");
					$admindata["bcc_password"]=$password;
					$admindata["bcc_pattern_key"]=$pattern;
					$admindata["status"]=1;
					$admindata["bcc_email_id"]=$this->input->post("email");
					$this->CommonModel->addTableData("admin",$admindata);
					$admin_id=$this->db->insert_id();
					$insertdata["admin_id"]=$admin_id;
					$insertdata["user_details"]=$this->input->post("userdetaisls");
					$insertdata["tfa"]=$this->input->post("tfa");
					$insertdata["currency_details"]=$this->input->post("currency_details");
					$insertdata["trade"]=$this->input->post("trade_pair");
					$insertdata["wallet"]=$this->input->post("wallet");
					$insertdata["deposit_withdraw"]=$this->input->post("deposit");
					$insertdata["subscriper"]=$this->input->post("subscriber");
					//$insertdata["support"]=$this->input->post("support");
					$insertdata["cms"]=$this->input->post("cms");
					$insertdata["template"]=$this->input->post("email_template");
					$username=$this->input->post("username");
					$password=$this->input->post('password');

					$pattern=$this->input->post('patterncode');

					$this->session->set_userdata($otp_val);
				    $email_data=getEmailTeamplete(13);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;
					$data=array(
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###USERNAME###"=> $username,
					"###PASSWORD###"=> $password,
					"###PATTERN###"=> $pattern,		
				);

				$email=$this->input->post("email");
				 $message=strtr($template,$data);		 
				 send_mail($email,$subject,$message);
				$this->CommonModel->addTableData("sub_admin_permissions",$insertdata);
				$this->session->set_flashdata("success","Sub admin created successfully");
				redirect("Subadmin");

			}else{

			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['title'] 			= "Add Subadmin | ".$siteDetails['0']->site_name;
			$data['keywords']		= "Add Subadmin | ".$siteDetails['0']->site_name;
			$data['description'] 	= "Add Subadmin | ".$siteDetails['0']->site_name;

			$this->load->view('admin/admin/addsubadmin',$data);

			}			
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');	
		}		
	}






	function checkuser(){

	

		$admin_name=$this->input->post("username");
		$condition=array('admin_name'=>$admin_name);
		$userdata=$this->CommonModel->getTableData("bcc_admin",$condition);
		if($userdata->num_rows() >0){
				echo 'false';
		}else{
				echo 'true';

		}

	}



	function checkemail(){

		$email=$this->input->post("email");
		$condition=array('bcc_email_id'=>$email);
		$userdata=$this->CommonModel->getTableData("bcc_admin",$condition);
		if($userdata->num_rows() >0){
				echo 'false';
		}else{
				echo 'true';

		}

	}

	

	/**
	 * Function is used for get the particular faq details
	 * @access public
	 * @return response success get the set of records or fail
	 */
	public function editsubadmin($id="") {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		$id=insep_decode($id);
		$condition=array('id'=>$id);

		$admin_details=$this->CommonModel->getTableData("admin",$condition)->row();
		$data["admin_details"]=$admin_details;

		$percondition=array('admin_id'=>$id);

		$permission_details=$this->CommonModel->getTableData("sub_admin_permissions",$percondition)->row();
		$data["admin_details"]=$admin_details;
		$data["permission_details"]=$permission_details;
	

		if(isset($loggedUserId) && !empty($loggedUserId)) {		


			
			if($this->input->post("add")){	


      				


					//$admindata["admin_name"]=$this->input->post("username");
      				if($this->input->post('password')!=""){

      					$password 	= md5($this->input->post('password'));
						$admindata["bcc_password"]=$password;

					}
					$patterncode=$this->input->post('patterncode');					

					if($patterncode!=""){

						$pattern 	= $this->CommonModel->customEncode($this->input->post('patterncode'));
						$admindata["bcc_pattern_key"]=$pattern;	

					
					}


					
					//$admindata["status"]=1;

					if($this->input->post('password')!="" || $patterncode!=""){
				
						$this->CommonModel->updateTableData("admin",$admindata,$condition);
					
					}
			
					$insertdata["user_details"]=$this->input->post("userdetaisls");
					$insertdata["tfa"]=$this->input->post("tfa");
					$insertdata["currency_details"]=$this->input->post("currency_details");
					$insertdata["trade"]=$this->input->post("trade_pair");
					$insertdata["wallet"]=$this->input->post("wallet");
					$insertdata["deposit_withdraw"]=$this->input->post("deposit");
					$insertdata["subscriper"]=$this->input->post("subscriber");
					//$insertdata["support"]=$this->input->post("support");
					$insertdata["cms"]=$this->input->post("cms");
					$insertdata["template"]=$this->input->post("email_template");
					
					/*
					$user=$this->input->post("username");
					$password=$this->input->post('password');
					$pattern=$this->input->post('patterncode');

					$this->session->set_userdata($otp_val);
				    $email_data=getEmailTeamplete(13);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;
					$data=array(
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###USERNAME###"=> $username,
					"###PASSWORD###"=> $password,
					"###PATTERN###"=> $pattern,		
				);


					*/

				//$email=$this->input->post("email");
				 //$message=strtr($template,$data);		 
				// send_mail($email,$subject,$message);
				$this->CommonModel->updateTableData("sub_admin_permissions",$insertdata,$percondition);

		

				$this->session->set_flashdata("success","Sub admin updated successfully");
				redirect("Subadmin");

			}else{



		
				$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
				$data['siteName'] 		= $siteDetails['0']->site_name;
				$data['title'] 			= "Edit Subadmin | ".$siteDetails['0']->site_name;
				$data['keywords']		= "Edit Subadmin | ".$siteDetails['0']->site_name;
				$data['keywords']		= "Edit Subadmin | ".$siteDetails['0']->site_name;
				$data['description'] 	= "Edit Subadmin | ".$siteDetails['0']->site_name;
	
				$this->load->view('admin/admin/editsubadmin',$data);		

			
				
			}


		}
			else {

				

				
			}

	
		
	}

	/**
	 * Function is used for to prepare update the faq details
	 * @return response success get the set of records or fail
	 */	

	public function deletesubadmin($id="") {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');

		if(isset($loggedUserId) && !empty($loggedUserId)) {

			echo $id=insep_decode($id); 
			$condition=array("id"=>$id);
			$admindetals 			= $this->CommonModel->getTableData("admin",$condition)->row();
			 $admin_id=$admindetals ->id;
		
			;
			$deleteadmin 			= $this->CommonModel->deleteTableData("admin",$condition);

				$condition=array("admin_id"=>$admin_id);
			$deleteadmin 			= $this->CommonModel->deleteTableData("sub_admin_permissions",$condition);				
			
				$this->session->set_flashdata('success', ' subadmin details Deleted Successfully');
				redirect('subadmin','refresh');				
		
	    	
		}
	}



	function update_status($id=""){

		$id=insep_decode($id);
		$condition=array("id"=>$id);
		$admindetals=$this->CommonModel->getTableData("admin",$condition)->row();	
		$status=$admindetals->status;
		if($status==1){

			$this->session->set_flashdata('success', ' subadmin status deactivated Successfully');
			$update["status"]=0;
			
		}else{

			$this->session->set_flashdata('success', ' subadmin status activated Successfully');
			$update["status"]=1;
		}
		
		$this->CommonModel->updateTableData("admin",$update,$condition);

				
				redirect('subadmin','refresh');



	}	
}

/**
 * Filename: BoFaq.php
 * Location: /application/controllers/BoFaq.php
 */
?>