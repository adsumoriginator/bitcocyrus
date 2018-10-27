<?php
/**
 * BoAuthentication class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class BoUser extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {





		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}	


		$this->load->library('form_validation');

		//$this->load->model('CommonModel');
		$this->load->model('BoLoginModel');
		$this->load->database();
		$this->load->helper('url');
		$ip 				=	$_SERVER['REMOTE_ADDR'];
		$getParticularIP 	= $this->BoLoginModel->getParticularIP($ip);
		if($getParticularIP == 1) {
			//echo '<div style="text-align: center; margin-top:50px; font-family: times new roman; font-size: 25px;  color: red;">Your IP Address Block. Contact Administrator !!! </div>'; die;
		}
	}


	function view(){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->user_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
        







		$order_by=array("user_id","desc");
		$data['user_details']=$this->CommonModel->getTableData("userdetails",'',$order_by);
		$this->load->view("admin/user/view_user_list",$data);

	}

	/*
	 * Function used to KYC request
	 * @author Jatin
	 * @link http://adsumoriginator.com/
	 */
	function request_kyc(){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->user_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		$order_by=array("user_id","desc");
		//SELECT t1.*, (SELECT ip_address FROM `bcc_user_activity` where user_id=t1.user_id ORDER BY act_id DESC LIMIT 1 ) AS IP FROM `bcc_userdetails` as t1
		$data['user_details'] =  $this->db->select('a.*')
								     ->from('userdetails as a')
								     ->or_group_start()
								     ->where('b.proof1_status',1)
								     ->where('b.proof2_status',1)
								     ->group_end()
								     ->or_group_start()
								     ->where('b.proof3_status',1)
								     ->where('b.proof4_status',1)
								     ->group_end()
								     ->where('a.kyc_status','Unverified')
								     ->join('bcc_user_verification as b', 'a.user_id = b.user_id')
								     ->order_by("user_id", "desc")
								     ->get();

		$this->load->view("admin/user/view_request_user_list",$data);

	}

	function change_user_status($id=""){
		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->user_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
        

		$userid=insep_decode($id);
		$condition=array("user_id"=>$userid);
		$user_details=$this->CommonModel->getTableData("userdetails",$condition);
		if($user_details->num_rows() ==1 ){
			$user_details=$user_details->row();
			if($user_details->user_status==1){

				$data['user_status']=0;
					$this->session->set_flashdata("success","User status deactivated successfully");
			}else{
				$data['user_status']=1;
				$this->session->set_flashdata("success","User status activated successfully");
			}

			$this->CommonModel->updateTableData("userdetails",$data,$condition);
		

		}else{
			$this->session->set_flashdata("error","Invalid link");
		}

		redirect('BoUser/view');

	}


	function editUser($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->user_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
        

		$userid=insep_decode($id);

		$condition=array("user_id"=>$userid);
		$user_details=$this->CommonModel->getTableData("userdetails",$condition);
		if($user_details->num_rows() ==1 ){
			$user_details=$user_details->row();

			$data['user_data']=$user_details;

			$data['kyc_data']=$user_details=$this->CommonModel->getTableData("user_verification",$condition);

			$this->load->view("admin/user/editusers",$data);




		}else{
			$this->session->set_flashdata("error","Invalid link");
		}

		//redirect('BoUser/view');

	}


