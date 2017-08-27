<?php
session_start();
class clientcontroller extends Controller
{
	
	public function index()
	{


		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Client')
			{
				 $Contract_details = $this->model("Contract_details");
				 $id = $_SESSION['id'];
			     $contracts = $Contract_details->getClientContract($id);
			     //print_r($contracts);
                 $this->view('client/home',$contracts);
 
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