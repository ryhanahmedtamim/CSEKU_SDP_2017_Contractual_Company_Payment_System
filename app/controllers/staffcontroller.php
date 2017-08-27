<?php 
session_start();
class staffcontroller extends Controller
{
	
	public function index(){

	
	if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Staff')
			{
				 $Contract_details = $this->model("Contract_details");
				 $myId = $_SESSION['id'];
				 $contracts = $Contract_details->getStaffContractRequest($myId);
                 $this->view('staff/home',$contracts);
 
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


   public function active_contract()
   {
   		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Staff')
			{
				 $Contract_details = $this->model("Contract_details");
				 $id = $_SESSION['id'];
			     $contracts = $Contract_details->getStaffContract($id);
                 $this->view('staff/active_contract',$contracts);
 
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