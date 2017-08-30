<?php 
//session_start();


/**
* 
*/
require_once '../app/core/Model.php';

class Contract_details extends Model
{
	
    

	public function __construct()
	{
		
		//$db = mysqli_query($query,$db);
	}

	//client

	public function makeContrac($clinetId,$dayPerMonth,$startingDate,$monthlyPayment,$monthLimit)
	{
		$querString = "INSERT INTO `contract_details` (`id`, `client_id`, `staff_id`, `start_date`, `monthly_workingday`, `payment_from_client_monthly`, `payment_for_staff_monthly`, `month_limit`, `active`) VALUES (NULL, '$clinetId', NULL, '$startingDate', '$dayPerMonth', '$monthlyPayment', NULL, '$monthLimit', '0')";

		return $this->booleanQuery($querString);
	}

	public function getClientContract($id)
	{
		$querString = "SELECT * FROM `contract_details` WHERE client_id = '$id' AND active = '1' AND staff_id IS NOT NULL AND payment_for_staff_monthly IS NOT NULL";

            require_once '../app/models/User.php';
			$contracts = $this->dataQuery($querString);

			//echo($contracts);

			//print_r($contracts);

			$users = new User();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){

			foreach ($contracts as $contract) {
				$id = $contract['staff_id'];
				
				$user = $users->find($id);
				$userName = $user['name'];
				$contact_no = $user['contact_no'];
				$contract['staff_name'] = $userName;
				$contract['contact_no'] = $contact_no;
				$allContract[] = $contract;

			}
		}
			return $allContract;
	}

	//staff

	public function getStaffContract($id)
	{
       		$querString = "SELECT * FROM `contract_details` WHERE staff_id = '$id' AND active = '1' AND staff_id IS NOT NULL AND payment_for_staff_monthly IS NOT NULL";

            require_once '../app/models/User.php';
			$contracts = $this->dataQuery($querString);

			//echo($contracts);

			//print_r($contracts);

			$users = new User();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){

			foreach ($contracts as $contract) {
				$id = $contract['client_id'];
				
				$user = $users->find($id);
				$userName = $user['name'];
				$contact_no = $user['contact_no'];
				$contract['client_name'] = $userName;
				$contract['contact_no'] = $contact_no;
				$allContract[] = $contract;

			}
		}
			return $allContract;
	}
///staff

	public function acceptContracRequest($contractsId)
	{
		$querString = "UPDATE `contract_details` SET `active` = '1' WHERE `contract_details`.`id` = $contractsId";
		return $this->booleanQuery($querString);
	}

	public function deleteContracRequest($id)
	{
		$querString = "UPDATE `contract_details` SET `staff_id` = NULL , `payment_for_staff_monthly` = NULL WHERE `contract_details`.`id` = $id";
		return $this->booleanQuery($querString);
	}


	public function getStaffContractRequest($id)
	{
		

		//echo ($myId);
		$querString = "SELECT * FROM `contract_details` WHERE staff_id = '$id' AND active ='0' AND payment_for_staff_monthly IS NOT NULL";

            require_once '../app/models/User.php';
			$contracts = $this->dataQuery($querString);

			//echo($contracts);

			//print_r($contracts);

			$users = new User();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){

			foreach ($contracts as $contract) {
				$id = $contract['client_id'];
				
				$user = $users->find($id);
				$userName = $user['name'];
				$contact_no = $user['contact_no'];
				$contract['client_name'] = $userName;
				$contract['contact_no'] = $contact_no;
				$allContract[] = $contract;

			}
		}
			return $allContract;
	}



///admin

	public function deleteContractRequest($id)
	{
		$querString = "DELETE FROM `contract_details` WHERE `contract_details`.`id` = '$id'";
		return $this->booleanQuery($querString);
	}

	public function getUserContract($id)
	{
		$querString = "SELECT * FROM `contract_details` WHERE `staff_id` = '$id' OR `client_id` = '$id' ";
		$contracts = $this->dataQuery($querString);

		if($contracts['0'] == NULL)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function sendContractRequest($contractsId,$monthlyPaymentForStaff,$Saffid)
	{
		$querString = "UPDATE `contract_details` SET `staff_id` = '$Saffid' , `payment_for_staff_monthly` = '$monthlyPaymentForStaff' WHERE `contract_details`.`id` = $contractsId";
		return $this->booleanQuery($querString);
	}

	public function deleteSendRequest($id)
	{
		$querString = "UPDATE `contract_details` SET `staff_id` = NULL , `payment_for_staff_monthly` = NULL WHERE `contract_details`.`id` = $id";
		return $this->booleanQuery($querString);
	}

	public function getContractRequest()
	{
		$querString = "SELECT * FROM `contract_details` WHERE active ='0' AND staff_id IS NULL AND payment_for_staff_monthly IS NULL";

            require_once '../app/models/User.php';
			$contracts = $this->dataQuery($querString);

			$users = new User();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){

			foreach ($contracts as $contract) {
				$id = $contract['client_id'];
				
				$user = $users->find($id);
				$userName = $user['name'];
				$contract['client_name'] = $userName;
				$allContract[] = $contract;

			}
		}
			return $allContract;

			//return $contracts;
			//print_r($contract);
	}
	public function getPendingContract()
	{
		$querString = "SELECT * FROM `contract_details` WHERE active ='0' AND staff_id IS NOT NULL AND payment_for_staff_monthly IS NOT NULL";

            require_once '../app/models/User.php';
			$contracts = $this->dataQuery($querString);

			$users = new User();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){
			foreach ($contracts as $contract) {
				$clientId = $contract['client_id'];
				$staffId = $contract['staff_id'];

				$user = $users->find($clientId);
				$userName = $user['name'];
				$contract['client_name'] = $userName;

			    $user = $users->find($staffId);
				$userName = $user['name'];
				$contract['staff_name'] = $userName;

				$allContract[] = $contract;

			}
		}
			return $allContract;

			//return $contracts;
			//print_r($contract);
	}

		public function getActiveContract()
	{
		$querString = "SELECT * FROM `contract_details` WHERE active ='1' AND staff_id IS NOT NULL AND payment_for_staff_monthly IS NOT NULL";

            require_once '../app/models/User.php';
            require_once '../app/models/Client_payments.php';
			$contracts = $this->dataQuery($querString);

			$users = new User();
			$Client_payments = new Client_payments();

			$allContract = [];

			//print_r($contracts);
			if($contracts['0'] != null){
			foreach ($contracts as $contract) {
				$clientId = $contract['client_id'];
				$staffId = $contract['staff_id'];

				$user = $users->find($clientId);
				$userName = $user['name'];
				$contract['client_name'] = $userName;

			    $user = $users->find($staffId);
				$userName = $user['name'];
				$contract['staff_name'] = $userName;
				$contractId = $contract['id'];
				$Clientpayments = $Client_payments->findUnapprovrByContract($contractId);

				if($Clientpayments['0'] == NULL)
				{
					$contract['receive'] = 0;
				}
				else
				{
					$contract['receive'] = 1;
				}

				$allContract[] = $contract;

			}
		}
			return $allContract;
	}


}


 ?>