    <!DOCTYPE HTML>

    <html>
        <head>
            <title>Login</title>
            <link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >
        </head>

        <body class="body-home">

         <ul class="ul1">
           <li class="li1">
           <a class="li-a" href="/ccps/public/">Home</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/login">Login</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/register">Register</a></li>
        </ul>
           <div class="body-home">

            <div class="div1">

                <div style="margin-left: 30px;">Login</div>
                <br>
                <form action ="login/login" method="POST">
                        
                        <div style="display: inline;">
                         <label for="user">Username</label>
                        <input type="text" id="user" name ="userName" required autofocus/>

                        <CENTER >
                        <div class="red-font">
                           <?php
                             if($data != NULL)
                              {

                               print_r($data);
                              }
                            ?> 
                            </div>
                         </CENTER>
                        </div>

                        <div >
                         <label for="password">Password</label>
                        <input type="password" id="password" name ="password" required autofocus />
                        </div>
                    
                         <button type="submit" class="button-submit  button-radious-8 button-hover-blue">
                                        Login
                                    </button>
                    
                </form>


            </div>
            </div>
        </body>
    </html>
