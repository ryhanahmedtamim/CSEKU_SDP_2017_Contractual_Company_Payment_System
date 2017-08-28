    <!DOCTYPE html>
    <html>
    <head>
    <title>NR Company</title>

    <link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >
    </head>
    <body class="body-home" >                  
                
         <?php

         include ('layout/layout.php');
         ?>
                    

<div class="container-fluid">
    <div class="row">



    <div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
            <h1>All User</h1><hr>
            <div class="panel panel-default" >
                <div class="panel-body">                     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>   
                                <th>Phone Number</th>
                                <th>E-mail</th> 
                                <th>Role name</th>                              
                                <th>Action</th>
                                <th>Status</th>
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
                                
                                <td > <button class=" button-radious-8 button-hovor-disable  button-disable" >
                                        Disable
                                    </button>

                                     <button class=" button-radious-8 button-delete button-hovor-delete"" >
                                        Delete
                                    </button>  </td>
                                    <td> <button class=" button-radious-8 button-hover-blue button-send" >
                                        Status
                                    </button></td>
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