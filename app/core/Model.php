<?php
  
  class Model 
  {

  
  public  function singleDataQuery($databaseName,$querString)
   {
   	
   	//echo $querString;
   	require_once '../app/config/database.php';
   	$connection = getDatabase($databaseName);

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
   	require_once '../app/config/database.php';
   	$connection = getDatabase($databaseName);
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
		require_once '../app/config/database.php';

		$connection = getDatabase($databaseName);

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