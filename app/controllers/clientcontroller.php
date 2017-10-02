<?php
session_start();
class clientcontroller extends Controller
{

	public function authentic($url)
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'client')
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
	
	public function index($database,$url)
	{


		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'client')
			{
				 $Contract_details = $this->model("Contract_details");
				 $id = $_SESSION['id'];
			     $contracts = $Contract_details->getClientContract($database,$id);
			     //print_r($contracts);
                 $this->view('client/home',$contracts);
 
			}
			else
			{

				$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home");
	  		    echo "sts";
         	    exit();	
			}
					
		}
		else
		{
			header("Location: http://".$url); 
         	exit();
		}
	}


	public function make_contrac($database,$url)
	{
		if($this->authentic($url) == true)
		{
		    $this->view('client/make_contrac');
	    }
	}

	public function submit_contract($database,$url)
	{
		if($this->authentic($url) == true)
		{
			//echo("ddd");
			if(isset($_POST['dayPerMonth'],$_POST['startingDate'],$_POST['monthlyPayment'],$_POST['monthLimit']))
			{
				$clinetId = $_SESSION['id'];
				$dayPerMonth = $_POST['dayPerMonth'];
				$startingDate = $_POST['startingDate'];
				$startingDate = str_replace('/', '-', $startingDate);
                $startingDate = strtotime($startingDate);
                $startingDate=date('Y-m-d', $startingDate);

				$monthlyPayment = $_POST['monthlyPayment'];
				$monthLimit = $_POST['monthLimit'];

				$contract = $this->model('Contract_details');

				$result = $contract->makeContrac($database,$clinetId,$dayPerMonth,$startingDate,$monthlyPayment,$monthLimit);
				if($result == true)
				{
				$$userType = $_SESSION['rolename'];
	  		    header("Location: http://".$url."/?url=".$userType."/home"); 
         	    exit();
					//echo ($result);
				}
			}
	    }
		
	}


	public function send_payment($database,$url)
	{
		if($this->authentic($url) == true)
		{
			$contractId = $_POST['contractId'];
			$paymentSerial = $_POST['paymentSerial'];
			$amount = $_POST['amount'];
			$paymentDate = $_POST['paymentDate'];
			$paymentDate = str_replace('/', '-', $paymentDate);
			$paymentDate = strtotime($paymentDate);
            $paymentDate=date('Y-m-d', $paymentDate);

            $Client_payments = $this->model("Client_payments");

            $result = $Client_payments->sendPaymentByClient($database,$contractId,$paymentSerial,$amount,$paymentDate);
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
					</script>';
					$userType = $_SESSION['rolename'];
					//print_r($result);
		  		    echo "<script>setTimeout(\"location.href = 'http://".$url."/?url=".$userType."/home';\",150);</script>";
				}

		}
	}

	public function send_payment_view($database,$url,$id)
	{
		if($this->authentic($url) == true)
		{
			//echo "string1";

			$this->view('client/send_payment',$id);
		}
	}
}

?>