    <!DOCTYPE HTML>

    <html>
        <head>
            <title>Register</title>
            <link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >

     <script type="text/javascript">
             

       function validatePassword(){

        var password = document.getElementById("password")
              , confirm_password = document.getElementById("confirm_password");
        var len = 6;
            if(password.value < len)
            {
            password.setCustomValidity("Passwords must be greater than 6");
            }
            if(password.value != confirm_password.value)
            {
              confirm_password.setCustomValidity("Passwords Don't Match");
             } 
             else 
             {
                  confirm_password.setCustomValidity('');
            }
       }

         password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
      </script>
        </head>

        <body class="body-home">

         <ul class="ul1">
           <li class="li1">
           <a class="li-a" href="/ccps/public/">Home</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/login">Login</a></li>
           <li class="li1"><a class = "li-a"  href="">Register</a></li>
        </ul>
            <div class="body-home"> 
                            <div >
                           <?php
                             if($data != NULL)
                              {
                                ?>
                                <div id="snackbar"><?php print_r($data);?></div>
                                <?php
                               echo '<script>

                                 var x = document.getElementById("snackbar")
                                 x.className = "show";
                                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                                 </script>';
                              }
                            ?> 
                            </div>

            <div class="div1">

                <div>Register</div>
   
                <br>
                <form  action ="register/register" method="POST">
                        <div>

                        <label >Name</label>
                        <input type="text" id="text" name ="Name" required autofocus/>
                        </div>
                       
                        
                        <div> <label >Username</label>
                        <input type="text" id="user" name ="userName" required autofocus/>


                        </div>


                        <div><label >E-mail</label>
                        <input type="email" id="user" name ="email" required autofocus/></div>
                        
                        <div><label >Contact Number</label>
                        <input type="text" id="user" name ="phoneNumber" required autofocus/></div>
                        
                        <div><label >Address</label>
                        <input type="text" id="user" name ="address" required autofocus/></div>
                        

                        <div><label >User Type</label>
                         <select  name="userType" required autofocus>     
                              <option value=""></option>                      
                              <option value="Staff">Staff</option>
                              <option value="Client">Client</option>
                              
                        </select></div>

                         
                                            
                        <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name ="password" required autofocus/></div>

                        <div>
                        <label for="password">Confirm Password</label>
                        <input type="password" id="confirm_password" name ="confirm_password" required autofocus />
                        </div>
                         
                        
                   
                    
                         <button type="submit" class="button-submit button-radious-8 button-hover-blue" onclick = "validatePassword()" >
                                        Register
                                    </button>
                    
                </form>


            </div>
            </div>
        </body>
    </html>
