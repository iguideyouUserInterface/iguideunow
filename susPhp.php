<?php
require_once 'testconect.php';
	
$daPassw = ($_POST["daPassw"]);
$daMail = ($_POST["daMail"]);
$daFormSub = ($_POST["daFormSubm"]);
//echo 'damail'. $daMail;
			
if ($daFormSub == '1') {
	//echo 'if daformsub == 1';
	if (!empty($daMail) && !empty($daPassw)) {
		//echo 'if not damail and no dapass';
		$activationKey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
		$email = mysql_real_escape_string(strip_tags(stripslashes($daMail)));
		$password = mysql_real_escape_string(strip_tags(stripslashes($daPassw)));

		// generate strong unique salt
		$salt = uniqid(mt_rand());

		//combine email, password, and salt together
		$combine = $password . $salt . $password;

		//hash everything
		$newpassword = sha1($combine);

		$query = "SELECT * FROM users WHERE email = '$email'";

		$data = mysql_query($query);
		if (mysql_num_rows($data) == 0) {
			echo 'the email to be sent to db: '. $email;
			$query = "INSERT INTO users
            (password, email, usersalt, date, activationkey, status)
             VALUES
            ('$newpassword', '$email', '$salt', NOW(), '$activationKey', 'verify')";
			
		} else {// An account already exists for this username, so display an error message
			echo '<p class="error">An account already exists for this email. Please use a different ' . 'address.</p>';

			$email = "";
		}

		if (mysql_query($query)) {
			##Send activation Email
			$to = $daMail;
			$subject = " iguideunow.com Registration";

			$message = "Welcome to our website!\r\rYou, or someone using your email address, has completed registration at iguideu.com. 
		You can complete registration by clicking the following link:\rhttp://alvacora.com/iguideunow/activation.php?$activationKey\r\r
		If this is an error, ignore this email and you will be removed from our mailing list.\r\rRegards,\ iguideu.com Team";

			$headers = 'From: info@iguideunow.com' . "\r\n" . 'Reply-To: noreply@ iguideunow.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			if (mail($to, $subject, $message, $headers)) {
				//echo '<h3>Mail skickat</h3>';
				echo "An email has been sent to $to with an activation key. Please check your mail to complete registration.";

			} else {
				echo '<h3>Email not sent</h3>';
			}
			//mail($to, $subject, $message);			
		} else {
			echo 'fail';
		}
	} 
} 	
?>