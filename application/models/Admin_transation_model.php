<?php
/**
 * CommonModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Shanmuga  Kumar
 * @link http://osiztechnologies.com/
 */

class Admin_transation_model extends CI_Model {


	function get_deposit($condition){
		if(!empty($condition)){
			$this->db->where($condition);
		}
  	    $this->db->select('tansation.*,userdetails.username');
   	    $this->db->from('tansation');
   	    $this->db->join('userdetails', 'userdetails.user_id = tansation.user_id');
	    $query = $this->db->get();
	    return $query;

	}



}