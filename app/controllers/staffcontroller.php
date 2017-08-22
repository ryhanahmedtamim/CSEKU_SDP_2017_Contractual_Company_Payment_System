<?php 
session_start();
class staffcontroller extends Controller
{
	
	public function index(){

	
	if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Staff')
			{
                 $this->view('staff/home');
 
			}
			else
			{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://localhost/ccps/public/"); 
         	    exit();
		}
   }
}
 ?>