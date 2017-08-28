<?php

/**
* 
*/
class registercontroller extends Controller
{
	
	public function index()
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1')
			{
				 $userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/home"); 
			}
					
		}
		else
		{
			     $this->view('register/register');
         	    exit();
		}
	}

	public function register()
	{
	  $Name = $_POST['Name'];
	  $userName = $_POST['userName'];
	  $email = $_POST['email'];
	  $phoneNumbe = $_POST['phoneNumber'];
	  $address = $_POST['address'];
	  $userType = $_POST['userType'];
	  $password = $_POST['password'];

	  $password = md5($password);


	  $User = $this->model("User");

	  $result = $User->registerUser($Name , $userName, $email, $phoneNumbe, $address,$userType,$password);
	  if($result == true)
	  {
	  	/* Redirect browser */
	  	$this->view('register/register',"Your Request Is Pending");
         exit();
	  }
	  else 
	  {

	  	$this->view('register/register',"This username is not abilable");
	  }


	  
	}

}

?>