
	//lets grab the html inputfield email and put into a variable
	var mailField = document.getElementById("email");
	mailField.onblur = function CheckUserName() {
		//Mail status is the fiels where we send the msg
		var status = document.getElementById("ajaxStatus");
		var mailValue = document.getElementById("email").value;
		if(mailValue != "" && mailValue != "Enter email") {
			//create XMLHTTP request obj:
			var htpReq = new XMLHttpRequest();
			//create a var to send to PHP file
			var url = "testPhp1.php";
			htpReq.open("POST", url , true);//true = asynchr
			htpReq.setRequestHeader("content-type", "application/x-www-form-urlencoded");

			htpReq.onreadystatechange = function() {

				if(htpReq.readyState == 4 && htpReq.status == 200) {
					//var returned_data = htpReq.responseText;
					status.innerHTML = htpReq.responseText;
				}
			};
			var SendValue = "mail2check=" + mailValue;
			//now sending the data to phpFile and wait for respons to update the status span
			htpReq.send(SendValue);

		} //end of if
	};
