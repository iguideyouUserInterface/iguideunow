<?php
//database configuration
$db_host ="localhost" ; 
$db_name = "userDb"; 
$db_usr = "testuser"; 
$db_pass = "123";

//Establish a connection with MySQL and select the database to use
mysql_connect($db_host, $db_usr, $db_pass) or die("MySQL Error: " . mysql_error());
mysql_select_db($db_name) or die("MySQL Error: " . mysql_error());
?>