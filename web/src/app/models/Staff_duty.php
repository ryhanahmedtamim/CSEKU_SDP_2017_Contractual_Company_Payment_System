<?php

require_once '../app/core/Model.php';

/**
* Ryhan Ahmed Tamim
*/
class Staff_duty extends Model
{

	public function findAll($databaseName)
	{
        $querString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`paid` = '1' ";
		if(isset($_POST['filterStart'],$_POST['filterEnd']))
              {
              	$filterStart = $_POST['filterStart'];
              	$filterEnd = $_POST['filterEnd'];

              	$filterStart = str_replace('/', '-', $filterStart);
                $filterStart = strtotime($filterStart);
                $filterStart=date('Y-m-d', $filterStart);

                $filterEnd = str_replace('/', '-', $filterEnd);
                $filterEnd = strtotime($filterEnd);
                $filterEnd=date('Y-m-d', $filterEnd);

                $querString = "SELECT * FROM `staff_duty` WHERE  (`staff_duty`.`paid` = '1' AND `staff_duty`.`duty_date` BETWEEN '$filterStart' AND '$filterEnd') ";
              }
              

		
		return $this->dataQuery($databaseName,$querString);
	}

	public function findNextDuty($databaseName,$contractId)
	{
		$queryString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' ORDER BY ID DESC LIMIT 1 ";
		return $this->dataQuery($databaseName,$queryString);
	}

	public function submitDuty($database,$contractId,$dutyDate,$nextDate)
	{

		$queryString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' AND  `staff_duty`.`duty_date` = '$dutyDate'";

		$result = $this->singleDataQuery($database,$queryString);

		if($result == NULL)
		{
			$queryString = "INSERT INTO `staff_duty` (`id`, `contract_id`, `duty_date`, `next_date`, `approved_by_client`, `paid`, `payment_appove_by_staff`) VALUES (NULL, '$contractId', '$dutyDate', '$nextDate', '0', '0', '0');";
		return $this->booleanQuery($database,$queryString);
		}
		else
		{
			return false;
		}

		
	}

	public function pendingDuties($database,$contractId)
	{
		$queryString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' AND `staff_duty`.`approved_by_client` = '0'";
		return $this->dataQuery($database,$queryString);
	}

	public function approvedDuties($database,$contractId)
	{
		$queryString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' AND `staff_duty`.`approved_by_client` = '1'";
		return $this->dataQuery($database,$queryString);
	}

	public function paidDuties($database,$contractId)
	{
		$queryString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' AND `staff_duty`.`paid` = '1'";
		return $this->dataQuery($database,$queryString);
	}


	public function approveDuty($database,$Id)
	{
		$queryString =" UPDATE `staff_duty` SET `approved_by_client` = '1' WHERE `staff_duty`.`id` = '$Id';";
		return $this->booleanQuery($database,$queryString);
	}

	public function paymentReceivedBystaff($database,$id)
	{
		$queryString =" UPDATE `staff_duty` SET `payment_appove_by_staff` = '1' WHERE `staff_duty`.`id` = '$id';";
		
		return $this->booleanQuery($database,$queryString);
	}

	public function sendPayment($database,$dutyId)
	{
		$queryString =" UPDATE `staff_duty` SET `paid` = '1' WHERE `staff_duty`.`id` = '$dutyId';";
		return $this->booleanQuery($database,$queryString);
	}



	
}
