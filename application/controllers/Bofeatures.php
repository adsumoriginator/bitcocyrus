<?php
/**
 * Bofeatures class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class Bofeatures extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Osiz Technologies Pvt Ltd
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable Property  of the site
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Osiz Technologies Pvt Ltd
	 */	

	public function index() {
		

		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

			$data['get_testiminial'] 	=  $this->CommonModel->getTableData(FEATURE,'',array('featureid','desc'),'','','','','')->result();			

			$data['getAdminUserInfo'] 	= $this->CommonModel->getLoggedInAdminDetails();
			$siteDetails 				= $this->CommonModel->getSiteConfigInfo();
			

				$data['siteName'] 			= $siteDetails['0']->site_name;
				$data['title'] 				= "Features | ".$siteDetails['0']->site_name;
				$data['keywords']			= "Features | ".$siteDetails['0']->site_name;
				$data['description'] 		= "Features | ".$siteDetails['0']->site_name;

			$this->load->view('admin/Bofeatures/Bofeatures',$data);
		}
		else {			
		
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}


	/**
	 * Function is used for get the particular Property  details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Osiz Technologies Pvt Ltd
	 */

	public function editfeatures($featureid) {

		

		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {				

			$prop_id =  insep_decode($featureid);

			if(is_numeric($prop_id)){		

			$cond = array('featureid'=>insep_decode($featureid));

			$getParticularproperty 		= $this->CommonModel->getTableData(FEATURE,$cond)->row();


			/*echo "<pre>";
			print_r($getParticularproperty);die;*/
			
			if(isset($getParticularproperty) && !empty($getParticularproperty)) {				
			
				$data['featureid']	=  $getParticularproperty->featureid;
				$data['name']			=  $getParticularproperty->name;
				$data['test_description']	=  $getParticularproperty->description;
				$data['test_image']		    =  $getParticularproperty->image;				
				$data['status']		    =  $getParticularproperty->status;
				

				$data['getAdminUserInfo'] 	= $this->CommonModel->getLoggedInAdminDetails();
			    $siteDetails 				= $this->CommonModel->getSiteConfigInfo();

				$data['siteName'] 			= $siteDetails['0']->site_name;
				$data['title'] 				= "Edit Features | ".$siteDetails['0']->site_name;
				$data['keywords']			= "Edit Features | ".$siteDetails['0']->site_name;
				$data['description'] 		= "Edit Features | ".$siteDetails['0']->site_name;
			
				$this->load->view('admin/Bofeatures/editfeature',$data);	
			}
			else {
				//echo "sds";die;
				redirect('My404',"refresh");
			}	
		}
			else {
				//echo "sds";die;
				redirect('My404',"refresh");
			}			
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}

	/**
	 * Function is used for to prepare update the Property  details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharmila
	 */

	public function updatefeaturepage() {

		

		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('updatecmspage')) {
				//echo "<pre>"; print_r($_POST); die;
				    $featureid 	= $this->input->post('featureid');

				    $cond = array('featureid'=>$featureid);				    
					
					$udata['name']			    =  $this->input->post("name");
					$udata['description']	=  $this->input->post("test_description");
							
					$udata['status']		    =  $this->input->post("status");	

					
					if(isset($_FILES['features_image']['name']) && $_FILES['features_image']['name']!="" ){
					
					$fileNameParts = explode(".", $_FILES['features_image']['name']);
		            
		            $fileExtension = end($fileNameParts);
		            
			        $fileExtension = strtolower($fileExtension); 

			        $date = time();
					
					$encripted_pic_name1       = 'features'.$date."." . $fileExtension;  
			 
					$upload_config = array(
						'upload_path' 	=> 'uploads/features/', 
						'allowed_types' => 'jpg|jpeg|png', 						
						'overwrite'     => true,
						'maintain_ratio' => true,
						'file_name'     => $encripted_pic_name1
					);

		    		$this->load->library('upload', $upload_config);
					$this->upload->initialize($upload_config);
					if(!$this->upload->do_upload('features_image')){
						$uploadErrors = $this->upload->display_errors();
						$this->session->set_flashdata('error',$uploadErrors);
						redirect('Bofeatures','refresh');
					}
					else{
						$uploadData_up 	= $this->upload->data();
						$big_image 		= $uploadData_up['file_name'];
						$features_image 		= $big_image;  
						$old_pic = $this->input->post('old_features_image');  
				        $old_img = unlink("uploads/features/".$old_pic); 	
					}
				}
				else {
					$features_image 			= $this->input->post('old_features_image');
				}

				$udata['image'] = $features_image;

				$result = $this->CommonModel->updateTableData(FEATURE,$udata,array('featureid'=>$featureid));				

				if(!$result) {
					$this->session->set_flashdata('success', ' Features details has been updated');			
					redirect('Bofeatures','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Occurred while update Features details ');
					redirect('Bofeatures','refresh');
				}				
			}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}	


	


	

    public function deletefeatures($featureid) {    	
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {

				$featureid = insep_decode($featureid);

				$wh = array('featureid'=>$featureid);

				$result = $this->CommonModel->deleteTableData(FEATURE,$wh);				

				if($result) {

					$succ = "Testimonial Details has been Deleted successfully";
					$this->session->set_flashdata('success', $succ);			
					admin_redirect('Bofeatures');
				}  
				else {
					$err = " Error Occurred While Delete testimonial Please try again later";

					$this->session->set_flashdata('error', $err);
					admin_redirect('Bofeatures');
				}	
		}
		else{
			admin_redirect('Authentication');
		}		
	}	





}

/**
 * Filename: Bofeatures.php
 * Location: /application/controllers/Bofeatures.php
 */
?>