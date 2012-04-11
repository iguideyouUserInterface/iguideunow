<?php 
	//require_once 'testconect.php';
	require_once 'databaseconnect.php';

	$newMail = ($_POST["mail2check"]);

	// a check to see if the mail-field is set
	if (isset($newMail) && $newMail != ""){ // if so:
	//a function to where we send the entered mail and check if its a valid mailAdr
	 	function isValidEmail($email){
			return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);	
		}
		if(isValidEmail($newMail)==TRUE){
			$validMail = mysql_real_escape_string(strip_tags(stripslashes($newMail)));
			$newMail = "";
			//validMail innehåller valid mail!
			$sqlMailCheck = mysql_query("SELECT id FROM users WHERE email = '$validMail'");
			$mailCheck = mysql_num_rows($sqlMailCheck);
		
			if($mailCheck == 0 ){
				echo $validMail . 'free';
				?>
				<input type="hidden" name="valMail" id="valMail" value="<?php echo $validMail; ?>" />
				<?php
				//exit();
			}
			else{
				echo "The mailadress is already in use. Please choose another one."; 
				exit();
			};	
		
		}
		else{
			echo "the entered mail is not a valid one";
		}

		//mysql_close($dbConnetion);
	}

?>

<?php

session_start();

?>
