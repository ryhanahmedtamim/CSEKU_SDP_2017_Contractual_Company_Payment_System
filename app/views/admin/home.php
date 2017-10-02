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
                                <th>Start Date</th> 
                                <th>Working Day</th> 
                                <th>Payment</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>  
                        <?php
                        if($data    != null){ 
                        foreach ($data as $contract) {
                             
                         
                         ?>     
                           
                            <tr>
                            
                                <td><?php echo $contract['client_name'] ; ?></td>
                                <td><?php echo $contract['start_date'] ; ?></td>
                                <td><?php echo $contract['monthly_workingday'] ; ?></td>
                            <td>
                            <?php 
                            echo $contract['payment_from_client_monthly'] ; 
                            ?>   
                            </td>

                                <td >
                                <a class=" button-radious-8 button-send  button-hover-blue" href="/?url=admin/send_contract_request/<?php echo $contract['id']; ?>">Send Request</a> 
                                
                                <a class=" button-radious-8 button-delete button-hovor-delete" href="/?url=admin/delete_contract_request/<?php echo($contract['id']); ?>"> Delete </a>

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
    <div > 
                           <?php

                            //print_r($id);
                             if($id == "true" || $id=="false" || $id == "send")
                              {
                                ?>
                                <div id="snackbar"><?php 
                                if($id == "true")
                                  {
                                    echo "Successfully Deleted";
                                  }
                                  elseif($id == "false")
                                    {
                                      echo "Sorry You Cannot delete";
                                      //print_r($data);
                                    }
                                    else
                                    {
                                        echo "Successfully Send";
                                    }?>
                                  
                                </div>
                                <?php
                               echo '<script>

                                 var x = document.getElementById("snackbar")
                                 x.className = "show";
                                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
                                 </script>';
                              }
                            ?> 
                            </div>


    </body>
    </html>