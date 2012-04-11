<?php
## No value found, user must be activating their account!
##User isn't registering, check verify code and change activation code to null, status to activated on success
require_once 'databaseconnect.php';

$queryString = $_SERVER['QUERY_STRING'];

$query = "SELECT * FROM users";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {

	if ($queryString == $row['activationkey']) {

		$sql = "UPDATE users SET activationkey = '', status='activated' WHERE (id = $row[id])";

		if (!mysql_query($sql)) {

			die('Error this is the error!!!!: ' . mysql_error());
		} else {
			//echo "Congratulations!" . $row["email"] . " you are now register"; // does not happen if header 
			//function occurs
			header("Location: http://10.1.15.114:8888/iguideunow/");
			
		}
	}
}

?>