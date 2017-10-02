    <!DOCTYPE html>
    <html>
    <head>
    <title>NR Company</title>

    <link href="http://agent.dgted.com/css/style.css" rel="stylesheet" type="text/css" >
    </head>
    <body class="body-home" >                  
                
         <?php

         include ('layout/layout.php');
         ?>
                    

<div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1> Cotract Requests</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Client Name</th>   
                                <th>Staff Name</th> 
                                <th>Start Date</th>
                                <th>Staff Payment</th> 
                                <th>Client Pay</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php

                        if($data != NULL){                       
                        foreach ($data as $contract) {
                             
                         
                         ?>     
                           
                            <tr>
                            
                                <td><?php echo $contract['client_name'] ; ?></td>
                                <td><?php echo $contract['staff_name'] ; ?></td>
                                <td><?php echo $contract['start_date'] ; ?></td>

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
                            <a class=" button-radious-8 button-delete button-hovor-delete" href="/?url=admin/delete_send_request/<?php echo $contract['id']; ?>"> Delete</a>
                                     

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