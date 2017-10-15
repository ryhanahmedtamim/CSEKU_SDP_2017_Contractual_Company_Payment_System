<?php

/**
* 
*/
class mobilecontroller extends Controller
{
	public function auth($databaseName,$id,$userName, $password)
	{
		
		 $password = md5($password);

	    $User = $this->model("User");

	    $result = $User->loginMobileUser($databaseName,$userName,$password);
	    if($result["id"] == $id)
	    {
	    	return true;
	    }
	    else
	    	return false;
	}

	public function mob_login($databaseName,$url)
	{
		$userName = $_POST['userName'];
		 $password = $_POST['password'];
		 $password = md5($password);

	    $Users = $this->model("User");

	    $user = $Users->loginMobileUser($databaseName,$userName,$password);

	    if($user != false )
	    {
	    	$id = $user['id'];	

	    	if($user['rolename'] == 'client')
	    	{
	    		$contracts = $this->active_contract_of_client($databaseName,$id);
	    	}
	    	else
	    	{
	    		$contracts = $this->active_contract_of_staff($databaseName,$id);
	    	}
	    	

	    	$result['user'] = $user;
	    	$result['contracts'] = $contracts;
	    	echo json_encode($result);
	    }

	    

	}
	
	   public function active_contract_of_staff($database,$id)
	   {
	   		
			$Contract_details = $this->model("Contract_details");
			$contracts = $Contract_details->getStaffContract($database,$id);
		     return $contracts;
		    
		    

	   }

	   public function active_contract_of_client($database,$id)
	   {
	   		
			$Contract_details = $this->model("Contract_details");
			$contracts = $Contract_details->getClientContract($database,$id);
		   		
		   	return $contracts;
		    
	   }
}

?>