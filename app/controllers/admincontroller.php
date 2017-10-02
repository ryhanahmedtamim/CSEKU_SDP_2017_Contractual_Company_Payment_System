<?php

session_start();


class admincontroller extends Controller
{

	public function authentic($url)
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
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
	
	
	public function index($database,$url,$data = [])
	{
	

		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getContractRequest($database);
				 //print_r($data);
                 $this->view('admin/home',$contracts,$data);
 
			}
			else{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://". $url ."/?url=".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://".$url); 
         	    exit();
		}
		
	}

	public function pending_contract($database,$url)
	{

		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getPendingContract($database);
				 //print_r($contracts);
                 $this->view('admin/pending_contract',$contracts);
 
			}
			else{

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
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getActiveContract($database);
				 //print_r($contracts);
                 $this->view('admin/active_contract',$contracts);
 
			}
			else{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://localhost/ccps/public/"); 
         	    exit();
		}
	}

    
    public function user_request($database,$url)
    {
    	if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
                 $User = $this->model("User");
                 $allUser = $User->getAllUserRequest($database);
                 $this->view('admin/user_request',$allUser);
 
			}
			else{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http:".$url); 
         	    exit();
		}
    }

	public function alluser($database,$url)
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
                 $User = $this->model("User");
                 $allUser = $User->getAllUser($database);
                 $this->view('admin/alluser',$allUser);
 
			}
			else{

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

	public function accept_user_request($database,$url,$id)
	{
		if($this->authentic($url) == true)
		{
			$User = $this->model("User");
            $result = $User->acceptUserRequest($database,$id);
            //echo($id);
            if($result == true)
            {
            	$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/user_request");
            }
            else
            {
               $userType = $_SESSION['rolename'];
	  		   header("Location: http://".$url."/?url=".$userType."/user_request");
		   }
		}	
	}

	public function delete_user_request($database,$url,$id)
	{
		if ($this->authentic($url) == true)
		{
			$user = $this->model("User");

			$result = $user->deleteUserRequest($database,$id);

			if($result == true)
			{
				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/user_request");
			}
			else
			{
				$userType = $_SESSION['rolename'];
				header("Location: http://".$url."/?url=".$userType."/user_request");
			}
		}
	}

		public function delete_user($database,$url,$id)
		{
			if ($this->authentic($url) == true)
			{
				$user = $this->model("User");

				$result = $user->deleteUser($database,$id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/alluser");
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot delete this User");
					</script>';
					$userType = $_SESSION['rolename'];
		  		    //header("refresh:1; http://localhost/ccps/public/".$userType."/alluser");

		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/alluser';\",150);</script>";
				}
			}
		}

		public function disable_user($database,$url,$id)
		{
			if ($this->authentic($url) == true)
			{
				$user = $this->model("User");

				$result = $user->disableUser($database,$id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/alluser");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry You cannot delete this User");
					</script>';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/alluser';\",150);</script>";
				}
			}
		}


		public function delete_contract_request($database,$url,$id)
		{
			if($this->authentic($url) == true)
			{
				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->deleteContractRequest($database,$id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/true");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot disable this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/false';\",150);</script>";
				} 
			}
		}


		public function send_contract_request($database,$url,$id)
		{
			if($this->authentic($url) == true)
			{
				$user = $this->model("User");
				$users = $user->getAllStaff($database);

				$this->view('admin/send_contract',$users,$id);
			}
		}


		public function send_contract_request_to_staff($database,$url)
		{
			if($this->authentic($url) == true)
			{
				$contractsId = $_POST['id'];
				$monthlyPaymentForStaff = $_POST['monthlyPaymentForStaff'];
				$Saffid = $_POST['Saff'];



				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->sendContractRequest($database,$contractsId,$monthlyPaymentForStaff,$Saffid);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/send");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot disable this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/sorry';\",150);</script>";
				}
			}
		}

		public function delete_send_request($database,$url,$id)
		{

			if($this->authentic($url) == true)
			{
				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->deleteSendRequest($database,$id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/pending_contract");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry There is something wrong");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/pending_contract';\",150);</script>";
				}
			}
		}


		public function receive_payment($database,$url,$id)
		{
			if($this->authentic($url) == true)
			{
				$Client_payments = $this->model("Client_payments");
				$Client_payment = $Client_payments->findByContract($database,$id);
				$this->view('admin/receive_payment',$Client_payment);
			}
		}


	    public function	receive_payment_by_admin($database,$url,$paymentId, $ContracId)
	    {
	    	if($this->authentic($url) == true)
	    	{
	    		$Client_payments = $this->model("Client_payments");


	    		$result = $Client_payments->receivedPayment($database,$paymentId);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://".$url."/?url=".$userType."/receive_payment/".$ContracId);
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry There is something wrong");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/active_contract';\",150);</script>";
				}
				
			}
	    }
}

?>