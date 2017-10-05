
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
		return $this->dataQuery($databaseName,$querString);
	}

	
}
