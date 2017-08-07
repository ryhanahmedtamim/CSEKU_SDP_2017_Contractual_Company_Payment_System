<!DOCTYPE HTML>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        
        <div id ="form">
            <h4><i>Contractual Company Payment System</i></h4><br>
            <form action ="process.php method=POST">
                <p>
                    <label><b>Username:</b> </label>
                    <input type="text" id="user" name ="user" />
                </p>
                <p>
                    <label><b>Password:</b> </label>
                    <input type="password" id="pass" name ="pass" />
                </p>
                <p>
                    <input type="submit" id="button" value="LogIn" />
                </p>
            </form>


        </div>
    </body>
</html>
