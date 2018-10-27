<?php
/**
 * BoAuthentication class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoCoin_settings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {


		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
		$this->load->library('form_validation');

		//$this->load->model('CommonModel');
		$this->load->model('BoLoginModel');
		$this->load->database();
		$this->load->helper('url');
		$ip 				=	$_SERVER['REMOTE_ADDR'];
		$getParticularIP 	= $this->BoLoginModel->getParticularIP($ip);
		if($getParticularIP == 1) {
		//	echo '<div style="text-align: center; margin-top:50px; font-family: times new roman; font-size: 25px;  color: red;">Your IP Address Block. Contact Administrator !!! </div>'; die;
		}
	}


	function view_coin(){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->currency_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

	



		$data["currency_settings"]=$this->CommonModel->getTableData("currency");
		$this->load->view("admin/coin_settings/coin_settings",$data);
	}
	
	function add_coin() {
		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($admin_id) && !empty($admin_id)) {
			if($this->input->post("add")){
				$coindata['currency_name'] = $this->input->post("currency_name");
				$coindata['currency_symbol'] = $this->input->post("currency_code");
				$coindata['status'] = 1;
				$coindata['min_withdraw_limit'] = $this->input->post("min_withdraw_limit");
				$coindata['max_withdraw_limit'] = $this->input->post("max_withdraw_limit");
				$coindata['withdraw_fees_type'] = "";
				$coindata['withdraw_fees'] = $this->input->post("withdraw_fees");
				$coindata['in_maintenance'] = 1;
				
				if(isset($_FILES['currency_icon']['name']) && $_FILES['currency_icon']['name']!="" ){
					$fileNameParts = explode(".", $_FILES['currency_icon']['name']); 
		            // give extension
		            $fileExtension = end($fileNameParts);
					// convert to lower case
			        $fileExtension = strtolower($fileExtension); 
					
					$encripted_pic_name       = $this->input->post("currency_code").".". $fileExtension;
					$upload_config = array(
						'upload_path' 	=> 'assets/frontend/images/coins_icons/', 
						'allowed_types' => 'jpg|jpeg|png',
						'max_size'      =>  '1024',
						/* 'min_width' 	=> '40',
						'min_height' 	=> '40',*/
						'overwrite'     => true,
						'maintain_ratio' => true,
						'file_name'     => $encripted_pic_name
					);
					$this->load->library('upload', $upload_config);
					$this->upload->initialize($upload_config);
					if(!$this->upload->do_upload('currency_icon')) {
						$uploadErrors = $this->upload->display_errors();
						$this->session->set_flashdata('error',"Sorry your file is too large. Upload valid image size.");
						//redirect('BoSettings','refresh');
					} 
					else  {
						$uploadData_up 	= $this->upload->data();
						$big_image 		= $uploadData_up['file_name'];
						$coin_image 		= $big_image;                	
					}
				}
				$coindata['coin_icon'] =  $coin_image;
				
				$this->CommonModel->addTableData("currency", $coindata);
				$lastid =  $this->db->insert_id();
				
				$admindata['admin_id'] = 1;				
				$admindata['currency_symbol'] = $this->input->post("currency_code");				
				$admindata['address'] = $this->input->post("admin_address");				
				$this->CommonModel->addTableData("admin_address", $admindata);
				
				$pairdata['exchange_name'] = $this->input->post("currency_name");					
				$pairdata['status'] = 1;
				$pairdata['from_symbol_id'] = $lastid;
				if(!empty($_POST['chk_trad_pair'])) {
					foreach($_POST['chk_trad_pair'] as $check) {
						if($check == 1) {
							$pairdata['trade_pair'] = 'BTC/'.$this->input->post("currency_code");
							$pairdata['to_symbol_id'] = 1;
						} else if($check == 2) {
							$pairdata['trade_pair'] = 'ETH/'.$this->input->post("currency_code");
							$pairdata['to_symbol_id'] = 2;
						} else if($check == 3) {
							$pairdata['trade_pair'] = 'BCH/'.$this->input->post("currency_code");
							$pairdata['to_symbol_id'] = 3;
						} else if($check == 4) {
							$pairdata['trade_pair'] = 'USDT/'.$this->input->post("currency_code");
							$pairdata['to_symbol_id'] = 4;
						}
						$this->CommonModel->addTableData("bcc_trade_pairs", $pairdata);
					}
				}				
				
				$this->session->set_flashdata("success","New currency added successfully.");
				redirect("BoCoin_settings/view_coin");
			} else {
				$this->load->view("admin/coin_settings/add_coin",$data);
			}
		}
	}

	function edit_coin($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->currency_details==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$coin_id=insep_decode($id);
		$where=array("id"=>$coin_id);
		$data["currency"]=$this->CommonModel->getTableData("currency",$where)->row();


		if($this->input->post("Update")){

			$updateData["min_withdraw_limit"]=$this->input->post("min_withdraw_limit");
			$updateData["withdraw_fees"]=$this->input->post("withdraw_fees");
			$updateData["max_withdraw_limit"]=$this->input->post("max_withdraw_limit");
			$condition=array("id"=>$coin_id);
			$this->CommonModel->updateTableData("currency",$updateData,$condition);
			$this->session->set_flashdata("success","Currency details successfully updated");
			redirect("BoCoin_settings/view_coin");


		}else{

		$this->load->view("admin/coin_settings/edit_coin",$data);

		}


	}


	function trade_pairs(){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$data['trade_pair']=$this->CommonModel->getTableData("trade_pairs");
		$this->load->view("admin/coin_settings/trade_pairs",$data);

	}


	function edit_trade_pair($id=""){

			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		
		$coin_id=insep_decode($id);
		$where=array("id"=>$coin_id);
		$data["trade_pair"]=$this->CommonModel->getTableData("trade_pairs",$where)->row();

		if($this->input->post("Update")){

			$updateData["min_withdraw_limit"]=$this->input->post("min_withdraw_limit");
			$updateData["withdraw_fees"]=$this->input->post("withdraw_fees");
			$updateData["max_withdraw_limit"]=$this->input->post("max_withdraw_limit");

			$updateDatac["buy_rate_value"]=$this->input->post("buy_rate");
			$updateDatac["sell_rate_value"]=$this->input->post("sell_rate");

			$updateDatac["min_trade_amount"]=$this->input->post("minimum_trade");
			//$updateData["max_withdraw_limit"]=$this->input->post("max_withdraw_limit");


			$this->CommonModel->updateTableData("trade_pairs",$updateDatac,$where);

			$condition=array("id"=>$coin_id);

			$this->CommonModel->updateTableData("currency",$updateData,$condition);

			$this->session->set_flashdata("success","Trade pair details successfully updated");

			redirect("BoCoin_settings/trade_pairs");


		}else{

		$this->load->view("admin/coin_settings/edit_trade_pair",$data);

		}



	}



	function fees_list($id) {

			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }



		$id=insep_decode($id);

		$data['trade_fees']=$this->CommonModel->getTableData('trade_fees', array('pair_id' => $id));
	
		$data['id']=$id;

		$where=array("id"=>$id);
		$data["trade_pair"]=$this->CommonModel->getTableData("trade_pairs",$where)->row();


		$this->load->view('admin/coin_settings/fees_list', $data); 
	}

	function edit_trade_fee($id=""){

			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$id=insep_decode($id);
		
		if($this->input->post("Update")){

			$pair_id=$this->input->post('pair_id');		

			$updateData['from_volume']=$this->input->post('from_volume');
			$updateData['to_volume']=$this->input->post('to_volume');
			$updateData['maker']=$this->input->post('maker_fee');
			$updateData['taker']=$this->input->post('taker');
			$condition=array("id"=>$id);
			$this->CommonModel->updateTableData("trade_fees",$updateData,$condition);

			$id=insep_encode($pair_id);




			$this->session->set_flashdata("success","Fees details upadted successfully");

			redirect("BoCoin_settings/fees_list/".$id);


			
		


		}else{

			$fees_det=$this->CommonModel->getTableData('trade_fees', array('id' => $id)) ->row();

			$data['trade_fees']=$fees_det;


					$where=array("id"=>$fees_det->pair_id);
			$data["trade_pair"]=$this->CommonModel->getTableData("trade_pairs",$where)->row();

	


			$this->load->view('admin/coin_settings/edit_fees_list', $data); 

		}


	}	

