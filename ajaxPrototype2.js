var sendBtn = document.getElementById("submit");
sendBtn.onclick = function() {
	
	var verifMail = document.getElementById("valMail").value;
	if(verifMail) {

		var pass2 = document.getElementById("pass2").value;
		var pass1 = document.getElementById("pass1").value;
		if(pass2 != "" && pass2 == pass1) {
			var passwToSend = pass2;
			pass2 = "";
			pass1 = "";
			var formSubm = document.getElementById("formSubm").value;
			//create XMLHTTP request obj:
			var htpReq2 = new XMLHttpRequest();
			//create a var to send to PHP file
			var url = "susPhp.php";
			htpReq2.open("POST", url, true);//true = asynchr
			htpReq2.setRequestHeader("content-type", "application/x-www-form-urlencoded");

			htpReq2.onreadystatechange = function() {

				if(htpReq2.readyState == 4 && htpReq2.status == 200) {
					//var returned_data = htpReq.responseText;					
					status.innerHTML = htpReq2.responseText;
				}
			};
			var send2Sus = "daPassw=" + passwToSend + "&daMail=" + verifMail + "&daFormSubm=" + formSubm;
			console.log(send2Sus);
			//now sending the data to phpFile and wait for respons to update the status span
			htpReq2.send(send2Sus);
			
		} //end of if pass1 pass2
	}
	statusField.innerHTML = "";
	document.getElementById('ajaxStatus').innerHTML = "";
	statusField.innerHTML = "<br /> Check your email for a verification!!!";
	
	console.log('button click!!');

}; //end if verif mail