window.onload = function(){
	//lets grab the html inputfield email and put into a variable
	var mailField = document.getElementById("email");

	mailField.onfocus = function(){
		
		if(mailField.value == "Enter email"){
			mailField.value="";
			mailField.style.color="black";
		}
	}
}