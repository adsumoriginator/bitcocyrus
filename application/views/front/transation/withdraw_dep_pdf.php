
<?php
if($type==1){
    ?>


      <center><h4>Deposit Report</h4></center>
 <table border="1px">
        <thead>
            <tr>
                <th>S.No </th>
                <th>Date & Time</th>
                <th>Currency </th>
                <th>Transaction ID </th>
                 <th>Deposit Amount</th>
              
                 <th>Action</th>
            </tr>
        </thead>
       
        <tbody>


        <?php
        $i=0;
        foreach($deposit->result() as $drow){
              $i++;
      
            ?>

            <tr>
                <td><?php  echo $i ?> </td>
                <td><?php echo $drow->requested_time ?></td>
                <td><?php echo $drow->currency?> </td>
                <td><?php echo  $drow->transactionId ?></td>
                <td><?php echo $drow->total_amount ?> </td>
                <td><?php echo $drow->to_address ?></td>
                <td><span class="org"><?php echo$drow->status ?></span></td>
            </tr>
            
            <?php
        }
        ?>
            

       
           

            
            
        </tbody>
    </table>
  <?php
}else{ 




  ?>

  <center><h4>Withdraw Report</h4></center>
 <table border="1px">
        <thead>
            <tr>
                <th>S.No </th>
                 
                <th>Date & Time</th>
                <th>Currency </th>
                <th>Transaction ID </th>
                 <th>Withdraw Amount</th>
                 <th>Fees</th>
                 <th>Receive Amount</th>
                  <th>Status</th>
            </tr>
        </thead>
       
        <tbody>

<?php



$i=0;
    foreach($withdraw->result() as $wrow){


        $i++;

        ?>

            <tr>
                <td><?php echo $i; ?> </td>


                <td><?php echo $wrow->requested_time ?> </td>
                <td><?php echo $wrow->currency ?> </td>
                <td><?php echo $wrow->transactionId ?> </td>
                <td><?php echo $wrow->total_amount ?> </td>
                <td><?php echo $wrow->fee_percentage ?>%</td>
                 <td><?php echo $wrow->transfer_amount ?></td>
                <td><span class="org"><?php echo $wrow->status ?></span></td>
            </tr>
     
      <?php
      }
      ?>    
             
        
            

            
        </tbody>
    </table>
<?php
}

?>