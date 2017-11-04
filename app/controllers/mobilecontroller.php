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


	   public function submit_duty($database,$url)
	   {
	   		
		    $contractId = $_POST['contractId'];
		    $dutyDate = $_POST['dutyDate'];
		    $dutyDate = str_replace('/', '-', $dutyDate);
            $dutyDate = strtotime($dutyDate);
            $dutyDate=date('Y-m-d', $dutyDate);

		    $nextDate = $_POST['nextDate'];
		    $nextDate = str_replace('/', '-', $nextDate);
            $nextDate = strtotime($nextDate);
            $nextDate=date('Y-m-d', $nextDate);        

            
            	$Staff_duty = $this->model("Staff_duty");

            	$duty = $Staff_duty->submitDuty($database,$contractId,$dutyDate,$nextDate);
            	
            	if($duty == true)
            	{
            		$result['result'] = $duty;

            	    echo json_encode($result);	
            	}
            	else
            	{
            		$result['result'] = $duty;
            		echo json_encode($result);	
            	}       


	   }

	   public function get_pending_duties($database, $url,$contractId)
	   {
	   		$Staff_duty = $this->model("Staff_duty");

            $duty = $Staff_duty->pendingDuties($database,$contractId);

            $result['result'] = $duty;

            echo json_encode($result);

	   }

	   public function get_approved_duty($database,$url,$contractId)
	   {

	   		$Staff_duty = $this->model("Staff_duty");

            $duty = $Staff_duty->approvedDuties($database,$contractId);

            $result['result'] = $duty;

            echo json_encode($result);
	   }


        public function approveDuty($database,$url,$id)
        {
        	    $Staff_duty = $this->model("Staff_duty");

            	$duty = $Staff_duty->approveDuty($database,$id);

               $result['result'] = $duty;

               echo json_encode($result);

        }    	


}

?>