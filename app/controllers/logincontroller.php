<?php
session_start();
/**
* 
*/
class logincontroller extends Controller
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
			     $this->view('login/login');
         	    exit();
		}

	}

	public function logout()
	{
		//session_start();

		if(isset($_SESSION['login']))
		{
			session_destroy();
			header("Location: http://localhost/ccps/public/"); 
            exit();
		}
	}
	public function login()
	{
		 $userName = $_POST['userName'];
		 $password = $_POST['password'];
		 $password = md5($password);

	  $User = $this->model("User");

	  $result = $User->loginUser($userName,$password);


	  if($result == "true")
	  {
	  	/* Redirect browser */
	  	$userType = $_SESSION['rolename'];
	  	
	  	//header("Location: http://google.com"); 
	  	//echo "<br/> Location: http://localhost/ccps/public/".$userType."/home";

	  	header("Location: http://localhost/ccps/public/".$userType."/home"); 
        
	  }
	  else if($result == "false") 
	  {

	  	$this->view('login/login',"This username or password is not match");
	  }
	  else
	  {
	  	$this->view('login/login',$result);
	  }

	}
}

?>