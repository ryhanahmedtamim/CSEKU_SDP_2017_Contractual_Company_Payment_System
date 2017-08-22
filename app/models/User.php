<?php 
session_start();


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

	function getAllUser()
	{	
			
	}

	function registerUser($Name , $userName, $email, $phoneNumbe, $address,$userType,$password)
	{
        $querString = "INSERT INTO `users` (`id`, `name`, `username`, `email`, `contact_no`, `rolename`, `address`, `password`, `approve`) VALUES (NULL, '$Name', '$userName', '$email', '$phoneNumbe', '$userType', '$address', '$password', '0')" ;
        return $this->booleanQuery($querString); 
	}

	function loginUser($userName,$password)
	{
		$querString = "SELECT * FROM `users` WHERE username = '$userName' AND password = '$password' AND approve='1'";
		$user = $this->dataQuery($querString);
		//session_start();

		if($user['0'] != NULL)
		{
			if($user['0']['approve'] == 1){
			$_SESSION['userName'] = $user['0']['username'];
			$_SESSION['rolename'] = $user['0']['rolename'];
			$_SESSION['id'] = $user['0']['id'];
			$_SESSION['login'] = 1;

			return true;
			}		

		}
		else
		{
			return false;
		}
	}

}


 ?>