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
	
	   public function active_contract_of_staff($database,$url,$id,$userName,$password)
	   {
	   		if($this->auth($database,$id,$userName,$password))
	   		{
			$Contract_details = $this->model("Contract_details");
			$contracts = $Contract_details->getStaffContract($database,$id);
		    echo json_encode($contracts);
		    }
		    else
		    {
		    	$result['result'] = "Error";

		    	echo json_encode($result);
		    }

	   }

	   public function active_contract_of_client($database,$url,$id,$userName,$password)
	   {
	   		if($this->auth($database,$id,$userName,$password))
	   		{
			$Contract_details = $this->model("Contract_details");
			$contracts = $Contract_details->getClientContract($database,$id);
		    echo json_encode($contracts);
		    }
		    else
		    {
		    	$result['result'] = "Error";

		    	echo json_encode($result);
		    }

	   }
}

?>