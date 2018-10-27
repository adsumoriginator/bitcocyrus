<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();	

		if(!$this->session->userdata("user_id")){

			redirect();
		}else{
			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){
				redirect("home/logout");
			}
		}
	}
	
	//change
	public function dashboard(){

		$user_id=user_id();

		//require_once 'GoogleAuthenticator.php';
			//	$ga = new Googleauthenticator();
		$data["get_user_dashboard_data"]=$this->CommonModel->get_user_dashboard_data($user_id);
		$data["get_usd_amount"] = $this->CommonModel->get_usd_amount($user_id);
		
		//$condition=array("status"=>1);
		//$data["currency_settings"]=$this->CommonModel->getTableData("currency",$condition);
		
		//$condition=array("user_id"=>$user_id);
		//$data["balance"]=$this->CommonModel->getTableData("address_balance",$condition);
	
		//$condition=array("user_id"=>$user_id);
		//$data["address"]=$this->CommonModel->getTableData("",$condition);
		$condition=array("user_id"=>$user_id);
		$data["pairs"] = trade_pairs();
		/* ----------------- PAIR BALANCE ----------------- */
		
		$lcondition=array("user_id"=>$user_id,'activity'=>'Login');
		$order_by=array('act_id','desc');
		$user_activity=$this->CommonModel->getTableData("user_activity",$lcondition,$order_by,'','','','',0,1)->row();	
		$data['last_login']=$user_activity;

		$userdata=get_user(user_id());

		$this->load->library('GoogleAuthenticator');
	
		if($userdata->tfa_secrect_key==""){
			$username=$userdata->username;			
			$secret = $this->googleauthenticator->createSecret();
			$qrCodeUrl = $qrCodeUrl = $this->googleauthenticator->getQRCodeGoogleUrl('Bitcocyrus',$username, $secret);
			$updata["tfa_secrect_key"]=$secret;
			$updata["tfa_url"]=$qrCodeUrl;
			$this->CommonModel->updateTableData("userdetails",$updata,$condition);
			$data['tfa_url']=$qrCodeUrl;
			$data['tfa_secrect']=$secret;	
		}else{		
			$data['tfa_secrect']=$userdata->tfa_secrect_key;
			$data['tfa_url']=$userdata->tfa_url;
		}
		$data['main_js'] = "dashboard";
		$data['user_details']=get_user($user_id);

		$data["kyc_details"]=$this->CommonModel->getTableData("user_verification",$condition)->row();
			//print_r($data["currency_settings"]->result());
			//$data1 = array('data' => $data);
		$this->load->view('front/user/dashboard',$data);
	}

function update_tfa(){

	$this->load->library('GoogleAuthenticator');

	$userdata=get_user($this->session->userdata('user_id'));

	$status=$userdata->tfa_status;
	$key=$userdata->tfa_secrect_key;
	$code=$this->input->post("tfa_code");
	$checkResult = $this->googleauthenticator->verifyCode($key, $code, 2); // 2 = 2*30sec clock tolerance
	if ($checkResult) {

		if($status==0){
			$updata['tfa_status']=1;

		}else{

			$updata['tfa_status']=0;
		}
		$condition=array("user_id"=>user_id());
		$this->CommonModel->updateTableData("userdetails",$updata,$condition);
	
		if($status==0){

			
			echo "disable";

		}else{

			echo "enable";
		}
   				
	} else {
    	echo 'fail';
	}
}

function create_code(){
		$this->load->library('GoogleAuthenticator');
		$secret="FFVMRV6S47N3ANVE";
		echo $oneCode = $this->googleauthenticator->getCode($secret);
}

function profile(){	
	if($this->input->post("update")){

		$updateData['userAddress']=$this->input->post("address");
		$updateData['city']=$this->input->post("city");
		$updateData['country']=$this->input->post("country");		
		$updateData['dob']=$this->input->post("dob");
		$updateData['firstname']=$this->input->post("firstname");
		$updateData['lastname']=$this->input->post("lastname");
		$updateData['post_code']=$this->input->post("postal_code");
		$updateData['state']=$this->input->post("state");
		$condition=array("user_id"=>user_id());
		$this->CommonModel->updateTableData("userdetails",$updateData,$condition);
		echo "success";


	}else{
		$data['main_js'] = "dashboard";
		$data['user_data']=get_user(user_id());

		$this->db->order_by("country_name","asc");
		$data["country"]=$this->CommonModel->getTableData("country");
		$condition=array("user_id"=>user_id());
		$data["verification"]=$this->CommonModel->getTableData("user_verification",$condition)->row();

	$this->load->view("front/user/profile",$data);

	}	
}

