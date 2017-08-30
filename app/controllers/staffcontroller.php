<?php 
session_start();
class staffcontroller extends Controller
{

	public function authentic()
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Staff')
			{
				 return true; 
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


   public function accept_contrac_request($id)
   {

   	if($this->authentic() == true)
   	{
   		$Contract_details = $this->model("Contract_details");

   		$result = $Contract_details->acceptContracRequest($id);

   		if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/home");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry there is some Problem");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/home';\",150);</script>";
				}
   	}

   }

   public function delete_contrac_request($id)
   {

   	if($this->authentic() == true)
   	{
   		$Contract_details = $this->model("Contract_details");

   		$result = $Contract_details->deleteContracRequest($id);

   		if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/home");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry there is some Problem");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/home';\",150);</script>";
				}
   	}

   }


}
 ?>