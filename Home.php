<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		require_once 'jsonRPCClient.php';

		if(user_id()!=""){
			$user_status = get_data(USERS,array('user_id'=>user_id()),'user_id,status')->row();
			if($user_status->status=="deactive"){
				$this->logout();
		    }
		}

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>7))->row();		

		// $data['proeperty_manage'] = $this->db->query("SELECT *, count(property_id) as city_cnt from ".PROPERTY." where property_status=1 group by property_city order by property_id desc")->result();

		$data['proeperty_manage'] = get_cities()->result();
		
		/*echo "<pre>";
		print_r($data['property_cities']);die;*/

		$data['main_js'] = "common";

		$this->load->view('front/basic/index',$data);
	}

	function is_login()
	{	
		if(!user_id())
		redirect(base_url());
		return;
	}

	function register(){

		if(user_id()==""){

		$this->form_validation->set_rules('username','Username|is_unique[userdetails.username]', 'required');
		$this->form_validation->set_rules('email','Useremail|is_unique[userdetails.email]', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_rules('password_confirm',"Confirm password",'required|matches[password]');
		$this->form_validation->set_rules('phone_number',"Phone Number",'required');
		$this->form_validation->set_rules('checkbox',"Checkbox",'required');
		$this->form_validation->set_message('required',"%s  Required");
		$this->form_validation->set_message('matches',"Missmatching Password");
		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>1))->row();
				$data['main_js'] = "register";
				$data['countries'] = $this->Common_Model->getTableData(CN,'','','','','','','',array('country_name','asc'))->result();				
				$this->load->view('front/basic/register',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('email'));
				$split        = substr($email,0,3);
				$first_field  = insep_encode($split);
				$second_field = substr($email,3);

				$where = array('first_field'=>$first_field,'second_field'=>$second_field);

				$already_email	=	$this->Common_Model->getTableData(USERS,$where)->row();
				if( $already_email != "" )
				{
					$this->session->set_flashdata('error', 'This Email Address is already exits');
					redirect('register','refresh');
				}
				else
				{
					$result = $this->Basicmodel->register();
					$this->session->set_flashdata('success', 'Registration Process Completed. Check your mail to activate your account');
					redirect('register','refresh');
				}
		    }
		}else{
			redirect("index","refresh");
		}			
	}

	function account_activate($link=""){

		$where = array('activation_code'=>$link,'status'=>'deactive');

		$activationlink	=	$this->Common_Model->getTableData(USERS,$where)->row();

		if($activationlink!=""){

		$udata['activated_date'] = date('Y-m-d h:i:s');

		if(trim($activationlink->BTC_address) == '' || trim($activationlink->BTC_address) == '0'){

		$coinbase_det 	= $this->Common_Model->getTableData(WD,array('walletId'=>1))->row();

		$bitcoin_username 		= insep_decode($coinbase_det->username);
		$bitcoin_password 		= insep_decode($coinbase_det->password);
		$bitcoin_ip 	        = insep_decode($coinbase_det->ipaddress);
		$bitcoin_portnumber     = insep_decode($coinbase_det->portnumber);

		$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ip:$bitcoin_portnumber/");
		
		$first_field  = insep_decode($activationlink->first_field);

		$second_field = $activationlink->second_field;

		$useremail = $first_field.$second_field;

		$udata['BTC_address'] = $bitcoin->getaccountaddress($useremail);


	 }

	 if(trim($activationlink->ETH_address) == '' || trim($activationlink->ETH_address) == '0'){
			$udata['eth_address'] = $this->create_ethaddress("ETH");
	       }

		$udata['status'] = "active";

		$result = $this->Common_Model->updateTableData(USERS,array('user_id'=>$activationlink->user_id),$udata);

		if($result)
		{
			$error	=	$this->session->set_flashdata('success',"Your Account has been Activated Successfully");	
			redirect('index','refresh');		
		}
		else
		{
			$error	=	$this->session->set_flashdata('error',"Your account is already activated");		
			redirect('index','refresh');
		}
	  }else{
	  		$error	=	$this->session->set_flashdata('error',"Your account is already activated");		
			redirect('index','refresh');
	  }
	}


	function login(){

		if(user_id()==""){
		$this->form_validation->set_rules('user_email','Email', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_message('required',"%s  Required");
		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>2))->row();
				$data['main_js'] = "login";
				$this->load->view('front/basic/login',$data);
			}
		else
			{
				$user_email = $this->security->xss_clean($this->input->post('user_email'));
				$split        = substr($user_email,0,3);
				$first_field  = insep_encode($split);
				$second_field = substr($user_email,3);

				$where = array('first_field'=>$first_field,'second_field'=>$second_field);

				$res_user	=	get_data(USERS,$where)->row();
				if($res_user){
				if($res_user->randcode=="enable")
				{
					$result = $this->Basicmodel->login_tfa();
				}else{					
					$result = $this->Basicmodel->login();
				}
				if($result){
					$redirect_url = $this->session->userdata('redirect_back');
					// echo $result;
					if($redirect_url)
					{
						$this->session->unset_userdata('redirect_back');

						echo json_encode(array("res"=>$result,'redirect_url'=>$redirect_url));
						// redirect( $url.$redirect_url );
					}
					else
					{
						echo json_encode(array("res"=>$result,'redirect_url'=>""));
						// redirect($url);
					}
			   }
			 }
			 else{
			 	echo json_encode(array("res"=>"invalid",'redirect_url'=>""));
			   	  // echo "invalid";
			   }
		    }	
		}else{
			redirect('index','refresh');
		}
	}	

	function forgetpassword(){

		if(user_id()==""){

		$this->form_validation->set_rules('user_email','Email', 'required');
		$this->form_validation->set_message('required',"%s  Required");
		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>3))->row();
				$data['main_js'] = "login";
				$this->load->view('front/basic/forgetpassword',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('user_email'));
				$split        = substr($email,0,3);
				$first_field  = insep_encode($split);
				$second_field = substr($email,3);

				$where = array('first_field'=>$first_field,'second_field'=>$second_field);

				$userdetails = $this->Common_Model->getTableData(USERS,$where)->row();

				if($userdetails!=""){

				if($userdetails->status=="active"){

				$result = $this->Basicmodel->forgetpassword();

				if($result){
				$this->session->set_flashdata('success', 'Reset Password Link Sent to your email Successfully');
				redirect('forgetpassword','refresh');
			   }else{			   	
			   	$this->session->set_flashdata('error', 'Error Occurred while sending your reset password link');
				redirect('forgetpassword','refresh');
			   }
			   }else{
			   	$this->session->set_flashdata('error', 'Your Account has been Deactivated by Admin');
				redirect('forgetpassword','refresh');
			   }
			   }else{
			   	$this->session->set_flashdata('error', 'Invalid Email Id');
				redirect('forgetpassword','refresh');
			   }
		    }	
		}else{
			redirect("index","refresh");
		}		
	}

	function reset_password($code=''){

		$userdetails = $this->Common_Model->getTableData(USERS,array('forget_code'=>$code))->row();

		if($userdetails!="" && $code!=""){

		$date = date("Y-m-d H:i:s");

		$current_time = strtotime($date);

		$futureDate = $userdetails->forget_time+(60*15);

		$formatDate = date("Y-m-d H:i:s", $futureDate);	

		$future = strtotime($formatDate);

		if($current_time>$future){		
 		    $this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated');
			redirect('forgetpassword','refresh');
        }else{
        $data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>4))->row();
		$data['main_js'] = "login";		
		$data['user_id'] = $userdetails->user_id;
		$this->load->view('front/basic/resetpassword',$data);
	    }	
	  }else{
	  	 $this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated ');
		 redirect('forgetpassword','refresh');
	  }	   			
		 
	}

	function updateuser_password(){

		    $user_id = $this->input->post('user_id');

			if($this->input->post('password')!='' && $this->input->post('cpassword')!=''){

			$t_hasher = new PasswordHash(8, FALSE);
			
			$hash = $t_hasher->HashPassword($this->input->post('password'));

        	$updata['keyword'] = $hash;
        	$updata['forget_code'] = '';

		    $Updatedata = $this->Common_Model->updateTableData(USERS,array('user_id'=>$user_id),$updata);

			if($Updatedata){

				$this->session->set_flashdata('success', 'Password has been reset.Login With your new Password ');
				redirect('login','refresh');

			}else{
				$this->session->set_flashdata('error', 'Error Occurred while sending your reset password link');
				redirect('forgetpassword','refresh');
			}
		}
	}


	function cms($page=""){

		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>5))->row();
		$data['cms'] = $this->Common_Model->getTableData(CMS,array('page'=>$page,'status'=>1))->row();
		if($data['cms']){
		    $this->load->view('front/basic/cms',$data);
	    }else{	    	
		    $data['page_heading'] = '404 Page Not Found';         
			$this->load->view('404/404',$data);
	    }
	}

	function contact(){

		$this->form_validation->set_rules('name','Namw', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_rules('phone_number','Phone Number', 'required');	
		$this->form_validation->set_rules('subject','Subject', 'required');	
		$this->form_validation->set_rules('message','Message', 'required');	
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>20))->row();
				$data['main_js'] = "support";
				$this->load->view('front/basic/support',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('email'));

				$username = $this->security->xss_clean($this->input->post('name'));

				$idata['enquiry_name'] = $this->security->xss_clean($this->input->post('name'));
				$idata['enquiry_email'] = $this->security->xss_clean($this->input->post('email'));
				$idata['enquiry_subject'] = $this->security->xss_clean($this->input->post('subject'));
				$idata['enquiry_phone'] = $this->security->xss_clean($this->input->post('phone_number'));
				$idata['enquiry_message'] = $this->security->xss_clean($this->input->post('message'));
				$idata['created_date'] = date('Y-m-d h:i:s');
				$idata['status'] = 0;
				
				$result = $this->Common_Model->insertTableData(EQ,$idata);
				// echo $this->db->last_query();die;
				if($result){

				$email_template = '6';

			    $special_vars = array(
				'###SITELOGO###' => getSiteLogo(),
				'###SITENAME###' => getSiteName(),
				'###SITELINK###' => base_url(),
				'###FBLINK###'       => getSitesettings('facebook_url'),
				'###FBIMG###'        => base_url().'assets/social_images/fb.png',
				'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				'###TWITLINK###'     => getSitesettings('twitter_url'),
				'###GPLUSLINK###'    => getSitesettings('google_url'),
				'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				'###USERNAME###' => $username
				);

			    $this->Email_model->sendMail($email, '', '', $email_template, $special_vars);

				$this->session->set_flashdata('success', 'We will contact You as soon as possible');		
				redirect('contact','refresh');									
			   }else{			   	
			   	$this->session->set_flashdata('error', 'Error Occrred while contact support Please try again');		
				redirect('contact','refresh');
			   }				
		    }	
	}


	function support(){

		$this->form_validation->set_rules('name','Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_rules('phone_number','Phone Number', 'required');	
		$this->form_validation->set_rules('subject','Subject', 'required');	
		$this->form_validation->set_rules('message','Message', 'required');	
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>6))->row();
				$data['support_category'] = $this->Common_Model->getTableData(SUPPORTC,array('status'=>2))->result();
				// echo $this->db->last_query();die;
				$data['main_js'] = "support";
				$this->load->view('front/basic/support_new',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('email'));

				$username = $this->security->xss_clean($this->input->post('name'));

				$idata['enquiry_name'] = $this->security->xss_clean($this->input->post('name'));
				$idata['enquiry_email'] = $this->security->xss_clean($this->input->post('email'));
				$idata['enquiry_subject'] = $this->security->xss_clean($this->input->post('subject'));
				$idata['enquiry_phone'] = $this->security->xss_clean($this->input->post('phone_number'));
				$idata['enquiry_reason'] = $this->security->xss_clean($this->input->post('reason'));
				$idata['enquiry_message'] = $this->security->xss_clean($this->input->post('message'));
				$idata['created_date'] = date('Y-m-d h:i:s');
				$idata['status'] = 0;
				
				$result = $this->Common_Model->insertTableData(SUPPORT,$idata);

				if($result){

				$email_template = '16';

			    $special_vars = array(
				'###SITELOGO###' => getSiteLogo(),
				'###SITENAME###' => getSiteName(),
				'###SITELINK###' => base_url(),
				'###FBLINK###'       => getSitesettings('facebook_url'),
				'###FBIMG###'        => base_url().'assets/social_images/fb.png',
				'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				'###TWITLINK###'     => getSitesettings('twitter_url'),
				'###GPLUSLINK###'    => getSitesettings('google_url'),
				'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				'###USERNAME###' => $username
				);

			    $this->Email_model->sendMail($email, '', '', $email_template, $special_vars);

				$this->session->set_flashdata('success', 'We will contact You as soon as possible');		
				redirect('support','refresh');									
			   }else{			   	
			   	$this->session->set_flashdata('error', 'Error Occrred while contact support Please try again');		
				redirect('support','refresh');
			   }				
		    }	
	}	

	function username_exist(){
		$username = trim($this->input->get_post('username'));	
		$check = $this->Common_Model->getTableData(USERS, array('username' =>$username))->row();	
		if ($check=="")
		{ 		
			echo 'true';
			
		}					
		 else {
		 	echo 'false';			
		}				
	}
	

	function userphone_exist(){
		$phone_number = trim($this->input->get_post('phone_number'));	
		$check = $this->Common_Model->getTableData(USERS, array('cellno' =>$phone_number))->row();	
		if ($check=="")
		{
			echo 'true';
		}
		 else{
		 	echo 'false';			
		}
	}

	
	function useremail_exist(){
		$email = trim($this->input->get_post('email'));	

		$split        = substr($email,0,3);
		$first_field  = insep_encode($split);
		$second_field = substr($email,3);

		$where = array('first_field'=>$first_field,'second_field'=>$second_field);

		$check = $this->Common_Model->getTableData(USERS, $where)->row();

		if ($check=="")
		{
			echo 'true';
		}	
		else{
		 	echo 'false';
		}
	}
	

	function useremail_notexist(){

		$email        = trim($this->input->get_post('user_email'));
		$split        = substr($email,0,3);
		$first_field  = insep_encode($split);
		$second_field = substr($email,3);

		$where = array('first_field'=>$first_field,'second_field'=>$second_field);

		$check = $this->Common_Model->getTableData(USERS, $where)->row();

		if($check!="")
		{
			echo 'true';
		}
		else{
		 	echo 'false';
		}
	}

	function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('first_field');
		$this->session->unset_userdata('second_field');
		redirect(base_url());
	}


	function account(){

		/*$where = array('user_id'=>user_id());
		$user_det = get_data(USERS,$where,'username,first_field,second_field')->row();	
		echo $this->db->last_query();die;

		echo "<pre>";
		print_r($user_det);die;*/

		$this->is_login();

		$this->form_validation->set_rules('first_name','First Name', 'required');
		$this->form_validation->set_rules('useremail','User Email', 'required');		
		$this->form_validation->set_rules('country','Country', 'required');	
		$this->form_validation->set_message('required',"%s  Required");			
		if ($this->form_validation->run() == FALSE)
			{
				$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();
				$where = array('user_id'=>user_id());
				$data['userdetails'] = $this->Common_Model->getTableData(USERS, $where)->row();	
				$data['countries'] = $this->Common_Model->getTableData(CN)->result();

				$curr = array('currency'=>"ETH");

				$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();

				$table = 'ico_admin_bank_details';				

			  /*   $joins = array	(
								'ico_currency' => 'ico_currency.currency_id=ico_admin_bank_details.currency'
							);			

				$condition = array('ico_currency.type'=>'1','ico_admin_bank_details.bank_status'=>1);

				$group_by = array('ico_admin_bank_details.currency');

				$data['bank_details'] = $this->Common_Model->getJoinedTableData($table,$joins,$condition,$group_by)->result();*/

				 $data['bank_details'] = get_data(ADBANK,array('bank_status'=>1,'currency'=>2))->result(); 

			 //  echo $this->db->last_query();die;


				/*$bank=array('currency'=>2);

				$data['admin_bank'] = $this->Common_Model->getTableData(ADBANK,$bank)->result();*/

				$data['tokenlimit'] = getSitesettings('tokenlimit');
				$data['token_minlimit'] = getSitesettings('token_minlimit');

			/*	echo "<pre>";
				print_r($data['admin_bank']);die;*/


				$data['main_js'] = "account";		
				$this->load->view('front/basic/account',$data);
			}else{


		$email = $this->security->xss_clean($this->input->post('useremail'));

	    $udata['firstname'] = $this->security->xss_clean($this->input->post('first_name'));	    
	    $udata['country'] = $this->security->xss_clean($this->input->post('country'));
	    $udata['user_fiat_cur'] = $this->security->xss_clean($this->input->post('user_cur'));

		/*$split                 = substr($email,0,3);
		$udata['first_field']  = insep_encode($split);
		$udata['second_field'] = substr($email,3);*/

		/* profile image start here */

		if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!="" ){

			$fileNameParts = explode(".", $_FILES['profile_image']['name']);          
            
            $fileExtension = end($fileNameParts);

	        $fileExtension = strtolower($fileExtension);

	        // $date = date('Y-m-d_H:i:s');
	        $date = time();

			$encripted_pic_name       = 'profilepic_'.$date."." . $fileExtension;

			$upload_config = array(
				'upload_path' 	=> 'uploads/users/', 
				'allowed_types' => 'jpg|jpeg|gif|png', 						
				'overwrite'     => true,
				'maintain_ratio' => true,
				'file_name'     => $encripted_pic_name
			);

    		$this->load->library('upload', $upload_config);
			$this->upload->initialize($upload_config);
			if(!$this->upload->do_upload('profile_image')) {
				$uploadErrors = $this->upload->display_errors();
				$this->session->set_flashdata('error',$uploadErrors);
				redirect('account','refresh');
			} 
			else  {
				$uploadData_up 	= $this->upload->data();
				$big_image 		= $uploadData_up['file_name'];
				$udata['profilepicture'] 		= $big_image;  
				$old_pic = $this->input->post('old_profile_image');  
				$old_img = unlink("uploads/users/".$old_pic);
			}
		}
		else {
			$udata['profilepicture'] = $this->input->post('old_profile_image');    
		}

		
				/* profile image end here */

		$where = array('user_id'=>user_id());

		$result = $this->Common_Model->updateTableData(USERS,$where,$udata);

		// echo $this->db->last_query();die;

		if($result!=""){
			    $this->session->set_flashdata('success', 'Your Profile has been Updated Successfully');		
				redirect('account','refresh');
		}else{
			    $this->session->set_flashdata('error', 'Error Occurred while update your Profile');		
				redirect('account','refresh');
		}
	}
		
	}

	function change_password(){

		$this->is_login();

		$this->form_validation->set_rules('current_password','Current Password', 'required');
		$this->form_validation->set_rules('new_password','New Password', 'required');		
		$this->form_validation->set_rules('confirm_password','Confirm Password', 'required');	
		$this->form_validation->set_message('required',"%s  Required");			
		if ($this->form_validation->run() == FALSE)
		{
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();
			$where = user_id();
			$data['userdetails'] = $this->Common_Model->getTableData(USERS, $where)->row();	
			$data['countries'] = $this->Common_Model->getTableData(CN)->result();
			$data['main_js'] = "account";		
			$this->load->view('front/basic/change_password',$data);
		}else{		

		$current_password = $this->security->xss_clean($this->input->post('current_password'));

		$new_password = $this->security->xss_clean($this->input->post('new_password'));

		$confirm_password = $this->security->xss_clean($this->input->post('confirm_password'));


		$get_user = array('user_id'=>user_id());

		$userdet = $this->Common_Model->getTableData(USERS, $get_user)->row();

		$t_hasher = new PasswordHash(8, FALSE);

		$hash = $userdet->keyword;

		$check = $t_hasher->CheckPassword($this->input->post('current_password'), $hash);

		if($check!=""){

		if($new_password==$confirm_password){		

		$where = array('user_id'=>user_id());

		$t_hasher = new PasswordHash(8, FALSE);

		$hash = $t_hasher->HashPassword($new_password);

		$udata['keyword'] = $hash;

		$result = $this->Common_Model->updateTableData(USERS,$where,$udata);

		//echo $this->db->last_query();die;

		if($result!=""){
			    $this->session->set_flashdata('success', 'New Password Updated Successfully');
				redirect('change_password','refresh');
		}else{
			    $this->session->set_flashdata('error', 'Error Occurred while update your Password');
				redirect('change_password','refresh');
		}
	  }
	  else{
	  	$this->session->set_flashdata('error', 'New Password and Confirm Password did not match');
		redirect('change_password','refresh');
	  }
	}else{
		$this->session->set_flashdata('error', 'Old Password did not match');
		redirect('change_password','refresh');
	}
	}

	}	

	function withdraw_eth(){

		$this->is_login();

		$this->form_validation->set_rules('eth_address','ETH Address', 'required');
		$this->form_validation->set_rules('withdraw_amount','Withdraw Amount', 'required');		
		$this->form_validation->set_message('required',"%s  Required");			
		if ($this->form_validation->run() == FALSE)
		{
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();
			$where = user_id();
			$data['userdetails'] = $this->Common_Model->getTableData(USERS, $where)->row();	
			$data['countries'] = $this->Common_Model->getTableData(CN)->result();
			$curr = array('currency'=>"ETH");
			$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();		
			/*echo "<pre>";
		    print_r($data["commission"]);die;	*/
			$data['main_js'] = "account";		
			$this->load->view('front/withdraw/withdraw_eth',$data);
		}else{	

		$where = array('user_id'=>user_id());

		$currency_name = $this->input->post('currency_name');

		$user_balance = get_data(BALANCE,$where)->row()->$currency_name;

		$withdraw_amount = $this->security->xss_clean($this->input->post('withdraw_amount'));

		if($user_balance > $withdraw_amount){

		$curr = array('currency'=>$currency_name);

		$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();

		/*echo "<pre>";
		print_r($data["commission"]);die;*/

		$commission = $this->Common_Model->getTableData(COMM,$curr)->row();		

	 	if($commission->min_withdraw <= $withdraw_amount && $commission->max_withdraw >= $withdraw_amount){

		$user_det = get_data(USERS,$where,'username,first_field,second_field')->row();	

		$useremail = insep_decode($user_det->first_field).$user_det->second_field;

		$new_balance = $user_balance-$withdraw_amount;

		$newbalance = array($currency_name=>$new_balance);

		$updatebalance = $this->Common_Model->updateTableData(BALANCE,$where,$newbalance);

		/* echo "<pre>";
		print_r($user_det);die;*/

		$token = insep_encode(time());

		$todate = date("Y-m-d H:i:s");

		$idata['active_time'] = strtotime($todate);	

		$txn_id = 'TW'.$this->session->userdata('user_id').time();

		$withdraw_fee = $commission->withdraw_fee;

		$fee_amount =  ($withdraw_amount*$withdraw_fee)/100;

		$receive_amount = $withdraw_amount-$fee_amount;

		$idata['withdraw_amount'] = $this->security->xss_clean($this->input->post('withdraw_amount'));
		$idata['to_address'] = $this->security->xss_clean($this->input->post('eth_address'));
		$idata['withdraw_fee'] = $fee_amount;
		$idata['amount'] = $receive_amount;
		$idata['user_id'] = user_id();
		$idata['currency'] = $currency_name;
		$idata['status'] = "Processing";
		$idata['created_on'] = date('Y-m-d h:i:s');
		$idata['token'] = $token;

		$ins = $this->Common_Model->insertTableData(W,$idata);

		$insid  = $this->db->insert_id();

		if($ins){

		$transdata	=	array(
				'user_id'    	=> user_id(),
				'amount'  	 	=> $withdraw_amount,
				'orderId'		 => $insid,
				'token'			 => $token,
				'fee'   		=> $fee_amount,
				'receive_amount'   => $receive_amount,				
				'currency' => $currency_name,
				'transaction_id'=> $txn_id,
				'type'    		=> "Withdraw",
				'datetime'    	=> date('Y-m-d H:i:s'),
				'description'   => $currency_name.' Payment '.date('Y-m-d H:i:s'),
				'depositaddress' => $this->security->xss_clean($this->input->post('eth_address')),
				'status'=>"Processing"
			);
		$this->db->insert(TRANSACTION,$transdata);

		$adata['fee'] = $this->security->xss_clean($this->input->post('withdraw_fees'));		
		$adata['user_id'] = user_id();
		$adata['currency'] = "ETH";
		$adata['type'] = "Withdraw";
		$adata['datetime'] = date('Y-m-d h:i:s');

		$ins = $this->Common_Model->insertTableData(PF,$adata);



		$confirm_link = base_url()."withdraw_confirm/".$token;
		$cancel_link = base_url()."withdraw_cancel/".$token;

		$email_template = '8';

		$special_vars = array(
			'###SITELOGO###'    => getSiteLogo(),
			'###SITENAME###'    => getSiteName(),
			'###SITELINK###'    => base_url(),
			'###FBLINK###'       => getSitesettings('facebook_url'),
			'###FBIMG###'        => base_url().'assets/social_images/fb.png',
			'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
			'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
			'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
			'###TWITLINK###'     => getSitesettings('twitter_url'),
			'###GPLUSLINK###'    => getSitesettings('google_url'),
			'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
			'###USERNAME###'    => $user_det->username,
			'###CONFIRMLINK###' => $confirm_link,
			'###CANCELLINK###'  => $cancel_link
		);


		$result = $this->Email_model->sendMail($useremail, '', '', $email_template, $special_vars);		

		if($result!=""){
			    $this->session->set_flashdata('success', 'Withdraw Form Submitted Successfully');
				redirect('withdraw_eth','refresh');
		}else{
			    $this->session->set_flashdata('error', 'Error Occurred while submit your Withdraw form');		
				redirect('withdraw_eth','refresh');
		} 
	} 
	else{
		    $this->session->set_flashdata('error', 'Error Occurred while submit your Withdraw form');		
			redirect('withdraw_eth','refresh');
		} 
	}else{
		$this->session->set_flashdata('error', 'Please enter valid minimum and maximum withdraw amount');		
		redirect('withdraw_eth','refresh');
	}
	}else{
		$this->session->set_flashdata('error', 'Your have insufficient balance');		
		redirect('withdraw_eth','refresh');
	}
	}
	}


	function userbalance_exist(){

		$withdraw_amount = trim($this->input->get_post('withdraw_amount'));

		$currency_name = trim($this->input->get_post('currency_name'));
		
		$check = $this->Common_Model->getTableData(BALANCE, array('user_id' =>user_id()))->row()->$currency_name;
		
		if ($check>$withdraw_amount)
		{
			echo 'true';
		}
		else{
		 	echo 'false';
		}
	}


       function userbtc_address(){

		$btc_address = trim($this->input->get_post('btc_address'));	

		// 3J98t1WpEZ73CNmQviecrnyiWrnqRhWNLy

		$url="https://blockchain.info/rawaddr/$btc_address";    

		$cObj = curl_init(); 
		curl_setopt($cObj, CURLOPT_URL, $url);
		curl_setopt($cObj, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, 0);  
		curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);

		$btc = json_decode(curl_exec($cObj));   

		$curlinfos=curl_getinfo($cObj);

		if($btc){

		if ($btc->address) {
		echo 'true';
		} else {
			echo 'false';	
		}
		}else {
			echo 'false';	
		}	
		
		
	}



	function withdraw_confirm($link=""){

		$this->is_login();

		$withdraw_req = get_data(W,array('token'=>$link))->row();

		/*echo '<pre>';
		print_r($withdraw_req);die;*/

		$status = $withdraw_req->status;
		$currency = $withdraw_req->currency;
		$withdraw_id = $withdraw_req->withdraw_id;
		//$status = "Processing";

		if($status=="Cancelled" || $status=="Confirmed" ||$status == "Pending")
			{
				$data['value'] = "Error: Withdraw Requset has been already Confirmed or Cancelled earlier";

				 $this->session->set_flashdata('error', 'Withdraw Requset has been already Confirmed or Cancelled earlier');
				 if($currency=="BTC"){
				redirect('withdraw_btc','refresh');
				}else{
				redirect('withdraw_eth','refresh');				
				}					
			}else
			{
				$where = array('token'=>$link,'user_id'=>user_id());			

				$udata['status'] = "Pending";				

				$Update_data = $this->Common_Model->updateTableData(W,$where,$udata);

				if($Update_data){

				$withdraw =array('orderId'=>$withdraw_id);

				$trans = $this->Common_Model->updateTableData(TRANSACTION,$withdraw,$udata);

				$confirm_link = admin_url()."Botransactions/withdraw_confirmation/".$link;
				$cancel_link  = admin_url()."Botransactions/withdraw_cancellation/".$link;

				$email_template = '8';

				$getadmin_det 	= $this->Common_Model->getTableData(AD,array('admin_id'=>1))->row();

				$special_vars = array(
				'###SITELOGO###'    => getSiteLogo(),
				'###SITENAME###'    => getSiteName(),
				'###SITELINK###'    => base_url(),
				'###FBLINK###'       => getSitesettings('facebook_url'),
				'###FBIMG###'        => base_url().'assets/social_images/fb.png',
				'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				'###TWITLINK###'     => getSitesettings('twitter_url'),
				'###GPLUSLINK###'    => getSitesettings('google_url'),
				'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				'###USERNAME###'    => $getadmin_det->name,
				'###CONFIRMLINK###' => $confirm_link,
				'###CANCELLINK###'  => $cancel_link
				);

			$result = $this->Email_model->sendMail($getadmin_det->email_id, '', '', $email_template, $special_vars);		
			  if($result!=""){

			  	$succ = "Withdraw Confirmed Successfully by Yourself, It will be Pending until Admin Approval";
				$this->session->set_flashdata('success', $succ);				
				}else{

				  $errr = "Error Occurred While making Withdraw Confirmation";
				  $this->session->set_flashdata('error', $errr);				  
		        }
		    }else{
 					$this->session->set_flashdata('error', 'Error Occurred while submit your Withdraw form');					
		    }
		     if($currency=="BTC"){
				redirect('withdraw_btc','refresh');
				}else{
				redirect('withdraw_eth','refresh');				
				}	
		}
	}

	function withdraw_cancel($link=""){

		$this->is_login();
		$withdraw_req = get_data(W,array('token'=>$link))->row();		
		$status = $withdraw_req->status;
		$withdraw_amount = $withdraw_req->withdraw_amount;
		$currency = $withdraw_req->currency;
		$user_id = $withdraw_req->user_id;
		$withdraw_id = $withdraw_req->withdraw_id;
		
		//$status = "Processing";

		if($status=="Cancelled" || $status=="Confirmed" ||$status == "Pending")
			{
				$data['value'] = "Error: Withdraw Request has been already Confirmed or Cancelled earlier";

				 $this->session->set_flashdata('error', 'Withdraw Request has been already Confirmed or Cancelled earlier');
				if($currency=="BTC"){
				redirect('withdraw_btc','refresh');
				}else{
				redirect('withdraw_eth','refresh');				
				}				
			}else
			{

				$where = array('token'=>$link,'user_id'=>user_id());		

				$udata['status'] = "Cancelled";				

				$Update_data = $this->Common_Model->updateTableData(W,$where,$udata);

				if($Update_data){

				$withdraw =array('orderId'=>$withdraw_id);

				$trans = $this->Common_Model->updateTableData(TRANSACTION,$withdraw,$udata);

				$old_balance = get_data(BALANCE,array('user_id'=>$user_id))->row()->$currency;

				$new_balance = $old_balance+$withdraw_amount;

				$user_sec = array('user_id'=>$user_id);

				$bdata[$currency] = $new_balance;

				$result = $this->Common_Model->updateTableData(BALANCE,$user_sec,$bdata);

			  if($result!=""){
			  	$succ = "Withdraw Cancelled Successfully by Yourself";

				    $this->session->set_flashdata('success', $succ);					
				}else{
				    $this->session->set_flashdata('error', 'Error Occurred while submit your Withdraw Cancelled');					
		        }
			}else{
				    $this->session->set_flashdata('error', 'Error Occurred while submit your Withdraw Cancelled');					
			}

			if($currency=="BTC"){
				redirect('withdraw_btc','refresh');
			}else{
				redirect('withdraw_eth','refresh');				
			}
		}

	}


    function transfer_token(){

		$this->is_login();

		$this->form_validation->set_rules('from_address','From Address', 'required');			
		$this->form_validation->set_rules('to_address','To Address', 'required');			
		$this->form_validation->set_rules('token_count','No of tokens', 'required');			
		$this->form_validation->set_message('required',"%s  Required");		

		if ($this->form_validation->run() == FALSE)
		{
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();
			$data['main_js'] = "account";

			$data['token_minlimit'] = getSitesettings('token_minlimit');
			$data['tokenlimit'] = getSitesettings('tokenlimit');
			$data['token_symbol'] = get_data(TC,array('id'=>1))->row()->token_symbol;

			$this->load->view('front/token/transfer_token',$data);
		}else{


		$from_address = $this->security->xss_clean($this->input->post('from_address'));

		$to_address = $this->security->xss_clean($this->input->post('to_address'));

		$token_count = $this->security->xss_clean($this->input->post('token_count'));	

		$token_minlimit = getSitesettings('token_minlimit');

		$tokenlimit = getSitesettings('tokenlimit');

		if($from_address !=$to_address){

		$tok = array('user_id'=>user_id());

		$user_token = get_data(BALANCE,$tok)->row()->token_cnt;

		if($token_count > 0 && $token_count <= $tokenlimit && $user_token > $token_count && $token_count >= $token_minlimit){

			// $where = array('ETH_address'=>$to_address);
			$where = array('username'=>$to_address);

			$userdetails	=	$this->Common_Model->getTableData(USERS,$where)->row();

			if($userdetails){

			$idata['user_id'] = user_id();
			$idata['number_of_tokens'] = $token_count;
			$idata['status'] = 0;
			$idata['to_user_id'] = $userdetails->user_id;
			$idata['from_user_id'] = user_id();
			$idata['type'] = "transfer";
			$idata['date_time'] = date('Y-m-d h:i:s');
			$res = $this->Common_Model->insertTableData(TR,$idata);

			$udata['token_cnt'] = $user_token-$token_count;

			$upda = $this->Common_Model->updateTableData(BALANCE,$tok,$udata);			

			$this->session->set_flashdata('success', 'Token transfer has been added Successfully');
		    redirect('transfer_token','refresh');
		}else{
			$this->session->set_flashdata('error', 'Invalid ETH To address to send token');
			redirect('transfer_token','refresh');
		}
		}else{
			$this->session->set_flashdata('error', 'Insufficient Token Count to send');
			redirect('transfer_token','refresh');
		}
	}else{
			$this->session->set_flashdata('error', 'From address and to address are same');
			redirect('transfer_token','refresh');
		}
	}

	}

	function request_token(){

		$this->is_login();
		
		$this->form_validation->set_rules('request_tokens','No of tokens', 'required');
		$this->form_validation->set_rules('request_currency','Currency', 'required');
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
		{
			
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();

			$data['currencies'] = $this->Common_Model->getTableData(CURR,array('type'=>0))->result();

			$data['main_js'] = "account";

			$data['token_minlimit'] = getSitesettings('token_minlimit');

			$data['tokenlimit']     = getSitesettings('tokenlimit');	

			$data['token_ethvalue'] = getSitesettings('token_ethvalue');
			
			$data['token_btcvalue'] = getSitesettings('token_btcvalue');

			$data['token_symbol'] = get_data(TC,array('id'=>1))->row()->token_symbol;



		  $url="https://api.coinmarketcap.com/v1/ticker/?limit=2";			
  		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_URL,$url);
		  $result=curl_exec($ch);
		  curl_close($ch);
          $coin_price_details=json_decode($result, true);
		  $btc_usd_price =(float)$coin_price_details[0]["price_usd"];
	      $token_price_usd= getSitesettings('token_fiatvalue');
		  $token_price_btc=(float)($btc_usd_price/$token_price_usd);
		// $token_price_btc=1/$token_price_btc;
		 $data["token_price_btc"]=1/$token_price_btc;
		 $eth_usd_price =(float)$coin_price_details[1]["price_usd"];		
		 $token_price_eth=(float)($eth_usd_price/$token_price_usd);
		//$token_price_eth=;
		 $data["token_price_eth"]=1/$token_price_eth;	



			$this->load->view('front/token/request_token',$data);

		}else{

			$tfa_status = getuserdetails('randcode',user_id());

			if($tfa_status=="enable"){
				echo "valid";
			}else{


			$request_tokens = $this->security->xss_clean($this->input->post('request_tokens'));

			$request_currency = $this->security->xss_clean($this->input->post('request_currency'));			

			$whereCon = array('user_id'=>user_id());		

			$user_balance = get_data(BALANCE,$whereCon)->row()->$request_currency;

			$token_minlimit = getSitesettings('token_minlimit');	

			$tokenlimit = getSitesettings('tokenlimit');

			$token_ethvalue = getSitesettings('token_ethvalue');

			$token_btcvalue = getSitesettings('token_btcvalue');

			if($request_currency=="BTC"){
			  $get_curval = $token_btcvalue;
	         }else{
			  $get_curval = $token_ethvalue;
	         }

			$spend_cur = $get_curval*$request_tokens;

			if($user_balance>$spend_cur){

			if($request_tokens>0 && $request_tokens<=$tokenlimit && $request_tokens >=$token_minlimit){

				$u_data[$request_currency] = $user_balance-$spend_cur;

				$update_balance = $this->Common_Model->updateTableData(BALANCE,$whereCon,$u_data);
				// echo "uda".$update_balance." ".$spend_cur;die;
				if($update_balance){
				$idata['user_id'] = user_id();
				$idata['number_of_tokens'] = $request_tokens;
				$idata['status'] = 0;
				$idata['type'] = "request";
				$idata['token_currency'] = $request_currency;
				$idata['from_user_id'] = 0;
				$idata['to_user_id'] = 0;
				$idata['date_time'] = date('Y-m-d h:i:s');
				$res = $this->Common_Model->insertTableData(TR,$idata);
				// echo $this->db->last_query();die;
				if($res){

					$email_template = '13';

					$special_vars = array(
					'###SITELOGO###' => getSiteLogo(),
					'###SITENAME###' => getSiteName(),
					'###SITELINK###' => base_url(),
					'###FBLINK###'       => getSitesettings('facebook_url'),
					'###FBIMG###'        => base_url().'assets/social_images/fb.png',
					'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
					'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
					'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
					'###TWITLINK###'     => getSitesettings('twitter_url'),
					'###GPLUSLINK###'    => getSitesettings('google_url'),
					'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
					'###USERNAME###' => getuserdetails('username',user_id()),
					'###TOKENS###'   => $request_tokens,
					'###CURRENCY###' => $request_currency,
					'###AMOUNT###'   => $spend_cur
					);

					$user_email = getuseremail(user_id());

					$this->Email_model->sendMail($user_email, '', '', $email_template, $special_vars);
					echo 'success';					
				}else{
					echo "error";				
			}
			}else{
				echo "error";				
			}
			
		   }else{
		   		echo "error";		   	
		   }
		}
			else{		
			echo "balance";
			}
	}
}

	}


	function ethaddress_exist(){
		
		$eth_address = trim($this->input->get_post('to_address'));	
		$check = $this->Common_Model->getTableData(USERS, array('username' =>$eth_address))->row();	
		if($check){
		// echo $this->db->last_query();die;

		$new_address = $this->Common_Model->getTableData(USERS, array('user_id' =>user_id()))->row()->username;	

		if ($check->username!="" && $check->username!=$new_address)
		{ 		
			echo 'true';			
		}					
		 else {
		 	echo 'false';			
		}
	  }else{
	  	echo 'false';
	  }
	}

	   function deposit_usd(){

		$this->is_login();

		$this->form_validation->set_rules('deposit_amount','Deposit Amount', 'required');		
		$this->form_validation->set_rules('transaction_id','Transaction Address', 'required');
		$this->form_validation->set_rules('bank_name','Bank Name', 'required');
		$this->form_validation->set_message('required',"%s  Required");			
		if ($this->form_validation->run() == FALSE)
		{
			 $data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>12))->row();	
			 $data['bank_details'] = $this->Common_Model->getTableData(ADBANK,array('bank_status'=>1,'currency'=>2),'','','','','','',array('id','desc'))->result();
			 $data['main_js']	 = "account";
			$this->load->view('front/deposit/deposit_usd',$data);
		}else{

		$deposit_amount = $this->security->xss_clean($this->input->post('deposit_amount'));	
		$transaction_id = $this->security->xss_clean($this->input->post('transaction_id'));	
		$currency_name = $this->security->xss_clean($this->input->post('currency_name'));	
		$bank_name = $this->security->xss_clean($this->input->post('bank_name'));	


		$idata['amount'] = $deposit_amount;
		$idata['type'] = 'Deposit';
		$idata['currency'] = $currency_name;
		$idata['user_id'] = user_id();
		$idata['status'] = "Pending";
		$idata['created_on'] = date('Y-m-d h:i:s');		
		$idata['txid'] = $transaction_id;
		$idata['bank_proof'] = $bank_name;

		$ins = $this->Common_Model->insertTableData(D,$idata);

		// echo $this->db->last_query();die;

		$insid  = $this->db->insert_id();		

		if($ins){

		$transdata	=	array(
				'user_id'    	=> user_id(),
				'amount'  	 	=> $deposit_amount,
				'orderId'		 => $insid,
				'token'			 => "",
				'fee'   		=> '',							
				'currency' => $currency_name,
				'transaction_id'=> $transaction_id,
				'type'    		=> "Deposit",
				'datetime'    	=> date('Y-m-d H:i:s'),
				'description'   => $currency_name.' Payment '.date('Y-m-d H:i:s'),
				'depositaddress' => '',
				'status'=>"Pending"
			);
		$this->db->insert(TRANSACTION,$transdata);
		// echo $this->db->last_query();die;

		if($ins!=""){
			    $this->session->set_flashdata('success', 'Deposit Form Submitted Successfully');
				redirect('deposit_usd','refresh');
		}else{
			    $this->session->set_flashdata('error', 'Error Occurred while submit your Deposit form');		
				redirect('deposit_usd','refresh');
		} 
	} 
	else{
		    $this->session->set_flashdata('error', 'Error Occurred while submit your Deposit form');		
			redirect('deposit_usd','refresh');
		} 
	}

	}


	function verification(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>13))->row();		
		$data['countries'] = $this->Common_Model->getTableData(CN)->result();	
		$data['main_js']	 = "verification";
		$this->load->view('front/basic/verification',$data);
	}

	function phone_number_exists(){
		$phone_number = trim($this->input->get_post('phone_number'));	
		$check = $this->Common_Model->getTableData(USERS, array('cellno' =>$phone_number,'user_id'=>user_id()),'cellno')->row();
		if($check){
			if ($check->cellno==$phone_number)
			{ 	
				echo 'true';			
			}					
			 else {			 	
			 	echo 'false';			
			}	
	    }
		else{			
		 	echo 'false';					
		}
	}

	function phone_verification(){
		$this->is_login();

	/*	echo "<pre>";
		print_r($_POST);die;*/

		$phone_number = $this->security->xss_clean($this->input->post('phone_number'));


		$check = $this->Common_Model->getTableData(USERS, array('cellno' =>$phone_number,'user_id'=>user_id()),'cellno')->row();

		if($check){
		

		if($phone_number==$check->cellno){

				$otp = mt_rand(0,999999);

				$udata['key_code'] = $otp;

				$date = date("Y-m-d H:i:s");

				$code = strtotime($date);	

				$udata['key_time'] = $code;				

				$udata['first_level'] = "Pending";

				$update_phone = $this->Common_Model->updateTableData(USERS,array('user_id'=>user_id(),'cellno'=>$phone_number),$udata);

				if($update_phone){

					$email_template = '11';

					$special_vars = array(
					'###SITELOGO###' => getSiteLogo(),
					'###SITENAME###' => getSiteName(),
					'###SITELINK###' => base_url(),
					'###FBLINK###'       => getSitesettings('facebook_url'),
					'###FBIMG###'        => base_url().'assets/social_images/fb.png',
					'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
					'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
					'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
					'###TWITLINK###'     => getSitesettings('twitter_url'),
					'###GPLUSLINK###'    => getSitesettings('google_url'),
					'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
					'###USERNAME###' => getuserdetails('username',user_id()),
					'###OTP###'      => $otp
					);

					$user_email = getuseremail(user_id());

					$this->Email_model->sendMail($user_email, '', '', $email_template, $special_vars);

					echo "valid";

		  }else{
		  	echo "invalid_phone";
		  }
		}else{			
	  		echo "invalid_phone";
		}
	  }else{
	  	echo "invalid_phone";
	  }
	}

	function check_otp(){		

		$key_code = $this->security->xss_clean($this->input->post('otp_code'));

		$userdetails = $this->Common_Model->getTableData(USERS, array('user_id'=>user_id()),'key_code,key_time,first_level')->row();

		if($userdetails){

			$date = date("Y-m-d H:i:s");

			$current_time = strtotime($date);						

			$futureDate = $userdetails->key_time+(60*3);

			$formatDate = date("Y-m-d H:i:s", $futureDate);	

			$future = strtotime($formatDate);

			if($current_time>$future){
	 		   echo "expired";
	        }
	        else{

	        	if($key_code==$userdetails->key_code){

	            $udata['key_code'] = "";

				$udata['first_level'] = "Confirmed";

				$update_phone = $this->Common_Model->updateTableData(USERS,array('user_id'=>user_id()),$udata);

				echo "valid";

	        	}else{
	        		echo "invalid";
	        	}
	        }
	    }else{
	    	echo "invalid";
	    }



	}


	function personal_verification(){

		$address_line1 = $this->security->xss_clean($this->input->post('address_line1'));
		$address_line2 = $this->security->xss_clean($this->input->post('address_line2'));
		$city = $this->security->xss_clean($this->input->post('city'));
		$country = $this->security->xss_clean($this->input->post('country'));
		$gender = $this->security->xss_clean($this->input->post('gender'));
		$postal_code = $this->security->xss_clean($this->input->post('postal_code'));
		$dob = $this->security->xss_clean($this->input->post('dob'));

		$udata['address_line1'] = $address_line1;
		$udata['address_line2'] = $address_line2;
		$udata['city'] = $city;
		$udata['country'] = $country;
		$udata['gender'] = $gender;
		$udata['postal_code'] = $postal_code;
		$udata['dob'] = $dob;
		$udata['second_level'] = "Confirmed";

		$personal_details = $this->Common_Model->updateTableData(USERS,array('user_id'=>user_id()),$udata);

		//echo $this->db->last_query(); die;

		if($personal_details){
			echo "valid";
		}else{
			echo "invalid";
		}
	}


	function document_verification(){

		   /*echo '<pre>';		   
		   print_r($_FILES);die;*/

		  if(isset($_FILES['pan_proof']['name']) && $_FILES['pan_proof']['name']!="" ){

			$fileNameParts = explode(".", $_FILES['pan_proof']['name']);          
            
            $fileExtension = end($fileNameParts);

	        $fileExtension = strtolower($fileExtension);

	        $date = date('Y-m-d_H:i:s');

			$encripted_pic_name       = 'panpic_'.$date."." . $fileExtension;

			$upload_config = array(
				'upload_path' 	=> 'uploads/users/', 
				'allowed_types' => 'jpg|jpeg|png', 						
				'overwrite'     => true,
				'maintain_ratio' => true,
				'file_name'     => $encripted_pic_name
			);

    		$this->load->library('upload', $upload_config);
			$this->upload->initialize($upload_config);
			if(!$this->upload->do_upload('pan_proof')) {
				$uploadErrors = $this->upload->display_errors();
				$this->session->set_flashdata('error',$uploadErrors);
				redirect('verification','refresh');
			} 
			else  {
				$uploadData_up 	= $this->upload->data();
				$big_image 		= $uploadData_up['file_name'];
				$udata['pan_proof'] = $big_image;
				$udata['pan_status'] = "3";
				$old_pan = getuserdetails('pan_proof',user_id()); 
				if($old_pan!=""){			
					$pan_img = unlink("uploads/users/".$old_pan);
				} 
			}
		}

		  if(isset($_FILES['adhaar_proof']['name']) && $_FILES['adhaar_proof']['name']!="" ){

			$fileNameParts = explode(".", $_FILES['adhaar_proof']['name']);          
            
            $fileExtension = end($fileNameParts);

	        $fileExtension = strtolower($fileExtension);

	        $date = date('Y-m-d_H:i:s');

			$encripted_pic_name       = 'license'.$date."." . $fileExtension;

			$upload_config = array(
				'upload_path' 	=> 'uploads/users/', 
				'allowed_types' => 'jpg|jpeg|png', 						
				'overwrite'     => true,
				'maintain_ratio' => true,
				'file_name'     => $encripted_pic_name
			);

    		$this->load->library('upload', $upload_config);
			$this->upload->initialize($upload_config);
			if(!$this->upload->do_upload('adhaar_proof')) {
				$uploadErrors = $this->upload->display_errors();
				$this->session->set_flashdata('error',$uploadErrors);
				redirect('verification','refresh');
			} 
			else  {
				$uploadData_up 	= $this->upload->data();
				$license_image 		= $uploadData_up['file_name'];
				$udata['adhaar_proof'] = $license_image;
				$udata['adhaar_status'] = "3"; 
				$old_adhaar = getuserdetails('adhaar_proof',user_id()); 
				if($old_adhaar!=""){					
					$adhaar_img = unlink("uploads/users/".$old_adhaar);
				}                	

			}
		}

		  if(isset($_FILES['id_proof']['name']) && $_FILES['id_proof']['name']!="" ){

			$fileNameParts = explode(".", $_FILES['id_proof']['name']);          
            
            $fileExtension = end($fileNameParts);

	        $fileExtension = strtolower($fileExtension);

	        $date = date('Y-m-d_H:i:s');

			$encripted_pic_name       = 'id'.$date."." . $fileExtension;

			$upload_config = array(
				'upload_path' 	=> 'uploads/users/', 
				'allowed_types' => 'jpg|jpeg|png', 						
				'overwrite'     => true,
				'maintain_ratio' => true,
				'file_name'     => $encripted_pic_name
			);

    		$this->load->library('upload', $upload_config);
			$this->upload->initialize($upload_config);
			if(!$this->upload->do_upload('id_proof')) {
				$uploadErrors = $this->upload->display_errors();
				$this->session->set_flashdata('error',$uploadErrors);
				redirect('verification','refresh');
			} 
			else  {
				$uploadData_up 	= $this->upload->data();
				$id_image 		= $uploadData_up['file_name'];
				$udata['id_proof'] = $id_image;
				$udata['id_status'] = "3";
				$old_id = getuserdetails('id_proof',user_id()); 
				if($old_id!=""){					
					$idd_img = unlink("uploads/users/".$old_id);
				} 
			}
		}

		// echo "<pre>";
		// print_r($udata);die;

		  $personal_details = $this->Common_Model->updateTableData(USERS,array('user_id'=>user_id()),$udata);

		// echo $this->db->last_query(); die;

		if($personal_details){
			echo "valid";
		}else{
			echo "invalid";
		}

	}

	function get_bank(){
		$id = $this->input->post('id');
		$bank=array('id'=>$id);
		$data['admin_bank'] = $this->Common_Model->getTableData(ADBANK,$bank)->result();
		$this->load->view('front/basic/admin_bank',$data);
	}

	function tfa(){
		$this->is_login();
		 $this->form_validation->set_rules('tfa_code','Enter TFA code', 'required');					
	    $this->form_validation->set_rules('secret_code','', 'required');					
		$this->form_validation->set_message('required',"%s  Required");	
		$this->load->library('Googleauthenticator'); 
		$ga = new Googleauthenticator();		
			
		if ($this->form_validation->run() == FALSE)
		{
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>14))->row();
			$data['main_js'] = "account";		

		if(trim(getuserdetails('secret',user_id()))!=''){
				$secret_code = getuserdetails('secret',user_id());
			 	//$tfa_url = $ga->getQRCodeGoogleUrl(getSiteName(), $secret_code);
		       $tfa_url = getuserdetails('tfa_url',user_id());
		}else{
			 $secret_code = $ga->createSecret(); 
			 $tfa_url = $ga->getQRCodeGoogleUrl(getSiteName(), $secret_code);
		}	 			
		$data['secret_code'] = $secret_code;
		$data['auth_url'] = $tfa_url;	
		$this->load->view('front/basic/tfa',$data);
		}else{				
			require_once 'GoogleAuthenticator.php';
	        $ga = new PHPGangsta_GoogleAuthenticator();

			$tfa_code = $this->security->xss_clean($this->input->post('tfa_code'));
			$secret_code = $this->security->xss_clean($this->input->post('secret_code'));
			$tfa_url = $this->security->xss_clean($this->input->post('tfa_url'));

			$discrepancy = 0;

			$code = $ga->verifyCode($secret_code,$tfa_code,$discrepancy = 2);	

			// echo $code."sdsd";die;
			$user_status = getuserdetails('randcode',user_id());

			if($user_status != "enable")
			{			
			//	$code = 1;				
				if($code==1)
				{
					$this->db->where('user_id',user_id());
					$data=array(
							'secret'  => $secret_code,
							'onecode' => $tfa_code,
							'tfa_url' => $tfa_url,
							'randcode'  => "enable"
								);
					$this->db->update(USERS,$data);
				   echo "Enable";
				}
				else
				{
					return 0;
				}
			}else{

				//$code = 1;				
				if($code==1)
				{
					$this->db->where('user_id',user_id());
					$data=array(
							'secret'  => $secret_code,
							'onecode' => $tfa_code,
							'tfa_url' => $tfa_url,							
							'randcode'  => "disable"
								);
					$this->db->update(USERS,$data);
				   echo "disable";
				}
				else
				{
					return 0;
				}
			}
	}
		
	}


	function wallet(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>15))->row();	
		$data['user_email']	 = getuseremail(user_id());
		$data['userdetail'] = $this->Common_Model->getTableData(USERS,array('user_id'=>user_id()),'username,user_id,cellno,first_level,second_level,pan_status,id_status,adhaar_status')->row();

		$statuss = $this->Common_Model->getTableData(USERS,array('user_id'=>user_id()),'first_level,second_level,pan_status,id_status,adhaar_status')->row();

		$first_level = $statuss->first_level;

		$second_level = $statuss->second_level;

		$pan_status = $statuss->pan_status;

		$id_status = $statuss->id_status;

		$adhaar_status = $statuss->adhaar_status;

		if($first_level=="Confirmed" && $second_level=="Confirmed" && $pan_status==1 && $id_status==1 && $adhaar_status==1){
			$data['verify_status'] = "Verified";
		}else{
			$data['verify_status'] = "Unverified";			
		}

		$data['user_balance'] = $this->Common_Model->getTableData(BALANCE,array('user_id'=>user_id()))->row();		

		$this->load->view('front/wallet',$data);
	}

	function deposit_btc(){
		
		$this->is_login();

		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>12))->row();

		 $url="https://api.coinmarketcap.com/v1/ticker/?limit=2";			
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);

		$coin_price_details=json_decode($result, true);
		 $btc_usd_price =(float)$coin_price_details[0]["price_usd"];
	
		 $token_price_usd= getSitesettings('token_fiatvalue');
		 $token_price_btc=(float)($btc_usd_price/$token_price_usd);
		// $token_price_btc=1/$token_price_btc;
		 $data["token_price_btc"]=1/$token_price_btc;


		 $eth_usd_price =(float)$coin_price_details[1]["price_usd"];		
		 $token_price_eth=(float)($eth_usd_price/$token_price_usd);
		//$token_price_eth=;
		 $data["token_price_eth"]=1/$token_price_eth;
	


		// $this->create_btcaddress("BTC");
		
		$data['btc_address'] = getuserdetails('BTC_address',user_id());	
			$this->load->view('front/deposit/deposit_btc',$data);
	}

	function deposit_eth(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>16))->row();

		/*$where  = array('user_id'=>user_id());

	    $checkAddress_eth	=	$this->Common_Model->getTableData(USERS,$where)->row()->ETH_address;

	    if($checkAddress_eth==""){
	    	$udata['ETH_address'] = $this->create_ethaddress("ETH");	    	
	    	$this->Common_Model->updateTableData(USERS,array('user_id'=>user_id()),$udata);
	    }*/



		$url="https://api.coinmarketcap.com/v1/ticker/?limit=2";			
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);

		$coin_price_details=json_decode($result, true);
		 $btc_usd_price =(float)$coin_price_details[0]["price_usd"];
	
		 $token_price_usd= getSitesettings('token_fiatvalue');
		 $token_price_btc=(float)($btc_usd_price/$token_price_usd);
		// $token_price_btc=1/$token_price_btc;
		 $data["token_price_btc"]=1/$token_price_btc;


		 $eth_usd_price =(float)$coin_price_details[1]["price_usd"];		
		 $token_price_eth=(float)($eth_usd_price/$token_price_usd);
		//$token_price_eth=;
		 $data["token_price_eth"]=1/$token_price_eth;
	



		$eth_address = getuserdetails('ETH_address',user_id());	

		$data['eth_address'] = $eth_address;
		
		$this->load->view('front/deposit/deposit_eth',$data);
	}

	function checktfa()
	{
		echo $tfa_result=$this->Basicmodel->checktfa();
	}

	

	function transaction_history(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>17))->row();
		$data['transaction_history'] = $this->Common_Model->getTableData(TRANSACTION,array('user_id'=>user_id()),'','','','','','',array('transactionId','desc'))->result();
		$this->load->view('front/history/transaction_history',$data);
	}

	function token_history(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>18))->row();
		$data['token_request'] = $this->Common_Model->getTableData(TR,array('user_id'=>user_id()),'','','','','','',array('req_id','desc'))->result();
		$this->load->view('front/history/token_history',$data);
	}

	function investment_history(){
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>19))->row();
		$data['investment_history'] = $this->Common_Model->getTableData(INVEST,array('user_id'=>user_id()),'','','','','','',array('invest_id','desc'))->result();
		// echo "<pre>";		
		// print_r($data['investment_history']);die;
		$this->load->view('front/history/investment_history',$data);
	}


