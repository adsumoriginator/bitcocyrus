<?php
/**
 * BoAuthentication class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author osiztechnologies 
 * @link http://osiztechnologies.com/
 */
class BoSupport_ticket extends CI_Controller {
	public function __construct() {


		echo "dfdfdfdfdf";
		exit;
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');

		//$this->load->model('CommonModel');
		$this->load->model('BoLoginModel');
		$this->load->database();
		$this->load->helper('url');
		$ip 				=	$_SERVER['REMOTE_ADDR'];
		$getParticularIP 	= $this->BoLoginModel->getParticularIP($ip);
		if($getParticularIP == 1) {
			echo '<div style="text-align: center; margin-top:50px; font-family: times new roman; font-size: 25px;  color: red;">Your IP Address Block. Contact Administrator !!! </div>'; die;
		}


		

	}



	function tickets(){


		echo "dfdfdfdf";
			$order_by=array('id',"desc");
			$this->CommonModel->getTableData("support","",$order_by);
			echo $this->db->last_query();
			exit;

		}


}

