<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
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


	function cms($link="")
	{

		
		$data['cms_cnt'] = $this->CommonModel->getTableData("bcc_cms",array('link'=>$link))->row();

		$this->load->view('front/cms/cms',$data);
	}

	function faq(){	

	   $this->db->order_by('id','desc');
	   $data['faq_cnt'] = $this->CommonModel->getTableData("bcc_faq",array('status'=>1))->result();		   
		$this->load->view('front/cms/faq',$data);
	}

	function cnt_captcha(){
		$size = 100;	
		$img=imagecreatetruecolor(45,37);
		$back = imagecolorallocate($img, 72, 192, 239);
		imagefilledrectangle($img, 0, 0, $size - 1, $size - 1, $back);
		$numeroa = rand(1, 9);		
		$numerob = rand(1, 9);
		$numero = $numeroa + $numerob;
		$captcha_val=array("contact_captcha"=>$numero);
		$this->session->set_userdata($captcha_val);
		
		$display = $numeroa . '+' . $numerob . '=';
		imagecolortransparent($img, $back);
		$white = imagecolorallocate($img, 0, 0, 0); 
		imagestring($img, 10, 8, 3, $display, $white);
 		header ("Content-type: image/png"); imagepng($img);
	}

	function captcha_exist(){

		$captcha = trim($this->input->get_post('captcha'));


		$session_captcha  = $this->session->userdata('contact_captcha');

		if ($session_captcha==$captcha)
		{ 	
			echo 'true';			
		}					
		 else {			 	
		 	echo 'false';			
		}	
	   
	}


	function contact(){		

		$this->form_validation->set_rules('name','Namw', 'required');
		$this->form_validation->set_rules('email','Email', 'required');			
		$this->form_validation->set_rules('subject','Subject', 'required');	
		$this->form_validation->set_rules('message','Message', 'required');	
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
			{
				
				$data['main_js'] = "contact";
		   
				$this->load->view('front/cms/contact',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('email'));

				$username = $this->security->xss_clean($this->input->post('name'));

				$idata['name'] = $this->security->xss_clean($this->input->post('name'));
				$idata['email_id'] = $this->security->xss_clean($this->input->post('email'));
				$idata['subject'] = $this->security->xss_clean($this->input->post('subject'));			
				$idata['message'] = $this->security->xss_clean($this->input->post('message'));
				$idata['created_date'] = date('Y-m-d h:i:s');

				$idata['status'] = 1;
				
				$result = $this->CommonModel->addTableData("bcc_contactus",$idata);

				if($result){

				// $email_template = '6';

			 //    $special_vars = array(
				// '###SITELOGO###' => getSiteLogo(),
				// '###SITENAME###' => getSiteName(),
				// '###SITELINK###' => base_url(),
				// '###FBLINK###'       => getSitesettings('facebook_url'),
				// '###FBIMG###'        => base_url().'assets/social_images/fb.png',
				// '###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				// '###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				// '###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				// '###TWITLINK###'     => getSitesettings('twitter_url'),
				// '###GPLUSLINK###'    => getSitesettings('google_url'),
				// '###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				// '###USERNAME###' => $username
				// );

			 //    $this->Email_model->sendMail($email, '', '', $email_template, $special_vars);
					echo 1;
				
			   }else{
			   	echo 0;
			   }				
		    }
	}




	function support(){		

		//if(!user_id()){

			//redirect();
	//	}

		$this->form_validation->set_rules('name','Namw', 'required');
		$this->form_validation->set_rules('email','Email', 'required');			
		$this->form_validation->set_rules('subject','Subject', 'required');	
		$this->form_validation->set_rules('message','Message', 'required');	
		$this->form_validation->set_message('required',"%s  Required");

		if ($this->form_validation->run() == FALSE)
			{
				
				$data['main_js'] = "contact";
				$condition=array("status"=>1);
				$data["support_category"]=$this->CommonModel->getTableData("support_category",$condition);
				// $email=get_user_email(user_id()); 
				//$data['email_id']=$email;

				//$data['email_id']=$email_id;

				//$userdata=get_user(user_id());
				
				//$data['username']=$userdata->username;

	   
				$this->load->view('front/cms/support',$data);
			}
		else
			{
				$email = $this->security->xss_clean($this->input->post('email'));

				$username = $this->security->xss_clean($this->input->post('name'));

				$idata['name'] = $this->security->xss_clean($this->input->post('name'));
				$idata['email_id'] = $this->security->xss_clean($this->input->post('email'));
				$idata['subject'] = $this->security->xss_clean($this->input->post('subject'));	
			//	$idata['user_id'] = user_id();					
				$idata['message'] = $this->security->xss_clean($this->input->post('message'));
				$idata['created_date'] = date('Y-m-d h:i:s');
				$idata['category'] = $this->security->xss_clean($this->input->post('category'));
				$idata['status'] = 1;
				$idata['ticket_id'] = time();
				$result = $this->CommonModel->addTableData("support_ticket",$idata);
				if($result){

				// $email_template = '6';

			 //    $special_vars = array(
				// '###SITELOGO###' => getSiteLogo(),
				// '###SITENAME###' => getSiteName(),
				// '###SITELINK###' => base_url(),
				// '###FBLINK###'       => getSitesettings('facebook_url'),
				// '###FBIMG###'        => base_url().'assets/social_images/fb.png',
				// '###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				// '###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				// '###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				// '###TWITLINK###'     => getSitesettings('twitter_url'),
				// '###GPLUSLINK###'    => getSitesettings('google_url'),
				// '###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				// '###USERNAME###' => $username
				// );

			 //    $this->Email_model->sendMail($email, '', '', $email_template, $special_vars);
					echo 1;
				
			   }else{
			   	echo 0;
			   }				
		    }
	}


 function support_history(){

 	if(!user_id()){

			redirect();
   }

   $condition=array("user_id"=>user_id());
   $data['ticket_details']=$this->CommonModel->getTableData("support_ticket",$condition);

  $this->load->view('front/cms/ticket_history',$data);






 }

	

	
}
