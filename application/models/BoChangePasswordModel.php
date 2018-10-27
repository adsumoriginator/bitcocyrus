<?php
/**
 * BoChangePasswordModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoChangePasswordModel extends CI_Model {
	/**
	 * To prepare for the reset admin password
	 * @return response set of record or false
	 * @author Osiz Technologies Pvt Ltd
	 */
	function boChangePassword() {
		$oldpassword  	= md5($this->input->post('password'));
		$newPassword 	= md5($this->input->post('newpassword'));
		$userID 		= $this->input->post('userID');
		
		$this->db->where('id',$userID);
		$this->db->where('bcc_password',$oldpassword);  	
		$query = $this->db->get('bcc_admin');
		if($query->num_rows() == 1) {
			$data = array('bcc_password'=>$newPassword);
			$this->db->where('id',$userID);
			$query=$this->db->update('bcc_admin',$data);
			$_SESSION["loginJTEAdminUserName"] = "" ;
			$_SESSION["loggedJTEAdminUserID"] = "" ;
		  	return true;	
		}
		else {
			return false;
		}
	}




	function boChangePassword_wallet() {
		$oldpassword  	= insep_encode($this->input->post('password'));
		$newPassword 	= insep_encode($this->input->post('newpassword'));
		$userID 		= 1;		
		$this->db->where('admin_id',$userID);
		$this->db->where('password',$oldpassword);  	
		$query = $this->db->get('bcc_admin_wallet');		
		if($query->num_rows() == 1) {
			$data = array('password'=>$newPassword);
			$this->db->where('admin_id',$userID);
			$query=$this->db->update('bcc_admin_wallet',$data);
			
		  	return true;	
		}
		else {
			return false;
		}
	}
}
?>