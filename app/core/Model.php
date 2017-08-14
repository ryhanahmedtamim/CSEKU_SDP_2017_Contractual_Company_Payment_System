<?php
  
  class Model 
  {

  

   

   function dataQuery($querString)
   {
   	
   	//echo $querString;
   	require_once '../app/config/database.php';
      $result = mysqli_query($connection,$querString);

		if (mysqli_num_rows($result)>0) 
			{
				while ($r = mysqli_fetch_assoc($result)) 
				{		
						$data[] = $r;
						print_r($data);
				}					
			}
			else
			{
				$data[] = NULL;
				
			}
      return $data;
	}

	function booleanQuery($queryString)
	{
		require_once '../app/config/database.php';

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