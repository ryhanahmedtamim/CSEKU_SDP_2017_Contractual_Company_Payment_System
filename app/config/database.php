<?php
  
  $host = "localhost";
  $user = "root";
  $passwor = "";
  $databseName = "ccps";


   
   // Create connection
  $connection = mysqli_connect($host,$user,$passwor,$databseName); 

   //check the connection
  if ($connection->connect_error)
   {
    die("Connection failed: " . $connection->connect_error);
   } 

  

  //$connection->close();
?>