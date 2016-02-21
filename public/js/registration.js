	document.getElementById('email-div').style.display = "none";
	document.getElementById('pass-div').style.display = "none";
	document.getElementById('repass-div').style.display = "none";

	$(document).ready(function(){

	$( "#email" ).focus(function() {
	    document.getElementById('email-div').style.display = 'block';
	    document.getElementById('pass-div').style.display = "none";
	    document.getElementById('repass-div').style.display = "none";
	});

	$( "#password" ).focus(function() {
	    document.getElementById('email-div').style.display = "none";
	    document.getElementById('pass-div').style.display = 'block';
	    document.getElementById('repass-div').style.display = "none";
	});

	$( "#repassword" ).focus(function() {
	    document.getElementById('email-div').style.display = "none";
	    document.getElementById('pass-div').style.display = "none";
	    document.getElementById('repass-div').style.display = 'block';
	});

	$('#email-div').click(function(){
		document.getElementById('email-div').style.display = "none";
	});

	$('#pass-div').click(function(){
		document.getElementById('pass-div').style.display = "none";
	});

	$('#repass-div').click(function(){
		document.getElementById('repass-div').style.display = "none";
	});
});