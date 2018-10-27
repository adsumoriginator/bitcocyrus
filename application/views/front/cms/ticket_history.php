<?php $this->load->view('front/basic/header_inner');?>




<section class="main_innerpage">
<div class="container-fluid">
<div class="pro_section">
<div class="pro_tit">
<h3> Support Tickets

</div>

<div class="pro_line"></div>

<div class="container">
 <div class="his_table">

 <h3>Support Tickets <span></span></h3>
 
 
 
 <table id="" class="table table-striped table-bordered example" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.No </th>  
                <th>Ticket Id </th>          
                <th>Category </th>
                <th>Subject </th>
                <th>Status </th>
                <th>Date & Time</th>
                <th>View</th>
       
            </tr>
        </thead>
       
        <tbody>

        <?php 
        $i=0;
        foreach($ticket_details->result() as $row){

                $i++;
        ?>

            <tr>
                <td><?php echo $i?> </td>
                <td><?php echo  $row->ticket_id ?></td>
                <td><?php echo  $row->category ?></td>
                <td><?php echo $row->subject ?> </td>
                 <td><?php echo $row->status ?> </td>
                <td><?php echo $row->created_date ?></td>
                <td><a href="<?php echo base_url() ?>reply/<?php echo  insep_encode($row->id) ?>">View</a></td>
             
            </tr>
      <?php
      }
      ?>     
       
            
          
           
          
           
        </tbody>
    </table>
  </div>
   </div>


</div>
</div>
</section>

<?php $this->load->view('front/basic/footer');?>
