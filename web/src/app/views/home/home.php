    <?php 
      session_start ();
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>Home</title>

    <link href="http://agent.dgted.com/css/style.css" rel="stylesheet" type="text/css" >
    </head>
    <body class="body-home" >                  
                
          <ul class="ul1">
           <li class="li1">
           <a class="li-a" href="">Home</a></li>
           <li class="li1"><a class = "li-a"  href="/?url=login">Login</a></li>
           <li class="li1"><a class = "li-a"  href="/?url=register">Register</a></li>
        </ul>
                    

               <div class="body-home">

               <div style="padding-top: 280px">
                <div class="content">
                    <div class="title">
                        <?php
                        echo $_SESSION['company'];

                        ?>
                    </div>
                </div>
            </div>
             </div>


    </body>
    </html>