function update_kyc(){
	$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->user_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
        


	$status=$this->input->post("status");
	$user_id=$this->input->post("userid");
	$doc=$this->input->post("doc");
	$userdata=get_user($user_id);
	$name=$userdata->username;
	$site_data=site_settings();
	$sitename=$site_data->site_name;
	if($status==3){	
		$reason=$this->input->post("reason_text");
		$update['reject_reason']=$reason;
		$status="Rejected";
		$email_data=getEmailTeamplete(5);
		$subject=$email_data->subject;
		$template=$email_data->template;
		$data=array(
				"###NAME###"=>$name,				
				"###SITENAME###"=>$sitename,
				"###STATUS###"=>$status,
				"###REASON###"=>$reason,
				);
			//$message=strtr($template,$data);

			if($doc==1){

				$update['proof1_status']=3;
				$data["###DOCUMENT###"]="Passport(Front)";


			}elseif($doc==2){

				$update['proof2_status']=3;
					$data["###DOCUMENT###"]="Passport(Back)";


			}elseif($doc==3){

				$update['proof3_status']=3;
				$data["###DOCUMENT###"]="Id proof(Front)";

			}elseif($doc==4){

				$update['proof4_status']=3;
				$data["###DOCUMENT###"]="Id proof(Back)";

			}	elseif($doc==5){

				$update['proof4_status']=3;
				$data["###DOCUMENT###"]="Profile Picture";

			}				
			


	}else{
			$status="Approved";
			$reason=$this->input->post("reason_text");
				$email_data=getEmailTeamplete(4);
			$subject=$email_data->subject;
			$template=$email_data->template;
			$data=array(
				
				"###STATUS###"=>$status,
			);
			if($doc==1){

				$update['proof1_status']=2;

				$data["###DOCUMENT###"]="Passport(Front)";

			}elseif($doc==2){

				$update['proof2_status']=2;
				$data["###DOCUMENT###"]="Passport(Back)";

			}elseif($doc==3){

				$update['proof3_status']=2;
				$data["###DOCUMENT###"]="Id proof(Front)";

			}elseif($doc==4){
				$update['proof4_status']=2;
				$data["###DOCUMENT###"]="Id proof(Back)";

			}elseif($doc==5){
				$update['proof5_status']=2;
				$data["###DOCUMENT###"]="Profile picture";

			}
	}


	

				$data["###NAME###"]=$userdata->username;
				$data["###LOGOIMG###"]=getSiteLogo();
				$data["###EMAILIMG###"]=  base_url()."assets/frontend/images/email_send.png";
				$data["###FBIMG###"]= base_url()."assets/frontend/images/facebook.png";			
				$data["###TWIMG###"]= base_url()."assets/frontend/images/twitter.png";
				$data["###GPIMG###"]= base_url()."assets/frontend/images/gplus.png";
				$data["###LEIMG###"]= base_url()."assets/frontend/images/linkedin.png";	
				$data["###HDIMG###"]= base_url()."assets/frontend/images/email.png";
				$data["###FBLINK###"]= $site_data->facebooklink;				
				$data["###TWLINK###"]= $site_data->twitterlink;	
				$data["###GPLINK###"]= $site_data->googlelink;
				$data["###LELINK###"]= $site_data->linkedinlink;		








				
				$message=strtr($template,$data);


			
				$condition=array("user_id"=>$user_id);
				$update['verification_status']=$status;
	$this->CommonModel->updateTableData("user_verification",$update,$condition);
	
	$kycdata=$this->CommonModel->getTableData("user_verification",$condition)->row();

	/*
	 * KYC proof valiidation any two
	 * @author Jatin
	 * @link http://adsumoriginator.com/
	 */
	// if($kycdata->proof1_status==2 && $kycdata->proof2_status==2 && $kycdata->proof3_status==2 && $kycdata->proof4_status==2  && $kycdata->proof5_status==2){
	if(($kycdata->proof1_status==2 && $kycdata->proof2_status==2) || ($kycdata->proof3_status==2 && $kycdata->proof4_status==2)){

		$ky_update["kyc_status"]="Verified";

	}else{

		$ky_update["kyc_status"]="unVerified";
	}
	$this->CommonModel->updateTableData("userdetails",$ky_update,$condition);
	

	$email=get_user_email($user_id);
	send_mail($email,$subject,$message);

	echo "ok";

}

function user_wallet(){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->wallet==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
        



	//$order_by=array("user_id","desc");
	//$data['user_details']=$this->CommonModel->getTableData("userdetails",'',$order_by);
	$data['user_details']=$this->CommonModel->get_userdetil_ip_data("SELECT t1.*, (SELECT ip_address FROM `bcc_user_activity` where user_id=t1.user_id ORDER BY act_id DESC LIMIT 1 ) AS IP FROM `bcc_userdetails` as t1");
	$this->load->view("admin/user/wallet",$data);


}


function view_address($id=""){

	$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->wallet==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$where=array("user_id","desc");
		$user_id=insep_decode($id);
		$where=array("user_id"=>$user_id);
		$userdata=$this->CommonModel->getTableData("userdetails",$where);

		$data["user_data"]=$userdata->row();
		$address=$this->CommonModel->getTableData("address_balance",$where);


		//$address =  (array) $address->row();
		$data["address"]=$address;
	
	
		$this->load->view("admin/user/wallet_address",$data);



}	

function view_balance($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->wallet==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }


	$user_id=insep_decode($id);		
	$where=array("user_id"=>$user_id);
	$userdata=$this->CommonModel->getTableData("userdetails",$where);
	$data["user_data"]=$userdata->row();
	$balance=$this->CommonModel->getTableData("address_balance",$where);
	//$balance =  (array) $balance->row();
	$data["balance"]=$balance ;
	$this->load->view("admin/user/wallet_balance",$data);


}	

function tfa(){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->tfa==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }


	$order_by=array("user_id","desc");
	$data['user_details']=$this->CommonModel->getTableData("userdetails",'',$order_by);
	$this->load->view("admin/user/tfa",$data);

}


function change_tfa_status($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->tfa==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }



		$userid=insep_decode($id);
		$condition=array("user_id"=>$userid);
		$user_details=$this->CommonModel->getTableData("userdetails",$condition);
		if($user_details->num_rows() ==1 ){
			$user_details=$user_details->row();
			if($user_details->tfa_status==1){
				$data['tfa_status']=0;
			}else{
				$data['tfa_status']=1;
			}

			$this->CommonModel->updateTableData("userdetails",$data,$condition);
			$this->session->set_flashdata("success","User tfa status successfully updated");

		}else{
			$this->session->set_flashdata("error","Invalid link");
		}

		redirect('BoUser/tfa');


}



}

