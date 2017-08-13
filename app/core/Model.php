<?php
  
  class Model 
  {

  

   

   function query($querString)
   {
   	require_once '../app/config/database.php';
   	//echo $querString;
      $result = mysqli_query($connection,$querString);

		if (mysqli_num_rows($result)>0) 
			{
				while ($r = mysqli_fetch_assoc($result)) {

						//$row = mysqli_fetch_assoc($);
						

						
						$data[] = $r;
					

					}

					
			}
			else
			{
				$data[] = "ERROR";
				
			}

			      return $data;
	}
}

?>