function add_pair_fees($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }


		$id=insep_decode($id);		
		if($this->input->post("Update")){

			$pair_id=$this->input->post('pair_id');
			$insertData['pair_id']=$this->input->post('pair_id');
			$insertData['from_volume']=$this->input->post('from_volume');
			$insertData['to_volume']=$this->input->post('to_volume');
			$insertData['maker']=$this->input->post('maker_fee');
			$insertData['taker']=$this->input->post('taker');
			$this->CommonModel->addTableData("trade_fees",$insertData,$condition);
			 $id=insep_encode($pair_id);
			
		
			$this->session->set_flashdata("success","Fees detils added successfully");
			redirect("BoCoin_settings/fees_list/".$id);

		}else{

			 $data['pair_id']=$id;

			$where=array("id"=>insep_decode($id));
			$data["trade_pair"]=$this->CommonModel->getTableData("trade_pairs",$where)->row();



			$this->load->view('admin/coin_settings/add_fees_list', $data); 

		}


}

function delete_trade_fee($id=""){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

	$id=insep_decode($id);
	$condition=array('id'=>$id);
	$row=$this->CommonModel->getTableData("trade_fees",$condition)->row();
	$this->CommonModel->deleteTabledata("trade_fees",$condition);
	$id=insep_encode($row->pair_id);
	$this->session->set_flashdata("success","Fees detils deleted successfully");
	redirect("BoCoin_settings/fees_list/".$id);

}


function status_trade_fee($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 
        if($admindetals->trade==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }
	
	$id=insep_decode($id);
	$condition=array('id'=>$id);
	$row=$this->CommonModel->getTableData("trade_fees",$condition)->row();
	if($row->status==1){
		$updateData['status']=0;
	}else{
		$updateData['status']=1;

	}

	$this->CommonModel->updateTableData("trade_fees",$updateData,$condition);	
	$id=insep_encode($row->pair_id);
	$this->session->set_flashdata("success","Fees status updated successfully");
	redirect("BoCoin_settings/fees_list/".$id);


}

	

}