function upload_kyc(){


	//if($_FILES["passport"]["error"]==0 || $_FILES["identity"]["error"]==0 || $_FILES["photo"]["error"]==0){
		$updateData=array();
	
		$upload_config = array(
			'upload_path' 	=> 'uploads/kyc/', 
			'allowed_types' => 'jpg|jpeg|gif|png',
			'max_size'      =>  '3500',
			/* 'min_width' 	=> '40',
			'min_height' 	=> '40',*/
			'overwrite'     => true,
			'maintain_ratio' => true,
			'encrypt_name'     => true,
		);

		$this->load->library('upload', $upload_config);

		$this->upload->initialize($upload_config);
		
		if(isset($_FILES["passport_front"])){
			if($_FILES["passport_front"]["error"]==0){
				if(!$this->upload->do_upload('passport_front')) {
					echo $uploadErrors = $this->upload->display_errors();
					exit;
					$this->session->set_flashdata('error',"Passport image upload error, Sorry your file is too large. Upload valid image size.");
					redirect('user/profile','refresh');
				} 
				else  {
					$uploadData_up 	= $this->upload->data();
					$passport 		= $uploadData_up['file_name'];
					$updateData['id_proof1']=$passport;
					$updateData['proof1_status']=1;
				}
			}
		}

		if(isset($_FILES["passport_back"])){
			if($_FILES["passport_back"]["error"]==0){		
				if(!$this->upload->do_upload('passport_back')) {
					$uploadErrors = $this->upload->display_errors();
					$this->session->set_flashdata('error',"Passport image upload error, Sorry your file is too large. Upload valid image size.");
					redirect('user/profile','refresh');
				} 
				else  {
					$uploadData_up 	= $this->upload->data();
					$passport 		= $uploadData_up['file_name'];
					$updateData['id_proof2']=$passport;
					$updateData['proof2_status']=1;
								
				}
			}
		}

		if($_FILES["identity_front"]){
			if($_FILES["identity_front"]["error"]==0){
				if(!$this->upload->do_upload('identity_front')) {
					$uploadErrors = $this->upload->display_errors();
					$this->session->set_flashdata('error',"ID image upload error, Sorry your file is too large. Upload valid image size.");
					redirect('user/profile','refresh');
				} 
				else  {
					$uploadData_up 	= $this->upload->data();
					$id 		= $uploadData_up['file_name'];

					$updateData['id_proof3']=$id;
					$updateData['proof3_status']=1;
								
				}
			}
		}

		if($_FILES["identity_back"]){
			if($_FILES["identity_back"]["error"]==0){
				if(!$this->upload->do_upload('identity_back')) {
					$uploadErrors = $this->upload->display_errors();
					$this->session->set_flashdata('error',"ID image upload error, Sorry your file is too large. Upload valid image size.");
					redirect('user/profile','refresh');
				} 
				else  {
					$uploadData_up 	= $this->upload->data();
					$id 		= $uploadData_up['file_name'];

					$updateData['id_proof4']=$id;
					$updateData['proof4_status']=1;
								
				}
			}
		}

		if($_FILES["profile"]){
			if($_FILES["profile"]["error"]==0){
				if(!$this->upload->do_upload('profile')) {
					$uploadErrors = $this->upload->display_errors();
					$this->session->set_flashdata('error',"Profile image upload error, Sorry your file is too large. Upload valid image size.");
					redirect('user/profile','refresh');
				} 
				else  {
					$uploadData_up 	= $this->upload->data();
					$id 		= $uploadData_up['file_name'];

					$updateData['id_proof5']=$id;
					$updateData['proof5_status']=1;
								
				}
			}
		}

		if(count($updateData) >0){
			$user_condition=array("user_id"=>user_id());
			$this->CommonModel->updateTableData("user_verification",$updateData,$user_condition);			

			$this->session->set_flashdata("success","KYC data uploaded successfully");
			redirect("user/profile");							
		}else{
			$this->session->set_flashdata('error',"Please select any one image");
			redirect('user/profile','refresh');
		}
	}


