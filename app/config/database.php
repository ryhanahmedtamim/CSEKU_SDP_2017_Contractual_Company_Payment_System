<?php
   

   function getDatabase($databseName)
   {
      $host = "localhost";
      $user = "root";
      $passwor = "";
      $connection = mysqli_connect($host,$user,$passwor,$databseName); 

       if ($connection->connect_error)
        {
          die("Connection failed: " . $connection->connect_error);
        }
        else
        {
          return $connection;
        } 

   }
  

 
?>