function get_simbolo(){ 
	echo $this->security->get_csrf_hash(); 
}

  function withdraw_btc(){

		$this->is_login();

		$this->form_validation->set_rules('btc_address','BTC Address', 'required');
		$this->form_validation->set_rules('withdraw_amount','Withdraw Amount', 'required');
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
		{
			$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>8))->row();
			$where = user_id();
			$curr = array('currency'=>"BTC");
			$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();
			$data['main_js'] = "account";
			$this->load->view('front/withdraw/withdraw_btc',$data);
		}else{	

		$tfa_status = getuserdetails('randcode',user_id());

		if($tfa_status=="enable"){
			echo "valid";
		}
		else{		

		$where = array('user_id'=>user_id());

		$currency_name = $this->input->post('currency_name');

		$user_balance = get_data(BALANCE,$where)->row()->$currency_name;

		$withdraw_amount = $this->security->xss_clean($this->input->post('withdraw_amount'));

		if($user_balance > $withdraw_amount){

		$curr = array('currency'=>$currency_name);

		$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();

		$commission = $this->Common_Model->getTableData(COMM,$curr)->row();		

		// echo "<pre>";
		// print_r($commission);die;

	 	if($commission->min_withdraw <= $withdraw_amount && $commission->max_withdraw >= $withdraw_amount){

		$user_det = get_data(USERS,$where,'username,first_field,second_field')->row();	

		$useremail = insep_decode($user_det->first_field).$user_det->second_field;

		$new_balance = $user_balance-$withdraw_amount;

		$newbalance = array($currency_name=>$new_balance);

		$updatebalance = $this->Common_Model->updateTableData(BALANCE,$where,$newbalance);

		/* echo "<pre>";
		print_r($user_det);die;*/

		$token = insep_encode(time());

		$todate = date("Y-m-d H:i:s");

		$idata['active_time'] = strtotime($todate);

		$txn_id = 'TW'.$this->session->userdata('user_id').time();

		$withdraw_fee = $commission->withdraw_fee;

		$fee_amount =  ($withdraw_amount*$withdraw_fee)/100;

		$receive_amount = $withdraw_amount-$fee_amount;

		$idata['withdraw_amount'] = $this->security->xss_clean($this->input->post('withdraw_amount'));

		$idata['to_address'] = $this->security->xss_clean($this->input->post('btc_address'));

		$idata['withdraw_fee'] = $fee_amount;
		$idata['amount']       = $receive_amount;
		$idata['user_id']      = user_id();
		$idata['currency']     = $currency_name;
		$idata['status']       = "Processing";
		$idata['created_on']   = date('Y-m-d h:i:s');
		$idata['token']        = $token;

		$ins = $this->Common_Model->insertTableData(W,$idata);

		$insid  = $this->db->insert_id();

		if($ins){

		$transdata	=	array(
				'user_id'    	 => user_id(),
				'amount'  	 	 => $withdraw_amount,
				'orderId'		 => $insid,
				'token'			 => $token,
				'fee'   		 => $fee_amount,
				'receive_amount' => $receive_amount,				
				'currency'       => $currency_name,
				'transaction_id' => $txn_id,
				'type'    		 => "Withdraw",
				'datetime'    	 => date('Y-m-d H:i:s'),
				'description'    => $currency_name.' Payment '.date('Y-m-d H:i:s'),
				'depositaddress' => $this->security->xss_clean($this->input->post('eth_address')),
				'status'=>"Processing"
			);
		$this->db->insert(TRANSACTION,$transdata);

		$adata['fee'] = $this->security->xss_clean($this->input->post('withdraw_fees'));		
		$adata['user_id'] = user_id();
		$adata['currency'] = $currency_name;
		$adata['type'] = "Withdraw";
		$adata['datetime'] = date('Y-m-d h:i:s');

		$ins = $this->Common_Model->insertTableData(PF,$adata);

		$confirm_link = base_url()."withdraw_confirm/".$token;
		$cancel_link = base_url()."withdraw_cancel/".$token;

		$email_template = '8';

		$special_vars = array(
			'###SITELOGO###'     => getSiteLogo(),
			'###SITENAME###'     => getSiteName(),
			'###SITELINK###'     => base_url(),
			'###FBLINK###'       => getSitesettings('facebook_url'),
			'###FBIMG###'        => base_url().'assets/social_images/fb.png',
			'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
			'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
			'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
			'###TWITLINK###'     => getSitesettings('twitter_url'),
			'###GPLUSLINK###'    => getSitesettings('google_url'),
			'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
			'###USERNAME###'     => $user_det->username,
			'###CONFIRMLINK###'  => $confirm_link,
			'###CANCELLINK###'   => $cancel_link
		);


		$result = $this->Email_model->sendMail($useremail, '', '', $email_template, $special_vars);		

		if($result!=""){
			echo "success";
		}else{
			echo "error";
		}
	} 
	else{
		echo "error";
		}
	}else{
		echo "minimum";
	}
	}else{
		echo "balance";
	}
    }
	}
	}


	function check_btc(){
		// echo "<pre>";
		// print_r($_POST);die;

	require_once 'GoogleAuthenticator.php';
	$ga 	= new PHPGangsta_GoogleAuthenticator();
	

	$user_wh = array('user_id'=>user_id());	

	$btc_code = $this->security->xss_clean($this->input->post('btc_code'));
	$btc_address = $this->security->xss_clean($this->input->post('btc_address'));
	$withdraw_amount = $this->security->xss_clean($this->input->post('withdraw_amount'));	

	$secc = get_data(USERS,$user_wh)->row();

	$secret	=$secc->secret;	

	$code = $this->security->xss_clean($this->input->post('btc_code'));	

	$oneCode = $ga->verifyCode($secret,$code,1);	

	// $oneCode = 1;

	if($oneCode==1)
	{

	    $where = array('user_id'=>user_id());

		$currency_name = $this->input->post('currency_name');

		$user_balance = get_data(BALANCE,$where)->row()->$currency_name;

		$withdraw_amount = $this->security->xss_clean($this->input->post('withdraw_amount'));

		if($user_balance > $withdraw_amount){

		$curr = array('currency'=>$currency_name);

		$data['commission'] = $this->Common_Model->getTableData(COMM,$curr)->row();

		$commission = $this->Common_Model->getTableData(COMM,$curr)->row();


		// echo "<pre>";
		// print_r($commission);die;

	 	if($commission->min_withdraw <= $withdraw_amount && $commission->max_withdraw >= $withdraw_amount){

		$user_det = get_data(USERS,$where,'username,first_field,second_field')->row();	

		$useremail = insep_decode($user_det->first_field).$user_det->second_field;

		$new_balance = $user_balance-$withdraw_amount;

		$newbalance = array($currency_name=>$new_balance);

		$updatebalance = $this->Common_Model->updateTableData(BALANCE,$where,$newbalance);

		/* echo "<pre>";
		print_r($user_det);die;*/

		$token = insep_encode(time());

		$todate = date("Y-m-d H:i:s");

		$idata['active_time'] = strtotime($todate);	

		$txn_id = 'TW'.$this->session->userdata('user_id').time();

		$withdraw_fee = $commission->withdraw_fee;

		$fee_amount =  ($withdraw_amount*$withdraw_fee)/100;

		$receive_amount = $withdraw_amount-$fee_amount;


		$idata['withdraw_amount'] = $this->security->xss_clean($this->input->post('withdraw_amount'));
		$idata['to_address'] = $this->security->xss_clean($this->input->post('btc_address'));
		$idata['withdraw_fee'] = $fee_amount;
		$idata['amount'] = $receive_amount;
		$idata['user_id'] = user_id();
		$idata['currency'] = $currency_name;
		$idata['status'] = "Processing";
		$idata['created_on'] = date('Y-m-d h:i:s');
		$idata['token'] = $token;

		$ins = $this->Common_Model->insertTableData(W,$idata);

		$insid  = $this->db->insert_id();

		if($ins){

		$transdata	=	array(
				'user_id'    	 => user_id(),
				'amount'  	 	 => $withdraw_amount,
				'orderId'		 => $insid,
				'token'			 => $token,
				'fee'   		 => $fee_amount,
				'receive_amount' => $receive_amount,				
				'currency'       => $currency_name,
				'transaction_id' => $txn_id,
				'type'    		 => "Withdraw",
				'datetime'    	 => date('Y-m-d H:i:s'),
				'description'    => $currency_name.' Payment '.date('Y-m-d H:i:s'),
				'depositaddress' => $this->security->xss_clean($this->input->post('eth_address')),
				'status'=>"Processing"
			);
		$this->db->insert(TRANSACTION,$transdata);

		$adata['fee'] = $this->security->xss_clean($this->input->post('withdraw_fees'));		
		$adata['user_id'] = user_id();
		$adata['currency'] = $currency_name;
		$adata['type'] = "Withdraw";
		$adata['datetime'] = date('Y-m-d h:i:s');

		$ins = $this->Common_Model->insertTableData(PF,$adata);

		$confirm_link = base_url()."withdraw_confirm/".$token;
		$cancel_link = base_url()."withdraw_cancel/".$token;

		$email_template = '8';

		$special_vars = array(
			'###SITELOGO###'    => getSiteLogo(),
			'###SITENAME###'    => getSiteName(),
			'###SITELINK###'    => base_url(),
			'###FBLINK###'       => getSitesettings('facebook_url'),
			'###FBIMG###'        => base_url().'assets/social_images/fb.png',
			'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
			'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
			'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
			'###TWITLINK###'     => getSitesettings('twitter_url'),
			'###GPLUSLINK###'    => getSitesettings('google_url'),
			'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
			'###USERNAME###'    => $user_det->username,
			'###CONFIRMLINK###' => $confirm_link,
			'###CANCELLINK###'  => $cancel_link
		);

		$result = $this->Email_model->sendMail($useremail, '', '', $email_template, $special_vars);		

		if($result!=""){
			echo "success";
		}else{
			echo "error";			  
		}
	} 
	else{
		echo "error";
		}
	}else{
		echo "minimum";		
	}
	}else{
		echo "balance";		
	}				
	}else{
		return "wrong";
	}


	}


	/*  search starts here  */

	function property_search(){		
		if (isset($_GET['term']))
		{
			$search_value = strtolower($_GET['term']);
			
			$search = $this->Basicmodel->product_name_search($search_value);
			 print_r($search ); exit; 
			echo $search;
		}
	}

	function chk_cryptobalance(){	

		$request_currency = $this->input->get_post('request_currency');
		$request_tokens = $this->input->get_post('request_tokens');		

		if($request_currency=="BTC"){
			$get_curval = getSitesettings('token_btcvalue');
	    }else{
			$get_curval = getSitesettings('token_ethvalue');
	    }

		$spend_cur = $get_curval*$request_tokens;

		$where = array('user_id'=>user_id());		

		$user_balance = get_data(BALANCE,$where)->row()->$request_currency;			

		if($user_balance>$spend_cur){
			echo 'true';
		}else{
			echo 'false';
		}
		
	}

	/*  search ends here  */

	function check_request_token(){

	require_once 'GoogleAuthenticator.php';

	$ga 	= new PHPGangsta_GoogleAuthenticator();	

	$user_wh = array('user_id'=>user_id());	

	$request_tokens = $this->security->xss_clean($this->input->post('request_tokens'));

	$request_currency = $this->security->xss_clean($this->input->post('request_currency'));	

	$secc = get_data(USERS,$user_wh)->row();

	$secret	=$secc->secret;	

	$code = $this->security->xss_clean($this->input->post('token_code'));	

	$oneCode = $ga->verifyCode($secret,$code,1);

	// $oneCode = 1;

	if($oneCode==1)
	{
			$whereCon = array('user_id'=>user_id());

			$user_balance = get_data(BALANCE,$whereCon)->row()->$request_currency;

			$tokenlimit = getSitesettings('tokenlimit');

			$token_ethvalue = getSitesettings('token_ethvalue');

			$token_btcvalue = getSitesettings('token_btcvalue');

			if($request_currency=="BTC"){
			  $get_curval = $token_btcvalue;
	         }else{
			  $get_curval = $token_ethvalue;
	         }

			$spend_cur = $get_curval*$request_tokens;

			if($user_balance>$spend_cur){

			if($request_tokens>0 && $request_tokens<=$tokenlimit){

				$u_data[$request_currency] = $user_balance-$spend_cur;

				$update_balance = $this->Common_Model->updateTableData(BALANCE,$whereCon,$u_data);

				if($update_balance){

				$idata['user_id'] = user_id();
				$idata['number_of_tokens'] = $request_tokens;
				$idata['status'] = 0;
				$idata['type'] = "request";
				$idata['token_currency'] = $request_currency;
				$idata['date_time'] = date('Y-m-d h:i:s');
				$res = $this->Common_Model->insertTableData(TR,$idata);

				//echo $this->db->last_query();die;

				if($res){

					$email_template = '13';

					$special_vars = array(
					'###SITELOGO###' => getSiteLogo(),
					'###SITENAME###' => getSiteName(),
					'###SITELINK###' => base_url(),
					'###FBLINK###'       => getSitesettings('facebook_url'),
					'###FBIMG###'        => base_url().'assets/social_images/fb.png',
					'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
					'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
					'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
					'###TWITLINK###'     => getSitesettings('twitter_url'),
					'###GPLUSLINK###'    => getSitesettings('google_url'),
					'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
					'###USERNAME###' => getuserdetails('username',user_id()),
					'###TOKENS###'   => $request_tokens,
					'###CURRENCY###' => $request_currency,
					'###AMOUNT###'   => $spend_cur
					);

					$user_email = getuseremail(user_id());

					$this->Email_model->sendMail($user_email, '', '', $email_template, $special_vars);
					echo 'success';					
				}else{
					echo "error";				
			}
			}else{
				echo "error";				
			}			
		   }else{
		   		echo "error";
		   }
     	}
			else{		
			echo "balance";
			}

	}else{
		return "wrong";
	}

	}


 

