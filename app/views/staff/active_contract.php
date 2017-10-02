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
            <h1>Active Contract</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Phone Number</th>    
                                <th>Month Limit</th>
                                <th>Payment</th>  
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php
                        if($data != null){ 
                        foreach ($data as $contract) {
                             
                         
                         ?>     
                           
                            <tr>
                            
                                <td><?php echo $contract['client_name'] ; ?></td>
                                <td><?php echo $contract['contact_no'] ; ?></td>
                                <td><?php echo $contract['month_limit'] ; ?></td>

                                <td>
                            <?php 
                            echo $contract['payment_for_staff_monthly'] ; 
                            ?>   
                            </td>
                                                           
                                     <td > <button class=" button-radious-8 button-send  button-hover-blue " >
                                        Get Payment
                                    </button>

                                     <a class=" button-radious-8 button-delete button-hovor-delete" href="" >
                                        Delete
                                    </a> 

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