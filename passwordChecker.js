var statusField = document.getElementById("mailStatus");
var pass1 = document.getElementById("pass1");
var pass2 = document.getElementById("pass2");

pass2.onblur = function CheckUserName() {

	if(pass1.value == pass2.value) {
		statusField.innerHTML = "<br /> verified";
	} else
		statusField.innerHTML = "<br /> check again to make sure pass1 and pass2 match";
};

mailField.onfocus = function() {

	if(mailField.value == "Enter email") {
		mailField.value = "";
		mailField.style.color = "black";
	}
};