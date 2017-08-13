<?php 

/**
* 
*/
require_once '../app/core/Model.php';
class User extends Model
{
	
    

	function __construct()
	{
		
		//$db = mysqli_query($query,$db);
	}

	function get(){
	$queryString = "SELECT * FROM users";
		
		print_r( $this->query($queryString));
}

}


 ?>