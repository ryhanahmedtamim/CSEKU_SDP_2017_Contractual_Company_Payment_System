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

	public function find($id)
	{
		$querString = "SELECT * FROM `users` WHERE id = '$id'";
		$user = $this->singleDataQuery($querString);
		//echo($id);
		return $user;
	}



	//admin
	public function getAllUserRequest()
	{
            $querString = "SELECT * FROM `users` WHERE approve='0' AND rolename != 'admin'";
			$users = $this->dataQuery($querString);
			return $users;
	}

	public function getAllUser()
	{	
			$querString = "SELECT * FROM `users` WHERE approve='1' AND rolename != 'admin'";
			$users = $this->dataQuery($querString);
			return $users;

	}

	public function acceptUserRequest($id)
	{
		$querString = "UPDATE `users` SET `approve` = '1' WHERE `users`.`id` = $id";
		return $this->booleanQuery($querString);
	}
	public function deleteUserRequest($id)
	{
		$querString = "DELETE FROM `users` WHERE `users`.`id` = '$id'";
		return $this->booleanQuery($querString);
	}

	public function deleteUser($id)
	{
		require_once '../app/models/Contract_details.php';
		$contract_details = new Contract_details();
		$result = $contract_details->getUserContract($id);

		if ($result == true)
		{
			$querString = "DELETE FROM `users` WHERE `users`.`id` = '$id'";
		     return $this->booleanQuery($querString);
		}
		else
		{
			return false;
		}
	}

	public function disableUser($id)
	{
		require_once '../app/models/Contract_details.php';
		 $contract_details = new Contract_details();
		$result = $contract_details->getUserContract($id);

      //echo($result);

		if ($result == true)
		{
			$querString = "UPDATE `users` SET `approve` = '0' WHERE `users`.`id` = $id";
		   return $this->booleanQuery($querString);  
		}
		else
		{
			return false;
		}
	}

	// admin end

	public function registerUser($Name , $userName, $email, $phoneNumbe, $address,$userType,$password)
	{
        $querString = "INSERT INTO `users` (`id`, `name`, `username`, `email`, `contact_no`, `rolename`, `address`, `password`, `approve`) VALUES (NULL, '$Name', '$userName', '$email', '$phoneNumbe', '$userType', '$address', '$password', '0')" ;
        return $this->booleanQuery($querString); 
	}

	public function loginUser($userName,$password)
	{
		$querString = "SELECT * FROM `users` WHERE username = '$userName' AND password = '$password'";
		$user = $this->dataQuery($querString);
		//session_start();

		if($user['0'] != NULL)
		{
			//echo($user['0']['approve']);
			if($user['0']['approve'] == 1){
			$_SESSION['userName'] = $user['0']['username'];
			$_SESSION['name'] = $user['0']['name'];
			$_SESSION['rolename'] = $user['0']['rolename'];
			$_SESSION['id'] = $user['0']['id'];
			$_SESSION['login'] = 1;

			return "true";
			}
			else
			{
				return "Your Request Is Pending";
			}		

		}
		else
		{
			return "false";
		}
	}

}


 ?>