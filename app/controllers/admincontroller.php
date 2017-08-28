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
	
	
	public function index()
	{
	

		if(isset($_SESSION['login']))
		{
	
			if($_SESSION['login'] == '1' && $_SESSION['rolename'] == 'admin')
			{
				 $Contract_details = $this->model("Contract_details");
				 $contracts = $Contract_details->getContractRequest();
				 //print_r($contracts);
                 $this->view('admin/home',$contracts);
 
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
}

?>