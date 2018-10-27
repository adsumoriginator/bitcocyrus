<?php
/**
 * BoEmailTemplateModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoEmailTemplateModel extends CI_Model {
	/**
	 * To display avilable email templates
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getMailTemplateDetails() {
		$this->db->where('status',1);
		$query = $this->db->get('bcc_email_template');
        if($query->num_rows() >= 1) {                   
			$row = $query->row();			
            return $query->result();			
		} 
		else {     
			return false;		
		}		
	}

	/**
	 * To add new email template
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */	
	function saveTemplate() {
		$data = array(	
			'name' 		=> $this->input->post('mailName'),
			'subject'	=> $this->input->post('mailSubject'),
			'template'	=> $this->input->post('mailTemplate'),
			'status'	=> 1,
		);
		$this->db->insert('bcc_email_template',$data);
		return true;
	}	

	/**
	 * To get the particular email templates
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function getParticularEmailTemplates($mail_id) {
		$this->db->where('md5(id)',$mail_id);
		$query_admin 	= $this->db->get('bcc_email_template');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}		
	}
	
	/**
	 * To update the email templates
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */	
	function saveEmailTemplateDetails($mailID) {
		$status 		= 1;
		// current date
		$date = date('Y-m-d_H:i:s');
		$data = array(		
			'name' 		=> $this->input->post('mailName'),
			'subject'	=> $this->input->post('mailSubject'),
			'template'	=> $this->input->post('mailTemplate'),
			'created'	=> $date,
			//'status'	=> $status,
		);
		$this->db->where('id',$mailID);  	
		$this->db->update('bcc_email_template',$data);			
        return true;		
	}
}

/**
 * Filename: BoEmailTemplateModel.php
 * Location: /application/models/BoEmailTemplateModel.php
 */
?>