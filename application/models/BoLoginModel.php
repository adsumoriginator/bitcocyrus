<?php
/**
 * BoLoginModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoLoginModel extends CI_Model {
	/**
	 * Prepare to login
	 * @return error or success response
	 * @author Sharavana Kumar
	 */
	function logincheck() {	
		$userName 	= $this->input->post('txtusername');
      	$password 	= md5($this->input->post('txtpassword'));
      	$pattern 	= $this->CommonModel->customEncode($this->input->post('patterncode'));
		
		$this->db->where('admin_name',$userName);
        $this->db->where('bcc_password',$password);
        $this->db->where('bcc_pattern_key',$pattern);
        $this->db->where('status',1);        
        $query = $this->db->get('bcc_admin'); 	
		if($query->num_rows() == 1) {
        	$fetchData 		= $query->row();
			$loginUserName	= $fetchData->admin_name;
			$loginUserId	= $fetchData->id;
			$this->session->set_userdata('loginJTEAdminUserName',$loginUserName);
			$this->session->set_userdata('loggedJTEAdminUserID',$loginUserId);
            return true;
        }
		return false;
	}
	/**
	 * function is use to get the attempts count
	 * @return error or success response
	 * @author Sharavana Kumar
	 */
	function getAttemptsCount($ip) {
		$this->db->where('ip_address',$ip);
        $query = $this->db->get('bcc_attempts');
		if($query->num_rows() >= 1) {
			$fetchData 	= $query->row();
			return $fetchData->attempt;
		}
		else {
			return "noData";
		}		
	}
	function insertAttempt($data) {
		$this->db->insert('bcc_attempts',$data);
		return true;		
	}

	function adminHistory($data) {
		$this->db->insert('bcc_admin_history',$data);
		return true;		
	}

	function adminBlocking($data) {
		$this->db->insert('bcc_blockdetails',$data);
		return true;		
	}	

	/**
	 * To prepare for update faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function updateAttempts($data,$ip) {
		$this->db->where('ip_address',$ip);
		$this->db->where('user_id',"admin");  	
		$this->db->update('bcc_attempts',$data);			
        return true;
	}
	

	/**
	 * To get the particular faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function getParticularIP($ip_address) {
		$this->db->where('ip_address',$ip_address);
		$query_admin 	= $this->db->get('bcc_blockdetails');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return 1;
		}
		else {
			return 0;		
		}		
	}


		function logincheck_wallet() {	

     /*   echo "<pre>";
		print_r($_POST);die;*/

		$userName 	    =  $this->input->post('username');
      	$password 	    =  insep_encode($this->input->post('user_pwd'));
      	$patterncode 	=  insep_encode($this->input->post('pattern_code'));
		
		// $this->db->where('name',$userName);
		$this->db->where('email_id',$userName);
        $this->db->where('password',$password);
        $this->db->where('info',$patterncode);        
        
        $query = $this->db->get(AWALLET);

       // echo $this->db->last_query();die;
		
		if($query->num_rows() == 1) {
        	$fetchData 		= $query->row();
			$loginUserName	= $fetchData->name;
			$loginUserId	= $fetchData->admin_id;											

			$this->session->set_userdata('loginwalletname',$loginUserName);
			$this->session->set_userdata('loggedwalletuserid',$loginUserId);			
            return true;
        }
		return false;
	}

}
?>