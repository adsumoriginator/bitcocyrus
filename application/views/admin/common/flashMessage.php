<?php   
    $error=$this->session->flashdata('error');
    if($error) {   
?> 
<div role="alert" class="alert alert-denger alert-dismissible fade in">
	<button aria-label="Close" data-dismiss="alert" class="close" type="button">
		<span aria-hidden="true">×</span>
	</button>
	<strong>Error !</strong> <?php echo $error; ?>
</div>
<?php } ?>  

<?php 
    $success=$this->session->flashdata('success');
    if($success) {
?>
<div role="alert" class="alert alert-success alert-dismissible fade in">
	<button aria-label="Close" data-dismiss="alert" class="close" type="button">
		<span aria-hidden="true">×</span>
	</button>
	<strong>Success!</strong> <?php echo $success; ?>
</div>
<?php } ?>