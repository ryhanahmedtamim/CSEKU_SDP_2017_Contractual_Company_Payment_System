<?php

/**
* 
*/
class registercontroller extends Controller
{
	
	public function index($database,$url,$data = [])
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
			echo $data;
			$this->view('register/register',$data);
         	    exit();
		}
	}

	public function register($database,$url)
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

	  $result = $User->registerUser($database,$Name , $userName, $email, $phoneNumbe, $address,$userType,$password);
	  if($result == true)
	  {
	  	/* Redirect browser */
	  	$data = "Your Request Is Pending";
	  	header("Location: http://". $url ."/?url=register/".$data);
	  	exit(); 
	  }
	  else 
	  {

	  	$data = "This username is not abilable";
	  	header("Location: http://". $url ."/?url=register/".$data);
	  	exit();
	  }


	  
	}

}

?>