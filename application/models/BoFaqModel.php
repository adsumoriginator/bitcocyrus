<?php
/**
 * BoFaqModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoFaqModel extends CI_Model {
	/**
	 * To get all avilable email templates
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getFaq() {
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get('bcc_faq');
		if($query->num_rows() >= 0){
			return $query->result();	
		}
		return false;
	}

	/**
	 * To add new faq
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */	
	function saveFaq() {
		$data = array(		
			'question'			=> $this->input->post('faqQuestion'),
			'description'		=> $this->input->post('faqAnswer'),
			'status'			=> 1,			
			'created_date'		=> date('Y-m-d H:i:s'),
		);
		$this->db->insert('bcc_faq',$data);
		return true;
	}

	/**
	 * To get the particular faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function getParticularFaq($faqID) {
		$this->db->where('md5(id)',$faqID);
		$query_admin 	= $this->db->get('bcc_faq');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}		
	}

	/**
	 * To prepare for update faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function updateFaq($faqID) {
		$data = array(		
			'question'			=> $this->input->post('faqQuestion'),
			'description'		=> $this->input->post('faqAnswer'),
			'status'			=> $this->input->post('status'),
			'created_date'		=> date('Y-m-d H:i:s'),
		);
		$this->db->where('id',$faqID);  	
		$this->db->update('bcc_faq',$data);			
        return true;
	}

	/**
	 * To prepare for delete faq details
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */	
	function deleteFaq($faqID) {
		$this->db->delete('bcc_faq',array('md5(id)' => $faqID));
		return true;
	}		
}

/**
 * Filename: BoFaqModel.php
 * Location: /application/models/BoFaqModel.php
 */
?>