    <!DOCTYPE html>
    <html>
    <head>
    <title><?php echo  $_SESSION['company']; ?></title>

      <link href="http://agent.dgted.com/css/style.css" rel="stylesheet" type="text/css" >
    </head>
    <body class="body-home" >                  
                
         <?php

         include ('layout/layout.php');
         ?>
                    

<div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>User Request</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>   
                                <th>Phone Number</th>
                                <th>E-mail</th>  
                                <th>Rolename</th> 

                                
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>

                        
                            
                        
                        <tbody>       
                           <?php 
                           if($data != NULL){ 
                           foreach ($data as $user) { 
                            ?>
                            <tr>
                            
                               
                                <td><?php  echo $user['name']; ?></td>
                                <td><?php  echo $user['contact_no']; ?></td>
                                <td><?php  echo $user['email']; ?></td>
                                <td><?php  echo $user['rolename']; ?></td>
                                
                                <td > 
                                <a class="button-radious-8 button-hover-blue button-send" href="/?url=admin/accept_user_request/<?php echo $user['id']; ?>">Accept</a>

                                     <a class=" button-radious-8 button-delete button-hovor-delete" href="/?url=admin/delete_user_request/<?php echo $user['id']; ?>" >
                                        Delete
                                    </a>  
                                    </td>
                                    </tr>
                                 
                                  <?php }
                                  }?>
                            </tbody>
                          

                        </table>
                    </div>
                </div>
            </div>


        
        </div>
    </div>


    </body>
    </html>