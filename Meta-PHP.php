<?php
session_start();

include("DataBase.php");
$dbservername = "127.0.0.1";
/*
$dbname = "mybudgetdb";
$dbusername = "root";
$dbpassword = "root";
*/
$dbusername = "iaymanprojects";
$dbpassword = "Carlo11Carlo";
$dbname = "iaymanpr_mybudget";

$conn = db_connect($dbservername,$dbusername,$dbpassword,$dbname);

date_default_timezone_set("Africa/Cairo");

function redirect ($location)
{
  $URL = $location;
  echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  /*
  header("Location: $location");
  */
}
?>