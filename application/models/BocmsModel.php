<?php
/**
 * BocmsModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BocmsModel extends CI_Model {
	/**
	 * To get all avilable cms page
	 * @return response set of record or false
	 * @author Osiz Technologies Pvt Ltd
	 */
	function getcmsPages() {
		$query = $this->db->get('bcc_cms');
		if($query->num_rows() >= 0){
			return $query->result();	
		}
		return false;
	}

	/**
	 * To get the particular cms page details
	 * @return response success or fail
	 * @author Osiz Technologies Pvt Ltd
	 */
	function getParticularcms($cmsID) {
		$this->db->where('md5(id)',$cmsID);
		$query_admin 	= $this->db->get('bcc_cms');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}		
	}

	/**
	 * To update the cms page
	 * @return response set of record or false
	 * @author Osiz Technologies Pvt Ltd
	 */	
	function updatecmspage($cmsID) {
		// current date
		$date = date('Y-m-d_H:i:s');		
		$data = array(		
			'title'					=> $this->input->post('cmsTitle'),
			'content_description'	=> $this->input->post('cmsDescription'),
			'created_date' 			=> $date,
			//'status'				=> $this->input->post('status')			
		);
		$this->db->where('id',$cmsID);  	
		$this->db->update('bcc_cms',$data);			
        return true;		
	}		
}
/**
 * Filename: BocmsModel.php
 * Location: /application/models/BocmsModel.php
 */
?>