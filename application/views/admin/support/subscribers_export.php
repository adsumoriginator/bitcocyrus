
 <?php
 
header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=subscriber.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
 ?>
                                     <table >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Email id</th>
                                                    <th>Subscribed Date</th>
                                                    
                                                
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $ii = 0;
                                                
                                                foreach ($subscribers->result() as $value) { 


                                                    $ii++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $ii; ?></td>

                                                      <td><?php echo $value->email_id; ?></td>
                                                    <td><?php echo $value->created_date; ?></td>
                                                    
                                                 
                                                                                  </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
