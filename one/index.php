
<?php 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

session_start();
require_once '../app/init.php';
//require_once '../app/config/database.php';

$url = "one.nrcompany.com";

if(!(isset($_SESSION['database'])))
{
  $mainDatabaseConnection = getDatabase("root","1234","csekua5_agent");
  $querString = "SELECT * FROM `user_info` WHERE domain_name = '$url'";

  $model = new Model();

  $data = $model->mainDatabesQuery($mainDatabaseConnection,$querString);

  //print_r($data);

    $_SESSION['database'] = $data['database_name'];
    $_SESSION['company'] = $data['company_name'];
    $_SESSION['usercompany'] = $data['username'];
    $_SESSION['password'] = $data['password'];
  

}

    $databseName = array($_SESSION['database'],$url);


  $app = new App($databseName);


?>