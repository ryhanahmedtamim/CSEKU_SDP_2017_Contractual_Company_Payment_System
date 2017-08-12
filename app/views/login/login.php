    <!DOCTYPE HTML>

    <html>
        <head>
            <title>Login</title>
            <link href="http://localhost/ccps/public/css/style.css" rel="stylesheet" type="text/css" >
        </head>

        <body>

         <ul class="ul1">
           <li class="li1">
           <a class="li-a" href="/ccps/public/">Home</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/login">Login</a></li>
           <li class="li1"><a class = "li-a"  href="/ccps/public/register">Register</a></li>
        </ul>
            <div  style="padding:20px;margin-top:30px;background-color:#1abc9c;height:650px;"> 

            <div class="div1">

                <div>Login</div>
                <br>
                <form action ="process.php" method="POST">
                        
                        <div style="display: inline;">
                         <label for="user">Username</label>
                        <input type="text" id="user" name ="userName" />
                        </div>
                    
                   
                         <label for="password">Password</label>
                        <input type="password" id="password" name ="pass" />
                   
                    
                         <button type="submit" class="button button-radious-8 button-hover-blue">
                                        Login
                                    </button>
                    
                </form>


            </div>
            </div>
        </body>
    </html>
