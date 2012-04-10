var ajxMailCheck = function (file, value1){
	var htpReq = new XMLHttpRequest();
		htpReq.open("POST",file, true); //true = asynchr
		htpReq.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		htpReq.onreadystatechange = function(){
			if(htpReq.readyState == 4 && htpReq.status == 200){
				//var returned_data = htpReq.responseText;
				status.innerHTML = htpReq.responseText;
			}
		}
	var SendValue = "mail2check="+value1;
	//now sending the data to phpFile and wait for respons to update the status span
	htpReq.send(SendValue); //executing the request!!
	
};
			