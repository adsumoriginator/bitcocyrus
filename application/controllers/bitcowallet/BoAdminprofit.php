<?php
/**
 * Bocms class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class BoAdminprofit extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->model('BoSettingsModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable cms pages of the site
	 * @access public
	 * @return response success get the set of records or fail
	 */	

	



	public function index() {

		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)){

			$data['getcmsPages'] 	=  $this->Wallet_model->getTableData(PF,'','','','','','','',array('id','desc'))->result();		

			echo "<pre>";
			print_r($data);die;

			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

		    $data['siteName'] 		= $siteDetails['site_name'];
			$data['copyRight'] 		= date('Y');
			$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
			$data['title'] 			= "Admin Profit | ".$siteDetails['site_name'];
			$data['keywords'] 		= "Admin Profit | ".$siteDetails['site_name'];
			$data['description'] 	= "Admin Profit | ".$siteDetails['site_name'];

			$this->load->view('admin_wallet/bowithdraw/adminprofit',$data);
		}
		else {
			admin_redirect('Authentication');
		}
	}

	/**
	 * Function is used for get the particular cms page details
	 * @access public
	 * @return response success get the set of records or fail
	 */
	
}

?>