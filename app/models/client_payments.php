<?php

require_once '../app/core/Model.php';

/**
* Ryhan Ahmed Tamim
*/
class Client_payments extends Model
{

	public function sendPaymentByClient($databaseName,$contractId,$paymentSerial,$amount,$paymentDate)
	{
		$querString = "INSERT INTO `client_payments` (`id`, `contract_id`, `payment_serial`, `amount_paid`, `date`, `approved_by_manager`) VALUES (NULL, '$contractId', '$paymentSerial', '$amount', '$paymentDate', '0')";


		return $this->booleanQuery($databaseName,$querString);
	}

	public function findByContract($databaseName,$contractId)
	{
		$querString = "SELECT * FROM `client_payments` WHERE `client_payments`.`contract_id` = '$contractId' ";
		return $this->dataQuery($databaseName,$querString);
	}

	public function findUnapprovrByContract($databaseName,$contractId)
	{
		$querString = "SELECT * FROM `client_payments` WHERE `client_payments`.`contract_id` = '$contractId' AND `client_payments`.`approved_by_manager` = '0' ";
		return $this->dataQuery($databaseName,$querString);	
	}

	public function receivedPayment($databaseName,$id)
	{
		$querString = "UPDATE `client_payments` SET `approved_by_manager` = '1'  WHERE `client_payments`.`id` = '$id'";
		return $this->booleanQuery($databaseName,$querString);
	}
	
}
?>