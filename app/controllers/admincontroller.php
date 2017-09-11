<?php

session_start();


class admincontroller extends Controller
{

	public function authentic()
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
	
	
	public function index($data = [])
	{
	

		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getContractRequest();
				 //print_r($data);
                 $this->view('admin/home',$contracts,$data);
 
			}
			else{

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

	public function pending_contract()
	{

		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getPendingContract();
				 //print_r($contracts);
                 $this->view('admin/pending_contract',$contracts);
 
			}
			else{

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
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getActiveContract();
				 //print_r($contracts);
                 $this->view('admin/active_contract',$contracts);
 
			}
			else{

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

    
    public function user_request()
    {
    	if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
                 $User = $this->model("User");
                 $allUser = $User->getAllUserRequest();
                 $this->view('admin/user_request',$allUser);
 
			}
			else{

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

	public function alluser()
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
                 $User = $this->model("User");
                 $allUser = $User->getAllUser();
                 $this->view('admin/alluser',$allUser);
 
			}
			else{

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

	public function accept_user_request($id)
	{
		if($this->authentic() == true)
		{
			$User = $this->model("User");
            $result = $User->acceptUserRequest($id);
            //echo($id);
            if($result == true)
            {
            	$userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/user_request");
            }
            else
            {
               $userType = $_SESSION['rolename'];
	  		   header("Location: http://localhost/ccps/public/".$userType."/user_request");
		   }
		}	
	}

	public function delete_user_request($id)
	{
		if ($this->authentic() == true)
		{
			$user = $this->model("User");

			$result = $user->deleteUserRequest($id);

			if($result == true)
			{
				$userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/user_request");
			}
			else
			{
				$userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/user_request");
			}
		}
	}

		public function delete_user($id)
		{
			if ($this->authentic() == true)
			{
				$user = $this->model("User");

				$result = $user->deleteUser($id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/alluser");
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot delete this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    //header("refresh:1; http://localhost/ccps/public/".$userType."/alluser");

		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/alluser';\",150);</script>";
				}
			}
		}

		public function disable_user($id)
		{
			if ($this->authentic() == true)
			{
				$user = $this->model("User");

				$result = $user->disableUser($id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/alluser");
		  		    exit();
				}
				else
				{
				   
				   echo '<script type="text/javascript">
					 alert("Sorry You cannot disable this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/alluser';\",150);</script>";
				}
			}
		}


		public function delete_contract_request($id)
		{
			if($this->authentic() == true)
			{
				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->deleteContractRequest($id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/true");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot disable this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/false';\",150);</script>";
				} 
			}
		}


		public function send_contract_request($id)
		{
			if($this->authentic() == true)
			{
				$user = $this->model("User");
				$users = $user->getAllStaff();

				$this->view('admin/send_contract',$users,$id);
			}
		}


		public function send_contract_request_to_staff()
		{
			if($this->authentic() == true)
			{
				$contractsId = $_POST['id'];
				$monthlyPaymentForStaff = $_POST['monthlyPaymentForStaff'];
				$Saffid = $_POST['Saff'];



				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->sendContractRequest($contractsId,$monthlyPaymentForStaff,$Saffid);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/send");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry You cannot disable this User");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/sorry';\",150);</script>";
				}
			}
		}

		public function delete_send_request($id)
		{

			if($this->authentic() == true)
			{
				$Contract_details = $this->model("Contract_details");
				$result = $Contract_details->deleteSendRequest($id);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/pending_contract");
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry There is something wrong");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/pending_contract';\",150);</script>";
				}
			}
		}


		public function receive_payment($id)
		{
			if($this->authentic() == true)
			{
				$Client_payments = $this->model("Client_payments");
				$Client_payment = $Client_payments->findByContract($id);
				$this->view('admin/receive_payment',$Client_payment);
			}
		}


	    public function	receive_payment_by_admin($paymentId, $ContracId)
	    {
	    	if($this->authentic() == true)
	    	{
	    		$Client_payments = $this->model("Client_payments");


	    		$result = $Client_payments->receivedPayment($paymentId);

				if($result == true)
				{
					$userType = $_SESSION['rolename'];
		  		    header("Location: http://localhost/ccps/public/".$userType."/receive_payment/".$ContracId);
		  		    exit();
				}
				else
				{
					echo '<script type="text/javascript">
					 alert("Sorry There is something wrong");
					</script>)';
					$userType = $_SESSION['rolename'];
		  		    echo "<script>setTimeout(\"location.href = 'http:////localhost/ccps/public/".$userType."/active_contract';\",150);</script>";
				}
				
			}
	    }
}

?>