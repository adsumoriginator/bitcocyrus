<?php
/**
 * BoForgetAuthenticationModel class
 * @category model
 * @package Coin control
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoForgetAuthenticationModel extends CI_Model {
	/**
	 * To prepare for the reset admin password status changes
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function updateForgetPasswordStatus($adminID,$updateData) {
        $this->db->where('id',$adminID);
        $this->db->update('admin',$updateData);
        return true;
    }

	/**
	 * To get the particular faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function getForgetPasswordCodeDetails($forgetPasswordCode,$forgetPasswordStatus) {
		$this->db->where('forgetPasswordCode',$forgetPasswordCode);
		$query_admin 	= $this->db->get('admin');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}		
	}    
}
?>