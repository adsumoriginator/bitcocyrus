<?php $this->load->view('front/basic/header_inner'); ?>

<section class="main_innerpage">
<div class="container">

<div class="cms_sec">

<h1><?php echo $cms_cnt->title; ?></h1>

<div class="cms_bx">
<?php echo $cms_cnt->content_description; ?>

</div>

</div>

</div>
</section>
<?php $this->load->view('front/basic/footer'); ?>