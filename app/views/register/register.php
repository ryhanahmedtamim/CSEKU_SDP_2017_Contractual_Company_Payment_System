    <!DOCTYPE HTML>

    <html>
        <head>
            <title>Register</title>
            <link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >
        </head>

        <body>

         <ul class="ul1">
           <li class="li1">
           <a class="li-a" href="/ccps/public/">Home</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/login">Login</a></li>
           <li class="li1"><a class = "li-a"  href="">Register</a></li>
        </ul>
            <div  style="padding:1px;margin-top:10px;background-color:#1abc9c;height:relative;"> 

            <div class="div1">

                <div>Register</div>
                <br>
                <form  action ="register/register" method="POST">
                        <div>

                         <label for="user">Name</label>
                        <input type="text" id="user" name ="Name" required autofocus/>
                        </div>
                       
                        
                        <div> <label for="user">Username</label>
                        <input type="text" id="user" name ="userName" required autofocus/></div>

                        <div><label for="user">E-mail</label>
                        <input type="email" id="user" name ="email" required autofocus/></div>
                        
                        <div><label for="user">Contact Number</label>
                        <input type="text" id="user" name ="phoneNumber" required autofocus/></div>
                        
                        <div><label for="user">Address</label>
                        <input type="text" id="user" name ="address" required autofocus/></div>
                        

                        <div><label >User Type</label>
                         <select  name="userType" required autofocus>     
                              <option value=""></option>                      
                              <option value="Staff">Staff</option>
                              <option value="Client">Client</option>
                              
                        </select></div>

                         
                                            
                        <div><label for="password">Password</label>
                        <input type="password" id="password" name ="password" required autofocus/></div>

                        <div><label for="password">Confirm Password</label>
                        <input type="password" id="password" name ="password2" required autofocus /></div>
                         
                        
                   
                    
                         <button type="submit" class="button button-radious-8 button-hover-blue">
                                        Register
                                    </button>
                    
                </form>


            </div>
            </div>
        </body>
    </html>
