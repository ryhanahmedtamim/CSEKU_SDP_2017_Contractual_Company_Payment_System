<?php 

/**
* 
*/
session_start();
class homecontroller extends Controller
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
			     $this->view('home/home');
         	    exit();
		}
	}
}

 ?>