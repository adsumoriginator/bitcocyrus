<?php
/**
 * BoAuthentication class
 * @category Bitcocyrus
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class YfQa6hmtE8a3G2Z6Ssuf extends CI_Controller {
	public function __construct() {
		parent::__construct();
	
		$this->load->library('form_validation');
		$this->load->model('BoLoginModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
		$ip 				=	$_SERVER['REMOTE_ADDR'];
		$getParticularIP 	= $this->BoLoginModel->getParticularIP($ip);
		if($getParticularIP == 1) {
			//echo '<div style="text-align: center; margin-top:50px; font-family: times new roman; font-size: 25px;  color: red;">Your IP Address Block. Contact Administrator !!! </div>'; die;
		}
	}

	public function index() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			redirect('BoDashboard','refresh');	
		}
		else {
			if(isset($_SESSION["siteLogout"])) {
				unset($_SESSION['siteLogout']);
				$data['withdrawalMessage'] = "";
				$data['withdrawalStatus'] 	= "";				
				$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
				$data['siteName'] 		= $siteDetails['0']->site_name;
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
				$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
				$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
				$data['description'] 	= "Login | ".$siteDetails['0']->site_name;			
				$data['successMsg'] 	= 'You are now successfully Log out';
				$this->load->view('admin/boLogin/boLogin',$data);
			}
			else if(isset($_SESSION["changePasswordLogout"])) {
				unset($_SESSION['changePasswordLogout']);
				$data['withdrawalMessage'] = "";
				$data['withdrawalStatus'] 	= "";				
				$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
				$data['siteName'] 		= $siteDetails['0']->site_name;
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
				$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
				$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
				$data['description'] 	= "Login | ".$siteDetails['0']->site_name;			
				$data['successMsg'] 	= 'Your password is updated successfully please log in again';
				$this->load->view('admin/boLogin/boLogin',$data);
			}			
			else {			
				$data['withdrawalMessage'] = "";
				$data['withdrawalStatus'] 	= "";
				$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
				$data['siteName'] 		= $siteDetails['0']->site_name;
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
				$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
				$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
				$data['description'] 	= "Login | ".$siteDetails['0']->site_name;

				if(($this->session->flashdata("success"))){
							$data['successMsg'] 	= 'Your password is updated successfully please log in again';
				}

				$this->load->view('admin/boLogin/boLogin',$data);
			}
		}
	}
	function logincheck() {
		if($this->input->post('signin')) {
			$siteDetails 	= $this->CommonModel->getSiteConfigInfo();
			$result 	= $this->BoLoginModel->logincheck();	
			if($result) {
				$dateofreg 		= date('Y-m-d H:i:s');
				$IPADDRESS      = $_SERVER['REMOTE_ADDR'];
				$browser_name 	= $_SERVER['HTTP_USER_AGENT'];
				$userName 		= $this->input->post('txtusername');
		      	$password 		= $this->input->post('txtpassword');
				
				$adminHistoryDatas=array(        
                	'ipAddress' 	=> $IPADDRESS,                                
                    'datetime'    	=> $dateofreg,                                
                    'userId'        => 'admin',
                    'Browser'       => $browser_name,
                    'Action'       	=> 'Logged in',
                    'status'        =>  "Active"
                );					
				$insertAdminHistory = $this->BoLoginModel->adminHistory($adminHistoryDatas);						
				redirect('BoDashboard','refresh');
			}
	    	else {
	    		$ipA 		= $_SERVER['REMOTE_ADDR'];
				$attempt = $this->BoLoginModel->getAttemptsCount($ipA);
				if($attempt == "noData") {
					$attemptCount 	= 1;
					$dateofreg 		= date('Y-m-d H:i:s');
					$IPADDRESS      = $_SERVER['REMOTE_ADDR'];
					$browser_name 	= $_SERVER['HTTP_USER_AGENT'];
					$userName 		= $this->input->post('txtusername');
			      	$password 		= $this->input->post('txtpassword');

			      	$insertData 	= array('attempt'=>$attemptCount,'login_date'=>$dateofreg,'user_id'=>'admin','ip_address'=>$IPADDRESS);
					$insertAttempt 	= $this->BoLoginModel->insertAttempt($insertData);
					
					$adminHistoryDatas=array(        
	                	'ipAddress' 	=> $IPADDRESS,                                
	                    'datetime'    	=> $dateofreg,                                
	                    'userId'        => 'admin',
	                    'Browser'       => $browser_name,
	                    'Action'       	=> 'Try Logged in on username '.$userName.' and password '.$password,
	                    'status'        =>  "Active"
	                );					
					$insertAdminHistory = $this->BoLoginModel->adminHistory($adminHistoryDatas);	
					$data['siteName'] 		= $siteDetails['0']->site_name;
					$data['copyRight'] 		= date('Y');
					$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
					$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
					$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
					$data['description'] 	= "Login | ".$siteDetails['0']->site_name;						
					$data['invalid_login'] = 'Invalid username or password or pattern code';
					$this->load->view('admin/boLogin/boLogin',$data);						
				}
				else if($attempt == 1) {
						$attemptCount 	= 2;
						$dateofreg 		= date('Y-m-d H:i:s');
						$IPADDRESS      = $_SERVER['REMOTE_ADDR'];
						$browser_name 	= $_SERVER['HTTP_USER_AGENT'];
						$userName 		= $this->input->post('txtusername');
				      	$password 		= $this->input->post('txtpassword');							
	                    $updateDataa 	= array('attempt'=>$attemptCount,'login_date'=>$dateofreg,'ip_address'=>$IPADDRESS);
	                    $updateAttempts 	= $this->BoLoginModel->updateAttempts($updateDataa,$IPADDRESS);
						
						$adminHistoryDatass=array(        
		                	'ipAddress' 	=> $IPADDRESS,                                
		                    'datetime'    	=> $dateofreg,                                
		                    'userId'        => 'admin',
		                    'Browser'       => $browser_name,
		                    'Action'       	=> 'Try Logged in on username '.$userName.' and password '.$password,
		                    'status'        =>  "Active"
		                );					
						$insertAdminHistory = $this->BoLoginModel->adminHistory($adminHistoryDatass);		        

						$data['siteName'] 		= $siteDetails['0']->site_name;
						$data['copyRight'] 		= date('Y');
						$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
						$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
						$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
						$data['description'] 	= "Login | ".$siteDetails['0']->site_name;						
						$data['invalid_login'] = 'Invalid username or password or pattern code';
						$this->load->view('admin/boLogin/boLogin',$data);							
				}
				else if($attempt == 2) {
					$dateofreg 			= date('Y-m-d H:i:s');
					$IPADDRESS      	= $_SERVER['REMOTE_ADDR'];
					$browser_name 		= $_SERVER['HTTP_USER_AGENT'];
					$userName 			= $this->input->post('txtusername');
			      	$password 			= $this->input->post('txtpassword');

					$datass = array('ip_address'=>$IPADDRESS, 'status'=>'active','	registered_date'=>$dateofreg);				      	
					$insertAdminBlock 	= $this->BoLoginModel->adminBlocking($datass);

					$adminHistoryDatasss = array(        
	                	'ipAddress' 	=> $IPADDRESS,                                
	                    'datetime'    	=> $dateofreg,                                
	                    'userId'        => 'admin',
	                    'Browser'       => $browser_name,
	                    'Action'       	=> 'Try Logged in on username '.$userName.' and password '.$password.' for third time and your IP is blocked',
	                    'status'        =>  "Active"
	                );
					$insertAdminHistory = $this->BoLoginModel->adminHistory($adminHistoryDatasss);

					$data['siteName'] 		= $siteDetails['0']->site_name;
					$data['copyRight'] 		= date('Y');
					$data['copySiteTitle'] 	= $siteDetails['0']->site_name." Admin";
					$data['title'] 			= "Login | ".$siteDetails['0']->site_name;
					$data['keywords'] 		= "Login | ".$siteDetails['0']->site_name;
					$data['description'] 	= "Login | ".$siteDetails['0']->site_name;						
					$data['invalid_login'] = 'Invalid username or password or pattern code';
					$this->load->view('admin/boLogin/boLogin',$data);							
				}
			}										
		}
	}

	function logout() {
		$dateofreg 		= date('Y-m-d H:i:s');
		$IPADDRESS      = $_SERVER['REMOTE_ADDR'];
		$browser_name 	= $_SERVER['HTTP_USER_AGENT'];
		
		$adminHistoryDatas=array(        
        	'ipAddress' 	=> $IPADDRESS,                                
            'datetime'    	=> $dateofreg,                                
            'userId'        => 'admin',
            'Browser'       => $browser_name,
            'Action'       	=> 'Logged out',
            'status'        =>  "Active"
        );					
		$insertAdminHistory = $this->BoLoginModel->adminHistory($adminHistoryDatas);		
		$this->session->unset_userdata('loginJTEAdminUserName');
		$this->session->unset_userdata('loggedJTEAdminUserID');		
	  $this->session->set_flashdata('success', 'Logged Out successfully.');
		//$_SESSION["siteLogout"] = "logoutSuccess";
		redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
	}	
}
?>