
 <?php 

 if($type==1){
    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=commissin.xls");
    header("Pragma: no-cache");
    header("Expires: 0"); 
}
?>

 <table>
        <thead>
            <tr>
                <th>S.No </th>
                 
                <th>Reference user</th>
                <th>Currency </th>
                <th>Reference amount </th>
                 <th>Date Time</th>
                
            </tr>
        </thead>
       
        <tbody>
<?php
$i=0;
    foreach($reference_commission->result() as $wrow){

        $i++;

        ?>  <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $wrow->refer_user ?> </td>
                <td><?php echo $wrow->currency ?> </td>
                <td><?php echo $wrow->commission_amount ?> </td>
               <td><?php echo $wrow->timedate ?> </td>
               
            </tr>
     
      <?php
      }
      ?>    
             
        
            

            
        </tbody>
    </table>
