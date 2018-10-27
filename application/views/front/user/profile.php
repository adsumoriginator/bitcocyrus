<?php $this->load->view('front/basic/header_inner.php');?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lightbox.min.css">

<section class="main_innerpage">
<div class="container-fluid">
<div class="pro_section">
<div class="pro_tit">
<h3> PROFILE

</div>

<div class="kyc_bx">
<div class="row">
<div class="col-md-12">
<div class="deposit_coin bg_sec mb-4 note_top_profile">
<div class="row">
<div class="col-lg-6">
<?php
if($user_data->kyc_status!="Verified"){
?>

<h3>KYC Verification Process</h3>
<ul>
<li>1. Fill in all your KYC details and bank account information.</li>
<li>2. Review and Submit the KYC application.</li>
</ul>

<?php
}
?>
</div>

<div class="col-lg-6">

<?php
 if($user_data->kyc_status!="Verified"){
?>

<div class="clearfix"></div>

<h3>NOTE: </h3>
<ul>
<li> Your KYC Application will be verified within 48 hours after submission.</li>
</ul>

</div>

<?php

}else{
  ?>
  <h3 style="float: right;">KYC STATUS: <?php echo $user_data->kyc_status ?></h3>

  <?php

}
?>
</div>
</div>
</div>
</div>
</div>

