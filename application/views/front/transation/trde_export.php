 <?php 
 if($type==""){
   header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=trade_history.xls");
    header("Pragma: no-cache");
    header("Expires: 0"); 


}else{
    ?>
    <center><h4>Trade History</h4></center>
<?php
}
?>


 <?php 
 if($type==""){

    }else{

        echo "<center>";
    }
?>

<table border="1px">
         
  

        <thead>
            <tr>
                <th>S.No </th>
                <th>Date & Time</th>
                <th>Type </th>
                <th>Pair </th>
                 <th>Price</th>
                 <th>Amount </th>
                 <th>Status</th>
            </tr>
        </thead>
       
        <tbody>

        <?php 
        $i=1;
 
          foreach($trade_history->result() as $row){
            ?>


             <tr>
                <td><?php echo $i ?> </td>
                <td><?php echo  $row->datetime ?></td>
                <td><?php echo  $row->Type ?> </td>
                <td> <?php echo  $row->to_currency_symbol ?>/<?php echo $row->from_currency_symbol ?> </td>
                <td><?php echo  number_format($row->Price,8) ?> </td>
                <td><?php echo  number_format($row->Amount,8)?> </td>
                <?php
                if($row->status =="cancelled" || $row->status =="stoporder" 
                  ){?>
                <td><span class="rdn"><?php  echo $row->status ?></span> </td>
              <?php
            }else{
              ?>

               <td><span class="grn"><?php  echo $row->status ?></span> </td>
<?php
            }
?>
            </tr>
             <?php
             $i++;
           }
           ?>   </table>


 <?php 
 if($type==""){

    }else{

        echo "</center>";
    }
?>