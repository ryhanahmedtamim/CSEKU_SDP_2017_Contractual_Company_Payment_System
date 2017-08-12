<?php
  
  $host = "localhost";
  $user = "root";
  $passwor = "";
  $databseName = "ccps";

  function dataBaseName($name)
  {
     $databseName = $name;
  }
   
   // Create connection
  $connection = mysqli_connect($host,$user,$passwor); 

   //check the connection
  if ($connection->connect_error)
   {
    die("Connection failed: " . $connection->connect_error);
   } 

   function getDatabase()
   {
   	 $database = mysqli_selec_db($databseName,$connection);
   	 return $database;
   }

  $connection->close();
?>