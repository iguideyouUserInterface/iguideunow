<?php

//$dbHost = "mysql182.loopia.se";
//$dbName = "alvacora_com";
//$dbUser = "su@a27265";
//$dbUserPassw = "susu33054123";

$dbHost = "localhost";
$dbName = "userDb";
$dbUser = "testuser	";
$dbUserPassw = "123";
$dbConnetion = mysql_connect($dbHost,$dbUser,$dbUserPassw);

if (!$dbConnetion)
  {
  die('Could not connect: ' . mysql_error());
  }
  
mysql_select_db($dbName) or die("MYSQL Error : " . mysql_error());

?>