<div class="row" >
	<div class="col-lg-8">
		<div class="deposit_coin bg_sec">
			<h2 class="title_inner mb-5">My Profile</h2>

			<div class="alert alert-success profile" style="display:none">
			   <button class="close" type="button" data-dismiss="alert">×</button>
				<div class="prosuccess"></div>
			</div>
			<div class="profile_main form_main">

			<form id="profile_form" action="" method="post">

			  <div class="row" >
				<div class="col-lg-6">
				   <div class="form-group">
					<label for="">Bitcocyrus ID</label>
					<input type="text" class="form-control" value="<?php echo $user_data->user_code ?>" readonly>
				  </div>
				  </div>
				  <div class="col-lg-6">
				   <div class="form-group">
					<label for="">Username</label>
					<input type="text" class="form-control" value="<?php echo $user_data->username ?>" readonly>
				  </div>
				  </div>
			  
				<div class="col-lg-6">
				  <div class="form-group">
					<label for="">Referal Link</label>
					<div class="input-group cm_rinpgrp1">
						<p  style="display:none" id="refer"><?php echo base_url() ?>home/register/<?php echo $user_data->user_code?></p>
						<input class="form-control" type="text" value="<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>" readonly>
						<span class="input-group-addon">
							<button onclick="copyToClipboard('#refer')" type="button" class="btn btn-primary rounded-0"><i class="fa fa-copy"></i></button>
						</span  > 
					</div>
				  </div>
				  </div>
				  <div class="col-lg-6">
				    <div class="form-group">
					   <label for="">Social Link</label>
						<div class="social1">
							<ul class="list-inline mb-0 mt-1">
							  <li class="list-inline-item"><a class="facebook-share" data-js="facebook-share"><i class="fa fa-facebook"></i> </a></li>
							  <li class="list-inline-item" class="twitter-share" data-js="twitter-share"><a><i class="fa fa-twitter"></i> </a></li>
							  <li class="list-inline-item" class="telegram-share" data-js="telegram-share"><a><i class="fa fa-telegram"></i> </a></li>
							  <li class="list-inline-item"><a target="_blank" href="https://plus.google.com/share?url=<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>"><i class="fa fa-google-plus"></i> </a></li>
							  <li class="list-inline-item"><a onclick="link()"><i class="fa fa-linkedin"></i> </a></li>
							</ul>
						  </div>
					</div>
				  </div>
			  
			<div class="col-lg-6">
			  <div class="form-group">
				<label for="">First Name</label>
				<input type="text" class="form-control"  value="<?php echo $user_data->firstname ?>"  placeholder="Enter First Name" name="firstname">
			  </div>
			  </div>
			  <div class="col-lg-6">
			   <div class="form-group">
				<label for="">Last Name</label>
				<input type="text" class="form-control"  placeholder="Enter Last Name" value="<?php echo $user_data->lastname ?>" name="lastname" >
			  </div>
			  </div>
				  
			   <div class="col-lg-6">
			   <div class="form-group">
				<label for="">Emaill</label>
				<input type="text" class="form-control"  placeholder="Enter Email" value="<?php echo get_user_email($user_data->user_id) ?>" readonly>
				</div>
			   </div>				
				   
			   <div class="col-lg-6">
			    <div class="form-group">
				<label for="">Phone number</label>
				<input type="text" class="form-control"  placeholder="Enter Phone number" value="<?php echo $user_data->phone_no ?>" readonly>
				</div>
			   </div>
			   
			   <?php
				if($user_data->dob=="0000-00-00 00:00:00"){
				  $dob="";
				}else{
				  $dob=$user_data->dob;
				}
				?>
				   
			   <div class="col-lg-6">
			    <div class="form-group">
				<label for="">Date of Birth</label>
				<input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy" value="<?php echo $dob ?>" >
				</div>
			   </div>
			   
			   <div class="col-lg-6">
			    <div class="form-group">
				<label for="">Street Address</label>
				<input type="text" class="form-control"  placeholder="Enter Street Address"  name="address" value="<?php echo $user_data->userAddress ?>">
				</div>
			   </div>
			   
			   <div class="col-lg-6">
				<div class="form-group">
				<label for="">City</label>
				 <input type="text" class="form-control"  placeholder="Enter City"  name="city" value="<?php echo $user_data->city ?>">
				</div>
			   </div>
			   
			   <div class="col-lg-6">
			    <div class="form-group">
				<label for="">State</label>
				  <input type="text" class="form-control"  placeholder="Enter State"  name="state" value="<?php echo $user_data->state ?>">
				</div>
			   </div>
			   
			   <div class="col-lg-6">
			    <div class="form-group">
				<label for="">Country</label>
				  <select class="form-control" name="country">

				  <option value="">Select country</option>
				  <?php
					foreach($country->result() as $crow){ 
				  ?>

					 <option <?php if($crow->country_name==$user_data->country){?>selected="selected" <?php }?> value="<?php echo $crow->country_name ?>"><?php echo $crow->country_name ?></option>

					 <?php
				   }
					 ?>
				</select>
				</div>
			   </div>
			   
				<div class="col-lg-6">
				  <div class="form-group">
					<label for="">Postal Code</label>
					<input type="text" class="form-control"  placeholder="Enter Postal Code"  name="postal_code" value="<?php echo $user_data->post_code ?>">
				  </div>
				</div>
				
			  </div>
			  
			  <button class="pro_btn btn btn-primary btn_buy mx-auto mt-5 d-table" name="update" value="update" id="profile_button">SAVE</button>
			  </form>
			</div>

		</div>
	</div>
	
	<div id="address_confirm" class="modal fade copy_addr" role="dialog">
	  <div class="modal-dialog"> 
		
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Link copied</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>
		</div>
	  </div>
	</div>

	<div class="col-lg-4">
		<div class="deposit_coin bg_sec">
			<h2 class="title_inner mb-5">KYC DOCUMENTS <a href="#" class="hlpLink" data-toggle="modal" data-target="#myModal" style="color:#48c0ef; text-transform: none;">(?) info </a></h2>

			<!-- Modal -->
			<div class="modal fade verify_form	" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">KYC Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="verification_box">
						<h4>What is an identity (ID) verification photo? </h4>
						<p>An identity (ID) verification photo is the most recent photo taken of the Bitcocyrus account holder, along with a hand-written note. Below are guidelines showing how the note must be held in order to get a clear enough image of both the account holder and the hand written note, allowing us to reliably confirm the identity of the account holder. </p>
						<p>The handwritten paper should read 'BITCOCYRUS' next to your face and should include the current date using the format shown below (dd mon yyyy).</p>
					</div>
					<div class="verification_box">
						<h4>Why do we need this?</h4>
						<p>This lets us know that the image is current, and it makes it difficult for someone to fake your identity</p>
						<p>Note: Only our compliance staff who are trained to handle identity verifications will see your image once you submit them. They are then encrypted and stored offline.</p>
					</div>
					<div class="verify_1">
					<img src="assets/frontend/images/verify1.png" class="img-fluid">
					</div>
				<div class="verify_1">
				<img src="assets/frontend/images/2.jpg" class="img-fluid">
				</div>
					
					<div class="verification_box">
						<h4>You and the hand-written note should both be clearly visible. </h4>
						<p>Both the face and note must be perfectly readable and in sharp focus. Any portion of the note covered by your fingers, hair, pet, shadow, sleeve, jewelry, etc. will be promptly rejected, slowing down your ability to complete your profile.</p>
					</div>
					<div class="verify_1">
					<img src="assets/frontend/images/verify2.png" class="img-fluid">
					</div>
					<div class="verify_1">
					<img src="assets/frontend/images/verify3.png" class="img-fluid">
					</div>
					<!--<div class="verify_1">
					<img src="assets/frontend/images/verify4.png" class="img-fluid">
					</div> -->
					<div class="verify_1">
					<img src="assets/frontend/images/verify5.png" class="img-fluid">
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<div class="profile_main form_main">
			<?php
			$form_array=array('id'=>"kyc_form");
			echo form_open_multipart("user/upload_kyc",$form_array);
			?>

			<?php
			 $success=$this->session->flashdata("success"); 
			 if($success){ ?>

				  <div class="alert alert-success" >
				   <button class="close" type="button" data-dismiss="alert">×</button>
					<?php echo $success ?>
				</div>
				<?php
			  }
			  ?>


			  <?php
			 $error=$this->session->flashdata("error");
			 if($error){ ?>

				  <div class="alert alert-denger" >
				   <button class="close" type="button" data-dismiss="alert">×</button>
					 <?php echo $error ?>
				</div>
				<?php
			  }
			  ?>

			  <div class="form-group">
				<label for="">PASSPORT(FRONT)</label>
				  <?php
				 if($verification->proof1_status==0 || $verification->proof1_status==3 ){ ?>

			   <input type="file" class="filestyle" data-icon="false" name="passport_front">
				<?php
			  }else{
				?>
					<div class="up_img">
			   
			   <div class="row">
			   
			   <div class="col-lg-3">


				 <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof1 ?>" data-lightbox="example-1">

				<img src="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof1 ?>" >

				</a>
				<?php if($verification->proof1_status!=2 ){?> 
				  <a href="<?php echo base_url() ?>user/delete_proof/<?php echo insep_encode(1) ?>">Delete</a>
				  <?php
				}?>


			</div>
			</div>
			</div>
			<?php
			  }
			  ?>



			  </div>



			  <div class="form-group">
				<label for="">PASSPORT(BACK)</label>
				  <?php
				 if($verification->proof2_status==0 || $verification->proof2_status==3 ){ ?>

			   <input type="file" class="filestyle" data-icon="false" name="passport_back">
				<?php
			  }else{
				?>
				<div class="up_img">
			   
			   <div class="row">
			   
			   <div class="col-lg-3">






			  <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof2 ?>" data-lightbox="example-1">

				<img src="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof2 ?>" >

				</a>
				<?php if($verification->proof2_status!=2 ){?> 
				  <a href="<?php echo base_url() ?>user/delete_proof/<?php echo insep_encode(2) ?>">Delete</a>
				  <?php
				}?>
			</div>
			</div>
			</div>
			<?php
			  }
			  ?>

			  </div>


			  



			   <div class="form-group">
				<label for="">Any Identity Card(FRONT) </label>
			  <?php
				 if($verification->proof3_status==0 || $verification->proof3_status==3 ){ ?>

			   <input type="file" class="filestyle" data-icon="false" name="identity_front">
			  
			   <?php
			 }else{
				?>
				<div class="up_img">
			   
			   <div class="row">
			   
			   <div class="col-lg-3">

				  <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof3 ?>" data-lightbox="example-1">

				<img src="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof3 ?>" >

				</a>    <?php if($verification->proof3_status!=2 ){?> 
				  <a href="<?php echo base_url() ?>user/delete_proof/<?php echo insep_encode(3) ?>">Delete</a>
				  <?php
				}?>
			</div>
			</div>
			</div>
			<?php
			  }
			  ?>



			  </div>
			  

			   <div class="form-group">
				<label for="">Any Identity Card(BACK) </label>
			  <?php
				 if($verification->proof4_status==0 || $verification->proof4_status==3 ){ ?>

			   <input type="file" class="filestyle" data-icon="false" name="identity_back">
			  
			   <?php
			 }else{
				?>
				<div class="up_img">
			   
			   <div class="row">
			   
			   <div class="col-lg-3">

				 <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof4 ?>" data-lightbox="example-1">

				<img src="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof4 ?>" >

				</a>
				<?php if($verification->proof4_status!=2 ){?> 
				  <a href="<?php echo base_url() ?>user/delete_proof/<?php echo insep_encode(4) ?>">Delete</a>
				  <?php
				}?>
			</div>
			</div>
			</div>
			<?php
			  }
			  ?>


			  </div>


			  

			  <div class="form-group">
				<label for="">Profile Picture</label>
				  <?php
				 if($verification->proof5_status==0 || $verification->proof5_status==3 ){ ?>

			   <input type="file" class="filestyle" data-icon="false" name="profile">
				<?php
			  }else{
				?>
				<div class="up_img">
			   
			   <div class="row">
			   
			   <div class="col-lg-3">

			   <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof5 ?>" data-lightbox="example-1">

				<img src="<?php echo base_url()?>uploads/kyc/<?php echo $verification->id_proof5 ?>" >

				</a>
				<?php if($verification->proof5_status!=2 ){?>       <a href="<?php echo base_url() ?>user/delete_proof/<?php echo insep_encode(5) ?>">Delete</a>
				  <?php
				}?>
			</div>
			</div>
			</div>
			<?php
			  }
			  ?>

			  </div>

			  
			 
			  
			   
			  
				  <?php
				if($verification->proof1_status==0 || $verification->proof2_status==0  ||  $verification->proof3_status==0 || $verification->proof4_status==0 ||  $verification->proof1_status==3 || $verification->proof2_status==3  ||  $verification->proof3_status==3 || $verification->proof4_status==3 || $verification->proof5_status==0 || $verification->proof5_status==3){ ?>
					<div class="form-group ">
			   <p>
			   <span>Note</span>
			  Required as IT Department norms <br>
			Maximum File Size: 3.5MB
			   </p>
			   </div>



			  <div class="form-group">
			  <button class="ena_btn btn btn-primary btn_buy mx-auto mt-5 d-table" name="kyc_update" value="kyc_update">SAVE</button>
			  </div>

			  <?php
			}
			?>
				
			  </form>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</section>
   <script src="<?php echo base_url(); ?>assets/admin/js/lightbox-plus-jquery.min.js"></script>