function delete_proof($id=""){
	 $proof=insep_decode($id);
	$condition=array("user_id"=>user_id());
	$verificationdata=$this->CommonModel->getTableData("user_verification",$condition)->row();
	if($proof==1){
		$status=$verificationdata->proof1_status;
		if($status==1){
			$updateData['proof1_status']=0;
			$updateData['id_proof1']="";
			$this->CommonModel->updateTableData("user_verification",$updateData,$condition);
		}
	}else if($proof==2){
		$status=$verificationdata->proof2_status;
		if($status==1){
			$updateData['proof2_status']=0;
			$updateData['id_proof2']="";
			$this->CommonModel->updateTableData("user_verification",$updateData,$condition);
		}
	}else if($proof==3){
		$status=$verificationdata->proof3_status;
		if($status==1){
			$updateData['proof3_status']=0;
			$updateData['id_proof3']="";
			$this->CommonModel->updateTableData("user_verification",$updateData,$condition);
		}
	}else if($proof==4){
		$status=$verificationdata->proof4_status;
		if($status==1){
			$updateData['proof4_status']=0;
			$updateData['id_proof4']="";
			$this->CommonModel->updateTableData("user_verification",$updateData,$condition);
		}
	}else if($proof==5){
		$status=$verificationdata->proof5_status;
		if($status==1){
			$updateData['proof5_status']=0;
			$updateData['id_proof5']="";
			$this->CommonModel->updateTableData("user_verification",$updateData,$condition);
		}
	}

	$this->session->set_flashdata("success","KYC data deleted successfully");
	redirect("user/profile");
}

function security(){		
						
	if($this->input->post("change_pass")){

			$this->load->library('form_validation'); 
	        $this->form_validation->set_rules('otp', 'otp', 'required');  
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('old_password', 'old_password', 'required');
		
	        if ($this->form_validation->run() == FALSE)
	         {
	            	echo "value_missing";      
	         }
	         else
	         {
	         	$otp=$this->input->post("otp");
	         	$oldpassword=$this->input->post("old_password");
	         	$password=$this->input->post("password");

	         	$userdetail=get_user(user_id());
    			$key=$userdetail->tfa_secrect_key;
    			$code=$this->input->post("otp");
				$checkResult = $this->googleauthenticator->verifyCode($key, $code, 2); // 2 = 2*30sec clock tolerance
				if ($checkResult) {
    				$condition=array('user_id'=>user_id(),'key_three'=>insep_encode($oldpassword));
    				$user_check=$this->CommonModel->getTableData("userdetails",$condition);
    				if($user_check->num_rows() > 0){

    					$update['key_three']=insep_encode($password);
    					$this->CommonModel->updateTableData("userdetails",$update,$condition);
    					echo "success";
    				}else{
    					echo "Invalid";
    				}
    			}else{
    				echo "invalid_otp";
    			}
    		}

		}else if($this->input->post("tfa_update")){


     		$this->form_validation->set_rules('password', 'password', 'required');
	        $this->form_validation->set_rules('code', 'otp', 'required');  
	        $this->form_validation->set_rules('checkBackup', 'checkBackup', 'required');  
				
	        if ($this->form_validation->run() == FALSE)
	         {
	            	echo "value_missing";      
	         }
	         else
	         {
	         	$otp=$this->input->post("otp");
	         	
	         	$password=$this->input->post("password");
		   
				$condition=array('user_id'=>user_id(),'key_three'=>insep_encode($password));
				$user_check=$this->CommonModel->getTableData("userdetails",$condition);
				$resul = $user_check->result();
				$login_pass = insep_decode($resul[0]->key_three);

				if($login_pass == $password){
					$userdetail=get_user(user_id());
					$key=$userdetail->tfa_secrect_key;
					$status=$userdetail->tfa_status;

					$code=$this->input->post("code");
					$checkResult = $this->googleauthenticator->verifyCode($key, $code, 2); // 2 = 2*30sec clock tolerance
					if ($checkResult) {
						if($status==0){
							$updata['tfa_status']=1;
						}else{
							$updata['tfa_status']=0;
						}
						$condition=array("user_id"=>user_id());
						$this->CommonModel->updateTableData("userdetails",$updata,$condition);	
						if($status==0){
							echo "disable";

						}else{

							echo "enable";
						}
					} else{
						echo "Invalid_code";
						exit;
					}				
				}else{
					echo "Invalid_pass";
				}
    		}
		}

		else{

			$data['main_js'] = "dashboard";
			$data['user_details']=get_user(user_id());
			$this->load->view("front/user/security",$data);	
		}
	}

	function user_activity(){

			$condition=array("user_id"=>user_id());
			$order_by=array("act_id","desc");
			$data["activity"]=$this->CommonModel->getTableData("user_activity",$condition,$order_by);

			$this->load->view("front/user/activity_history",$data);
	}
}	
