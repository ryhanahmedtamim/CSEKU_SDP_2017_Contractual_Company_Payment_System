<?php

/**
* 
*/
class registercontroller extends Controller
{
	
	public function index()
	{
		$this->view('register/register');
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
	  	header("Location: http://localhost/ccps/public/"); 
         exit();
	  }
	  else 
	  {

	  	$this->view('register/register',"This username is not abilable");
	  }


	  
	}

}

?>