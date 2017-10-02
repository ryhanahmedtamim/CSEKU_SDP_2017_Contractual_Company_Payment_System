<?php
  
  class Model 
  {


  	public function mainDatabesQuery($database, $querString)
  	{
  		$result = mysqli_query($database,$querString);

		if (mysqli_num_rows($result)>0) 
			{
				while ($r = mysqli_fetch_assoc($result)) 
				{		
						$data = $r;	
				}					
			}
			else
			{
				$data = NULL;
			}
      return $data;
  	}

  
  public  function singleDataQuery($databaseName,$querString)
   {
   	


   //	$databaseName = $_SESSION['database'];
   	$user = $_SESSION['usercompany'];
   	$dbpassword = $_SESSION['password'];
   	
   	$connection = getDatabase($user,$dbpassword,$databaseName);

   	//echo($connection);
      $result = mysqli_query($connection,$querString);

		if (mysqli_num_rows($result)>0) 
			{
				while ($r = mysqli_fetch_assoc($result)) 
				{		
						$data = $r;
						
				}					
			}
			else
			{
				$data = NULL;
			}
      return $data;
	}
   

   public function dataQuery($databaseName,$querString)
   {
   	
   	//echo $querString;
   	$user = $_SESSION['usercompany'];
   	$dbpassword = $_SESSION['password'];
   	
   	$connection = getDatabase($user,$dbpassword,$databaseName);

      $result = mysqli_query($connection,$querString);

		if (mysqli_num_rows($result)>0) 
			{
				while ($r = mysqli_fetch_assoc($result)) 
				{		
						$data[] = $r;
						//print_r($data);
				}					
			}
			else
			{
				$data[] = NULL;
				
			}
			mysqli_close($connection);
      return $data;
	}

	function booleanQuery($databaseName,$queryString)
	{
		$user = $_SESSION['usercompany'];
   	    $dbpassword = $_SESSION['password'];
   	
        $connection = getDatabase($user,$dbpassword,$databaseName);

		if (mysqli_query($connection, $queryString)) 
		{
         return true;
        } 
        else 
        {
         return false;  
        }

         mysqli_close($connection);
	}
}

?>