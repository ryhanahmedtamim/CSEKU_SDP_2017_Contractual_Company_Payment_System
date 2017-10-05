<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['company']; ?></title>
   <link href="http://agent.dgted.com/css/style.css" rel="stylesheet" type="text/css" >
</head>
<body class="body-home">
           <ul class="ul1">
               <li class="li1">
               <a class="li-a" href="?url=admin/home">Home</a></li>
               
               <li class="li1"><a class = "li-a"  href="/?url=admin/user_request">User Request</a></li>

               <li class="li1"><a class = "li-a"  href="/?url=admin/alluser">User</a></li>
               <li class="li1"><a class = "li-a"  href="/?url=admin/active_contract">Active contract</a></li>
               <li class="li1"><a class = "li-a"  href="?url=admin/pending_contract">Pending Contract</a></li>
               <li class="li1"><a class = "li-a"  href="/?url=admin/home">Contract Request</a></li>
               <li class="li1"><a class = "li-a"  href="/?url=admin/totalstatus">Total Economical Status</a></li>

               <li class="li2"><a class = "li-a"  href="/?url=login/logout">Logout</a></li>

            </ul>
</body>
</html>