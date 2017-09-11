<?php

require_once '../app/core/Model.php';

/**
* Ryhan Ahmed Tamim
*/
class Client_payments extends Model
{

	public function sendPaymentByClient($contractId,$paymentSerial,$amount,$paymentDate)
	{
		$querString = "INSERT INTO `client_payments` (`id`, `contract_id`, `payment_serial`, `amount_paid`, `date`, `approved_by_manager`) VALUES (NULL, '$contractId', '$paymentSerial', '$amount', '$paymentDate', '0')";

		return $this->booleanQuery($querString);
	}

	public function findByContract($contractId)
	{
		$querString = "SELECT * FROM `client_payments` WHERE `client_payments`.`contract_id` = '$contractId' ";
		return $this->dataQuery($querString);
	}

	public function findUnapprovrByContract($contractId)
	{
		$querString = "SELECT * FROM `client_payments` WHERE `client_payments`.`contract_id` = '$contractId' AND `client_payments`.`approved_by_manager` = '0' ";
		return $this->dataQuery($querString);	
	}

	public function receivedPayment($id)
	{
		$querString = "UPDATE `client_payments` SET `approved_by_manager` = '1'  WHERE `client_payments`.`id` = '$id'";
		return $this->booleanQuery($querString);
	}
	
}
?>