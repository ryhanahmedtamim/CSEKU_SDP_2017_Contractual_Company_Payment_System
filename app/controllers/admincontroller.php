<?php

class admincontroller extends Controller
{
	
	public function index()
	{
         $this->view('admin/home');
		// if(isset($_SESSION['login']))
		// {

		// 	if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
		// 	{
                  
		// 	}
		// 	$userType = $_SESSION['rolename'];
	 //  	header("Location: http://localhost/ccps/public/".$userType."/home"); 
  //        exit();
		// }
		// else
		// {var_dump( $_SESSION['login']);
		// 	//header("Location: http://localhost/ccps/public/login");
		// }
		
	}
}

?>