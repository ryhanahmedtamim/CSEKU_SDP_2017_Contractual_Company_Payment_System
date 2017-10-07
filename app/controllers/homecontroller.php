<?php 

/**
* 
*/
session_start();
class homecontroller extends Controller
{
	
	public function index($database,$url)
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
			     $this->view('home/home');
         	    exit();
		}
	}

	public function mobile($database,$url)
	{
		$json ['company_name'] = $_SESSION['company'];
		echo json_encode($json);
	}
}

 ?>