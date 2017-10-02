    <!DOCTYPE html>
    <html>
    <head>
    <title>NR Company</title>

   
    </head>
    <body class="body-home" >                  
                
         <?php

         include ('layout/layout.php');
         ?>
                    

<div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>Active Cotract</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Client Name</th>   
                                <th>Staff Name</th> 
                                <th>Staff Payment</th> 
                                <th>Client Pay</th> 
                                <th>Action</th>
                                <th>Payment</th>
                                <th>History</th>
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php
                        if($data != null){ 
                        foreach ($data as $contract) {
                             
                         
                         ?>     
                           
                            <tr>
                            
                                <td><?php echo $contract['client_name'] ; ?></td>
                                <td><?php echo $contract['staff_name'] ; ?></td>
                                

                            <td>
                            <?php 
                            echo $contract['payment_for_staff_monthly'] ; 
                            ?>   
                            </td>
                                
                            <td>
                            <?php 
                            echo $contract['payment_from_client_monthly'] ; 
                            ?>   
                            </td>
                                <td>
                                     <a class=" button-radious-8 button-delete button-hovor-delete" href="" >
                                        Delete
                                    </a> 

                                 </td>

                                 <td>
                                     <a class=" button-radious-8 button-send  button-hover-blue" href="/?url=admin/send_payment/<?php echo $contract['id']; ?>">Send</a>

                                     <?php if($contract['receive'] == 1) 
                                     {
                                        ?>
                                     <a class=" button-radious-8 button-send  button-hover-blue" href="/?url=admin/receive_payment/<?php echo $contract['id']; ?>">Receive</a>
                                     <?php }
                                     else
                                        {
                                        ?>
                                        <a class=" button-radious-8 button-send   disabled-button" href="">Receive</a>
                                        <?php
                                       }
                                        ?>

                                    
                                 </td>

                                 <td>
                                     <a class=" button-radious-8 button-send  button-hover-blue" href="">History</a>
                                 </td>
                            </tr>
                            <?php
                             } 
                         }
                             ?>
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


        
        </div>
    </div>


    </body>
    </html>