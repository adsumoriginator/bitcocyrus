<?php $this->load->view('front/basic/header_inner'); ?>


<section class="main_innerpage">
<div class="container">

<div class="cms_sec">

<h3>Frequently asked questions</h3>

<div class="cms_bx">
<div id="accordion" role="tablist" aria-multiselectable="true">

<?php if($faq_cnt){ 
  $i=0;
 foreach($faq_cnt as $faq){ 
  $i++;
  ?>

  <div class="card">
    <div class="card-header" role="tab" id="heading_<?php echo $i; ?>">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i; ?>">
          <img src="assets/frontend/images/dot.png"> <?php echo $faq->question; ?>  
        </a>
      </h5>
    </div>

    <div id="collapse_<?php echo $i; ?>" class="collapse <?php if($i==1){ echo "show"; } ?>" role="tabpanel" aria-labelledby="heading_<?php echo $i; ?>">
      <div class="card-block">
      <p><?php echo $faq->description; ?>  </p>
      </div>
    </div>
  </div>  

  <?php } }else{
      echo "No results found";
    } ?>

</div>

</div>

</div>

</div>
</section>

<?php $this->load->view('front/basic/footer'); ?>