<?php
/**
 * BoFaq class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoSupport_ticket extends CI_Controller {
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
		}		$this->load->library('form_validation');
		$this->load->model('BoFaqModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');


		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

		}else{
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}	
	}

	/**
	 * Function use to prepare the get the avilable faq
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function index() {

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		
			$order_by=array('id','desc');
			$data['tickets'] = $this->CommonModel->getTableData('bcc_contactus','',$order_by);
			$this->load->view('admin/support/tickets',$data);
		
	}



		public function support_us() {


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		
		
			$order_by=array('id','desc');
			$data['tickets'] = $this->CommonModel->getTableData('support_ticket','',$order_by);
	;

			$this->load->view('admin/support/support_ticket',$data);
		
	}






	public function replay($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		

		$id=insep_decode($id); 
		$condition=array("id"=>$id);	
		$support=$this->CommonModel->getTableData("bcc_contactus",$condition);
		if($this->input->post('Update')){
			$replay=$this->input->post("replay");
			if($replay!=""){
				$insetdata['message']=$replay;
				$insetdata['support_id']=$id;
				$this->CommonModel->addTableData("replay",$insetdata);
			}
		$support=$support->row();
		$name=$support->name;
		$subject=$support->subject;	
		$site_data=site_settings();
		$sitename=$site_data->site_name;
		$reason=$this->input->post("reason_text");
		$email_data=getEmailTeamplete(6);
		 $subject=$support->subject;
		$template=$email_data->template;
		$data=array(
			"###SUBJECT###"=>$subject,				
			"###REPLAY###"=>$replay,
			"###STATUS###"=>$this->input->post("status"),
			"###NAME###"=>$name,
			"###SUBJECT###"=>$subject,
		
		);

				
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
		 $email=$support->email_id;

		send_mail($email,$subject,$message);
		$updata["status"]=$this->input->post("status");
			$this->CommonModel->updateTableData("bcc_contactus",$updata,$condition);

		$this->session->set_flashdata('success', 'Message updated Successfully');
		redirect('BoSupport_ticket','refresh');	
		}else{
			$data["support"]=$support;
			$condition=array("support_id"=>$id,'type'=>0);
			$order_by=array("id","desc");
			$data["replay"]=$support=$this->CommonModel->getTableData("replay",$condition,$order_by);


			$this->load->view('admin/support/tickets_details',$data);

		}

	}



function deleteall(){


	$this->db->empty_table('subscribers');
	$this->session->set_flashdata('success', ' Subscribers deleted successfully');
	redirect('BoSupport_ticket/subscriber','refresh');		


}


	public function delete_ticket($id="") {


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		

			
		$id=insep_decode($id);
		$this->CommonModel->deleteTableData("support",array('id'=>$id));
		$this->CommonModel->deleteTableData("replay",array('support_id'=>$id));
		$this->session->set_flashdata('success', ' Ticket details Deleted Successfully');
		redirect('BoSupport_ticket','refresh');				
		
	}
	public function subscriber(){





		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->subscriper==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

        if($this->input->post("saveFaqDetails")){
		
;

        $subject=$this->input->post("subject");
        $message=$this->input->post("message");
        $user_list=$this->input->post("subs");
        //$user_list=implode(',',$user_list);
      //  foreach($user_list as $email_id){  

   	
			send_mail( $user_list,$subject,$message);			
			

		//}


				$this->session->set_flashdata("success","Newletter send successfully");
				redirect("BoSupport_ticket/subscriber");

    

        





	}else{

		$order_by=array('id','desc');
		$data["subscribers"]=$support=$this->CommonModel->getTableData("subscribers",'',$order_by);
		$this->load->view('admin/support/subscribers',$data);
	}

	}

	function sendnewsletter($id=""){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->subscriper==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		



		$condition=array('id'=>$id);
		$data["subdata"]=$support=$this->CommonModel->getTableData("subscribers",$condition)->row();


		if($this->input->post("saveFaqDetails")){


				 $subject=$this->input->post("subject");
				 $email=$this->input->post("email");				
				 $message=$this->input->post("message");			
				send_mail($email,$subject,$message);			
				$this->session->set_flashdata("success","Newletter send successfully");
				redirect("BoSupport_ticket/subscriber");

		}


		$this->load->view('admin/support/subreplay',$data);



	}



	public function deleteSubscriber($id=""){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->subscriper==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		


		$id=insep_decode($id);
		$condition=array('id'=>$id);
		$this->CommonModel->deleteTableData("subscribers",$condition);


		$this->session->set_flashdata('success', ' Subscriber Deleted Successfully');
		redirect('BoSupport_ticket/subscriber','refresh');		



	}



	public function subscriber_export(){

		$order_by=array('id','desc');

		$data["subscribers"]=$support=$this->CommonModel->getTableData("subscribers",'',$order_by);
		$this->load->view('admin/support/subscribers_export',$data);


	}


	function support_replay($id=""){


				$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }



		$id=insep_decode($id); 
		$condition=array("id"=>$id);
	
		$support=$this->CommonModel->getTableData("support_ticket",$condition);
		if($this->input->post('Update')){
			$replay=$this->input->post("replay");
			if($replay!=""){
				$insetdata['message']=$replay;
				$insetdata['support_id']=$id;
				$insetdata['type']=1;
				$this->CommonModel->addTableData("replay",$insetdata);
			}
		$support=$support->row();
		$name=$support->name;
		$subject=$support->subject;	
		$site_data=site_settings();
		$sitename=$site_data->site_name;
		$site_data=site_settings();
		$sitename=$site_data->site_name;
		$email_data=getEmailTeamplete(12);
		$subject=$email_data->subject."-".$support->category;;
		$template=$email_data->template;
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
		$data["###TICKETID###"]= $support->ticket_id;
		$data["###STATUS###"]= $this->input->post("status");
		$data["###REPLAY###"]= $this->input->post("replay");				
		 $message=strtr($template,$data);
	 	$email=$support->email_id;
		send_mail($email,$subject,$message);
		$updata["status"]=$this->input->post("status");
			$this->CommonModel->updateTableData("support_ticket",$updata,$condition);

			$this->session->set_flashdata('success', 'Message updated Successfully');
				redirect('BoSupport_ticket/support_us','refresh');	


		}else{
			$data["support"]=$support;
			$condition=array("support_id"=>$id,"type"=>1);
			$order_by=array("id","desc");
			$data["replay"]=$support=$this->CommonModel->getTableData("replay",$condition,$order_by);
			
			

			$this->load->view('admin/support/support_details',$data);
		}



	}



	public function add_support_category() {
		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		



				if($this->input->post("saveFaqDetails")){


				$insertdata["category_name"]=$this->input->post("category_name");
				$insertdata["status"]=$this->input->post("status");
				$this->CommonModel->addTableData("support_category",$insertdata);

				$this->session->set_flashdata("success","New support category added successfully");
				redirect("BoSupport_ticket/support_category");



			}else{


			$this->load->view('admin/support/add_support_category');	


			}				
		}


 function support_category(){
 	$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		


 	$data["support_category"]=$this->CommonModel->getTableData("support_category");
	$this->load->view('admin/support/sub_category',$data);	
 }

  public function edit_support_category($id="") {


  	$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		

	  	$id=insep_decode($id);
	  	$condition=array("id"=>$id);
	if($this->input->post("saveFaqDetails")){
			$insertdata["category_name"]=$this->input->post("category_name");
			$insertdata["status"]=$this->input->post("status");
			$this->CommonModel->updateTableData("support_category",$insertdata,$condition);
			$this->session->set_flashdata("success","support category updated successfully");
			redirect("BoSupport_ticket/support_category");
	}else{

		$data["subcategory"]=$this->CommonModel->getTableData("support_category",$condition)->row();	
		$this->load->view('admin/support/edit_support_category',$data);	
	}				
 }

  public function delete_category($id=""){


  	$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
          if($admindetals->support==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
		
  	
   	$id=insep_decode($id);
  	$condition=array("id"=>$id);
  	$this->CommonModel->deleteTableData("support_category",$condition);
  	$this->db->last_query();
  	$this->session->set_flashdata("success","New support category deleted successfully");
	redirect("BoSupport_ticket/support_category");

  }		
	


}


?>