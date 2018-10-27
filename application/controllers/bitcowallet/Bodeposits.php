<?php
/**
 * Bodeposits class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class Bodeposits extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable Tokens Management of the site
	 * @access public
	 * @return response success get the set of records or fail
	 */	

	public function index() {
		
		$this->Privilege_model->is_login(12);

		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {

			//$data['getcmsPages'] 	=  $this->Wallet_model->getTableData(CMS)->result();	

			$data['gettokens'] = $this->Wallet_model->getTableData(D, '', '', '', '', '', '', '', array('deposit_id', 'DESC'))->result();		

			$data['getAdminUserInfo'] 	= $this->Wallet_model->getTableData(AD,array('admin_id'=>1))->row();

			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

			    $data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Deposit Management | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Deposit Management | ".$siteDetails['site_name'];
				$data['description'] 	= "Deposit Management | ".$siteDetails['site_name'];

			$this->load->view('admin/bodeposits/bodeposits',$data);
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
	public function editdeposit($deposit_id) {
		$this->Privilege_model->is_login(12);
		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {
			$siteDetails 			= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

			$cond = array('deposit_id '=>insep_decode($deposit_id));

			$gettokens 		= $this->Wallet_model->getTableData(D,$cond)->row();
			
			if(isset($gettokens) && !empty($gettokens)) {

				/* echo "<pre>";
				 print_r($data);die;*/
			
				$data['deposit_id']	        = $gettokens->deposit_id;
				$data['bank_proof']	        = $gettokens->bank_proof;
				$data['currency']	        = $gettokens->currency;
				$data['user_id']			= $gettokens->user_id;
				$data['deposit_amount']		= $gettokens->amount;				
				$data['transaction_id']		= $gettokens->txid;				
				$data['status']			    = $gettokens->status;
				$data['reject_reason']			    = $gettokens->reject_reason;				

				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Edit Deposit page details | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Edit Deposit page details | ".$siteDetails['site_name'];
				$data['description'] 	= "Edit Deposit page details | ".$siteDetails['site_name'];
			
				$this->load->view('admin/bodeposits/editdeposit',$data);	
			}
			else {
				admin_redirect('BoError404');
			}			
		}
		else {
			admin_redirect('Authentication');
		}		
	}

	/**
	 * Function is used for to prepare update the cms page details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharmila
	 */
	public function updatedepositpage() {
		$this->Privilege_model->is_login(12);
		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {
			if($this->input->post('updatecmspage')) {

				//echo "<pre>"; print_r($_POST); die;
				$deposit_id 	= $this->input->post('deposit_id');

				$cond = array('deposit_id '=>$deposit_id);

				$get_deposit 		= $this->Wallet_model->getTableData(D,$cond)->row();
				//echo $this->db->last_query();die;

						
				$status = $this->input->post('status');

				$reject_reason = $this->input->post('reject_reason');

				if($status=="Confirmed"){

					$balance_condi = array('user_id'=>$get_deposit->user_id);	

					
				//	$currency = $get_deposit->currency;

					//$user_balance = get_data(BALANCE,$balance_condi,$currency)->row();
					$user_balance = get_data(BALANCE,$balance_condi,'token_cnt')->row();

				//	echo $this->db->last_query();die;

					$admin_token = getSitesettings('token_fiatvalue');

					$deposit_token = $get_deposit->amount*$admin_token;

					$new_balance = $user_balance->token_cnt+$deposit_token;
					

					$newbalance = array('token_cnt'=>$new_balance);

					$updatebalance = $this->Wallet_model->updateTableData(BALANCE,$balance_condi,$newbalance);

					//echo $this->db->last_query();die;

					
				}elseif($status=="Cancelled"){
					$udata['reject_reason'] = $reject_reason;
				}

				$udata['status'] = $status;

				if($status=="Confirmed"){
					$message = $status;
				}else{
					$message = $status." Due to follwing reason ".$reject_reason;
				}				

				$result = $this->Wallet_model->updateTableData(D,array('deposit_id'=>$deposit_id),$udata);

				$idata['status']= $status;

				$deposit =array('orderId'=>$deposit_id);

				$des = $this->Wallet_model->updateTableData(TRANSACTION,$deposit,$idata);

				$email_template = '10';				 

				$special_vars = array(
				'###LOGOIMG###'    => getSiteLogo(),
				'###SITENAME###'    => getSiteName(),
				'###SITELINK###'    => base_url(),
				'###FBLINK###'       => getSitesettings('facebook_url'),
				'###FBIMG###'        => base_url().'assets/social_images/fb.png',
				'###TWITIMG###'      => base_url().'assets/social_images/twit.png',
				'###GPLUSIMG###'     => base_url().'assets/social_images/gplus.png',
				'###LINKIMG###'      => base_url().'assets/social_images/linkedin.png',
				'###TWITLINK###'     => getSitesettings('twitter_url'),
				'###GPLUSLINK###'    => getSitesettings('google_url'),
				'###LINKEDINLINK###' => getSitesettings('linkedin_url'),
				'###USERNAME###'    => getuserdetails('username',$get_deposit->user_id),
				'###MESSAGE###'     => $message,
				'###AMOUNT###'      => $get_deposit->amount,
				'###CURRENCY###'       => $get_deposit->currency
				);
				

			   $email_send = $this->Email_model->sendMail(getuseremail($get_deposit->user_id), '', '', $email_template, $special_vars);

				//echo $this->db->last_query();die;

				if($result) {
					$this->session->set_flashdata('success', 'Deposit application has been '.$status);			
					admin_redirect('Bodeposits');
				}  
				else {
					$this->session->set_flashdata('error', 'Error Occurred While '.$status.' Deposit please try again later');
					admin_redirect('Bodeposits');
				}				
			}
		}
		else {
			admin_redirect('Authentication');
		}		
	}	

	


	

}

/**
 * Filename: Bodeposits.php
 * Location: /application/controllers/Bodeposits.php
 */
?>