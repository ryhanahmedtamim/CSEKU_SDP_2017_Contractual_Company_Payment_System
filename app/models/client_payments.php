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
	
}
?>