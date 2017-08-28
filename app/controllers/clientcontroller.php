<?php
session_start();
class clientcontroller extends Controller
{

	public function authentic()
	{
		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'Client')
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


	public function make_contrac()
	{
		if($this->authentic() == true)
		{
		    $this->view('client/make_contrac');
	    }
	}

	public function submit_contract()
	{
		if($this->authentic() == true)
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

				$result = $contract->makeContrac($clinetId,$dayPerMonth,$startingDate,$monthlyPayment,$monthLimit);
				if($result == true)
				{
				$$userType = $_SESSION['rolename'];
	  		    header("Location: http://localhost/ccps/public/".$userType."/home"); 
         	    exit();
					//echo ($result);
				}
			}
	    }
		
	}
}

?>