<?php $this->load->view('front/basic/footer_inner');?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

<script>
	var range=new Date().getFullYear().toString()-18;
    <!--
    $(function () {
        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:' + range
        });
    });
    //-->
var twitterShare = document.querySelector('[data-js="twitter-share"]');

twitterShare.onclick = function(e) {
  e.preventDefault();
  var twitterWindow = window.open('https://twitter.com/share?url=' + '<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>', 'twitter-popup', 'height=350,width=600');
  if(twitterWindow.focus) { twitterWindow.focus(); }
    return false;
}
  
var telegramShare = document.querySelector('[data-js="telegram-share"]');

telegramShare.onclick = function(e) {
  e.preventDefault();
  var telegramWindow = window.open('https://telegram.me/share/url?url=' + '<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>', 'telegram-popup', 'height=350,width=600');
  if(telegramWindow.focus) { telegramWindow.focus(); }
    return false;
}

var facebookShare = document.querySelector('[data-js="facebook-share"]');

facebookShare.onclick = function(e) {
  e.preventDefault();
  var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + '<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>', 'facebook-popup', 'height=350,width=600');
  if(facebookWindow.focus) { facebookWindow.focus(); }
    return false;
}

function link(){
var url = "<?php echo base_url() ?>home/register/<?php echo $user_data->user_code  ?>";
var title = "Bitcocyrus";
var text = "";
window.open('http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(url), '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');

}
  
function copyToClipboard(element) {

  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();

  $('#address_confirm').modal('toggle');
$('#address_confirm').modal('show');
}

</script>