function btc_deposit_address(){

	       $coinbase_det 	= $this->Common_Model->getTableData(WD, array('walletId' => '1'))->row();	   

		 	$bitcoin_username 		= insep_decode($coinbase_det->username);
		    $bitcoin_password 		= insep_decode($coinbase_det->password);
			$bitcoin_ip 	        = insep_decode($coinbase_det->ipaddress);
			$bitcoin_portnumber     = insep_decode($coinbase_det->portnumber);				

		

		$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ip:$bitcoin_portnumber/");	
					

         $bitcoin_isvalid         =     $bitcoin->listtransactions('*',100);

       /* echo "<pre>";
        print_r($bitcoin_isvalid);die;*/
 
       	if($bitcoin_isvalid)
	{

	for($i=0;$i<count($bitcoin_isvalid);$i++)
	{

		$account      =      $bitcoin_isvalid[$i]['account'];
		$category     =      $bitcoin_isvalid[$i]['category'];
		$btctxid      =      $bitcoin_isvalid[$i]['txid'];

		$btcaccount = $bitcoin_isvalid[$i]['account'];
		$btcaddress = $bitcoin_isvalid[$i]['address'];
		$bitcoin_balance  = $bitcoin_isvalid[$i]['amount'];
		$btcconfirmations = $bitcoin_isvalid[$i]['confirmations'];

	if($category=="receive")
	{


	$isvalid = $bitcoin->gettransaction($btctxid);	    

	$det_category  =   $isvalid['details'][0]['category'];

	if($det_category=="receive")
	{		
		$btcaccount         =     $isvalid['details'][0]['account'];
		$btcaddress         =     $isvalid['details'][0]['address'];
		$bitcoin_balance    =     $isvalid['details'][0]['amount']; 
		$btcconfirmations   =     $isvalid['confirmations']; 
	}
	else
	{		
		$btcaccount         =     $isvalid['details'][1]['account'];
		$btcaddress         =     $isvalid['details'][1]['address'];
		$bitcoin_balance    =     $isvalid['details'][1]['amount']; 
		$btcconfirmations   =     $isvalid['confirmations'];
	}

		$split        = substr($btcaccount,0,3);
		$first_field  = insep_encode($split);
		$second_field = substr($btcaccount,3);

		$where = array('first_field'=>$first_field,'second_field'=>$second_field);

		$btcuserId1= $this->Common_Model->getTableData(USERS,$where)->row();

		// echo "<pre>";
		// print_r($btcuserId1);die;
	
		$btcuserId = $btcuserId1->user_id;
		
		$dep_id             = $btctxid;

		$bitcoin_balance     = $bitcoin_balance;

	if($btcconfirmations >= 6)
	{

		$dep_already = $this->checkdepositalreadypending1($btcuserId,$dep_id,$btcaddress,"Deposit"); 
	
		if(!$dep_already)
		{

			$fetchBTCbalance     = $this->fetchuserbalancebyId($btcuserId,'BTC');

			$updateBTCbalance     = $fetchBTCbalance+$bitcoin_balance;

			$cur_date = date('Y-m-d H:i:s');	
			
			$btctransdata = array(
			"user_id"=>$btcuserId,
			"type"=>"Deposit",
			"currency"=>"BTC",
			"depositaddress"=>$btcaddress,
			"amount"=>$bitcoin_balance,
			"description"=>"BTC payment",
			"datetime"=>$cur_date,	
			"transaction_id"=>$dep_id,
			"status"=>"Completed"
			);
			$this->db->insert(TRANSACTION,$btctransdata);

			$fetchBTCbalance     = $this->fetchuserbalancebyId($btcuserId,'BTC');

			$updateBTCbalance     = $fetchBTCbalance+$bitcoin_balance;	

			$this->db->where('user_id',$btcuserId); 	

			$this->db->update(BALANCE,array('BTC'=>$updateBTCbalance));

	  }	

	}

	}  
	}

	}
}


    function create_ethaddress($currency) {

    	$createAddress="";

		$output = shell_exec('curl -H "Content-Type: application/json" -X POST --data \'{"jsonrpc":"2.0","method":"personal_newAccount","params":["sZeEhrMhqqXrJXwYkABbirtZIxGpZGvO"],"id":1}\' "localhost:8545"');

		$res = json_decode($output);	

		$createAddress = $res->result;
		
		return $createAddress;
    	
	}


	function create_btcaddress($cu=""){

		require_once 'jsonRPCClient.php';

		$where  = array('user_id'=>user_id());

	    $checkAddress_btc	=	$this->Common_Model->getTableData(USERS,$where)->row()->BTC_address;
		
		if($checkAddress_btc != ""){
			$rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=$checkAddress_btc&choe=UTF-8&chld=L"; 
			$checkAddress 		= $checkAddress_btc;
			return $bth_data 	= array('checkAddress' => $checkAddress, 'rootUrl' => $rootUrl);
	    }
		else{

			$coinbase_det 	= $this->Common_Model->getTableData(WD, array('walletId' => '1'))->row();

			$bitcoin_username 		= insep_decode($coinbase_det->username);
			$bitcoin_password 		= insep_decode($coinbase_det->password);
			$bitcoin_ip 	        = insep_decode($coinbase_det->ipaddress);
			$bitcoin_portnumber     = insep_decode($coinbase_det->portnumber);

			$email_id  = insep_decode(getuserdetails('first_field',user_id()))."".getuserdetails('second_field',user_id());

			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ip:$bitcoin_portnumber/");
			
			/*echo "<pre>";
			print_r($bitcoin->getinfo());die;*/

			echo  $bitcoin->getaccountaddress($email_id);

		/*	echo "<br>";

			echo "<pre>";
			print_r($bitcoin->getinfo());die;*/

			$Udata['BTC_address'] = $bitcoin->getaccountaddress($email_id);
			
			$updated = $this->Common_Model->updateTableData(USERS, array('user_id' => user_id()), $Udata);
			// echo $this->db->last_query();die;

			if($updated) {
				$rootUrl 		= "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=$checkAddress_btc&choe=UTF-8&chld=L";
				$checkAddress 	= $checkAddress_btc;
				return $bth_data = array('checkAddress' => $checkAddress, 'rootUrl' => $rootUrl);
			}
	}
}


   function portfolio(){
   	
		$this->is_login();
		$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>21))->row();

		$data['user_email']	 = getuseremail(user_id());

		$data['user_balance'] = $this->Common_Model->getTableData(BALANCE,array('user_id'=>user_id()))->row();

	    $data['token_symbol'] = get_data(TC,array('id'=>1))->row()->token_symbol;

	    $user_id = user_id();

	    $invest_token = $this->db->query("SELECT SUM( invest_amt ) AS final_amount,count( invest_id ) AS investors from ".INVEST." where user_id=".$user_id)->row();

	    $data['investors'] = $invest_token->investors;

	    if($invest_token->final_amount!=""){
	     $data['final_amount'] = $invest_token->final_amount;
	    }else{
	     $data['final_amount'] = 0;
	    }

		$this->load->view('front/portfolio',$data);
	}


	function user_support(){

		/*echo "<pre>";
		print_r($_POST);die;*/
		
		$f_name = $this->input->post("f_name");
		$f_rating = $this->input->post("f_rating");
		$f_address_details = $this->input->post("f_address_details");
		$f_description = $this->input->post("f_description");		
		$f_status = $this->input->post("f_status");
		
		$f_status = "1";

		$idata['name']            =  $f_name;
		$idata['rating']          =  $f_rating;
		$idata['address_details'] =  $f_address_details;
		$idata['description']     =  $f_description;
		$idata['status']          =  $f_status;

		$f_img = $_FILES['f_image']['name'];

		if(isset($f_img) && $f_img!="" ){

			$encripted_pic_name       = time().$f_img;

			$upload_config = array(
				'upload_path' 	=> 'uploads/testimonials/', 
				'allowed_types' => 'jpg|jpeg|png', 						
				'overwrite'     => true,
				'maintain_ratio' => true,
				'file_name'     => $encripted_pic_name
			);

    		$this->load->library('upload', $upload_config);
			$this->upload->initialize($upload_config);
			if(!$this->upload->do_upload('f_image')) {
				echo "invalid";
				$uploadErrors = $this->upload->display_errors();
				/*echo "<pre>";
				print_r($uploadErrors);die;*/
			}
			else  {
				$uploadData_up 	= $this->upload->data();
				$big_image 		= $uploadData_up['file_name'];
				$idata['image'] = $big_image;				
			}
		}
		
		$result = $this->Common_Model->insertTableData(TESTIMONIAL,$idata);
		// $result = "";
		if($result){
			echo "valid";
		}else{
			echo "invalid";
		}
	}


	function fetchuserbalancebyId($id,$currency)
{ 
	$this->db->where('user_id',$id);  
	$query=$this->db->get(BALANCE); 
	if($query->num_rows() >= 1)
	{     	
		$row = $query->row();
		if($currency=="BTC")
		{
			$value = $row->BTC; 
		}		
		else if($currency=="ETH")
		{
			$value = $row->ETH;
		}		
		return $value;
	}   
	else
	{      
		return false;		
	}
}


function checkdepositalreadypending1($user_id,$txid,$btcaddress,$type)
{
	
	$this->db->where('user_id',$user_id); 	
	$this->db->where('transaction_id',$txid);
	$this->db->where('depositaddress',$btcaddress);  
	$this->db->where('type',$type);  
	$query = $this->db->get(TRANSACTION);
	
	if($query->num_rows() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function referral(){
	$this->is_login();
	$data['meta_content'] = $this->Common_Model->getTableData(MCONTENT,array('id'=>12))->row();		
	$user_data = get_data(USERS,array('user_id'=>user_id()))->row();
	$user_code=$user_data->user_code;

	$data['comm_history'] = $this->Common_Model->getTableData(COMM_HISTORY,array('user_id'=>user_id()));



	$data['url']=base_url()."register/".$user_code;

		
	$data['main_js']	 = "account";


	$this->load->view('front/referral',$data);	
}

}
