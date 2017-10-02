<?php
session_start();
/**
* 
*/
class logincontroller extends Controller
{
	
	public function index($databaseName,$url,$data=[])
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1')
			{
				 $userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
			}
					
		}
		else
		{
			     $this->view('login/login',$data);
         	    //exit();
		}

	}

	public function logout($databaseName = [],$url)
	{
		//session_start();

		if(isset($_SESSION['login']))
		{
			session_destroy();
			header("Location: http://".$url); 
            exit();
		}
	}
	public function login($databaseName,$url)
	{
		 $userName = $_POST['userName'];
		 $password = $_POST['password'];
		 $password = md5($password);

	  $User = $this->model("User");

	  $result = $User->loginUser($databaseName,$userName,$password);


	  if($result == "true")
	  {
	  	/* Redirect browser */
	  	$userType = $_SESSION['rolename'];
	  	
	  	//header("Location: http://google.com"); 
	  	//echo "<br/> Location: http://localhost/ccps/public/".$userType."/home";

	  	header("Location: http://".$url."/?url=".$userType."/home"); 
        
	  }
	  else if($result == "false") 
	  {
	  	$data = "This username or password is not match";
	  	header("Location: http://". $url ."/?url=login/".$data); 
	  	//$this->view('login/login',"This username or password is not match");
	  }
	  else
	  {
	  	header("Location: http://". $url ."/?url=login/".$result); 
	  }

	}
}

?>