
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
		$querString = "SELECT * FROM `staff_duty` WHERE `staff_duty`.`contract_id` = '$contractId' ORDER BY ID DESC LIMIT 1 ";
		return $this->dataQuery($databaseName,$querString);
	}

	
}
