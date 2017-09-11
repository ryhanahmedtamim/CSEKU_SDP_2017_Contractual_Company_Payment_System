<!DOCTYPE html>
<html>
<head>
	<title>NR Company</title>
	<link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >
</head>
<body class="body-home">

         <?php

         include ('layout/layout.php');
         ?>

         <div class="body-home"> 

            <div class="div1">

                <div>Send Contract</div>
                <br>
                <form  action ="/ccps/public/admin/send_contract_request_to_staff" method="POST">
                        <div>

                        
                        <input type="hidden" id="text" name="id" value = "<?php print_r($id); ?>" required autofocus/>
                        </div>
                       
                        
                        

                      
                        <div><label >Monthly Payment for Staff</label>
                        <input type="text"  name ="monthlyPaymentForStaff" required autofocus/></div>
                        
                        <div><label >Select Staff</label>
                        <select  name="Saff" required autofocus>     
                              <option value=""></option>
                              <?php 
                                  foreach ($data as $user) {
                                  	
                                  
                              ?>                      
                              <option value="<?php echo $user['id'];  ?>">
                              	<?php echo $user['name']; ?>
                              </option>
                              <?php
                          }
                              ?>
                              
                              
                        </select></div>
                        

                
                         
                        
                   
                    
                         <button type="submit" class="button-submit button-radious-8 button-hover-blue"  >
                                        Submit
                                    </button>
                    
                </form>


            </div>
            </div>


</body>
</html>