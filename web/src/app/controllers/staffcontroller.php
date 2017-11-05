<?php 
session_start();
class staffcontroller extends Controller
{

		public function authentic($url)
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'staff')
			{
				 return true; 
			}
			else
			{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();	
			}
	    }
	    else
		{
			header("Location: http://".$url); 
         	    exit();
		}
    }
	
	public function index($database,$url){

	
	if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'staff')
			{
				 $Contract_details = $this->model("Contract_details");
				 $myId = $_SESSION['id'];
				 $contracts = $Contract_details->getStaffContractRequest($database,$myId);
                 $this->view('staff/home',$contracts);
 
			}
			else
			{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://".$url); 
         	    exit();
		}
   }


   public function active_contract($database,$url)
   {
   		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'staff')
			{
				 $Contract_details = $this->model("Contract_details");
				 $id = $_SESSION['id'];
			     $contracts = $Contract_details->getStaffContract($database,$id);
                 $this->view('staff/active_contract',$contracts);
 
			}
			else
			{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://".$url); 
         	    exit();
		}

   }


   public function accept_contrac_request($database,$url,$id)
   {

   	if($this->authentic($url) == true)
   	{
   		$Contract_details = $this->model("Contract_details");

   		$result = $Contract_details->acceptContracRequest($database,$id);

   		if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/home");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry there is some Problem");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/home';\",150);</script>";
				}
   	}

   }

   public function delete_contrac_request($database,$url,$id)
   {

   	if($this->authentic($url) == true)
   	{
   		$Contract_details = $this->model("Contract_details");

   		$result = $Contract_details->deleteContracRequest($database,$id);

   		if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/home");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry there is some Problem");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url".$userType."/home';\",150);</script>";
				}
   	}

   }

   public function receive_payment($database,$url,$contractId)
   {
   		if($this->authentic($url) == true)
			{
				$Staff_duty = $this->model("Staff_duty");				
				$duties = $Staff_duty->paidDuties($database,$contractId);

				if($duties['0'] != 0)
				{
					$this->view('staff/received_payment',$duties);
				}
				else
				{
					$this->view('staff/received_payment',null);
				}
				
				
			}
   }

   public function send_payment_by_staff($database,$url,$id,$contractId)
   {
   	if($this->authentic($url) == true)
			{
				$Staff_duty = $this->model("Staff_duty");				
				$result = $Staff_duty->paymentReceivedBystaff($database,$id);



				if($result == true)
					{
						$userType = $_SESSION['rolename'];
		  		   		 header("Location: http://".$url."/?url=".$userType."/receive_payment/".$contractId);
		  		    	exit();
					}
					else
					{
						echo "string";
		  		    	exit();
					}
				
				
			}
   }


}
 ?>