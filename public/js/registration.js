	document.getElementById('email-div').style.visibility = 'hidden';
	document.getElementById('pass-div').style.visibility = 'hidden';
	document.getElementById('repass-div').style.visibility = 'hidden';

	$(document).ready(function(){

	$( "#email" ).focus(function() {
	    document.getElementById('email-div').style.visibility = 'visible';
	    document.getElementById('pass-div').style.visibility = 'hidden';
	    document.getElementById('repass-div').style.visibility = 'hidden';
	});

	$( "#password" ).focus(function() {
	    document.getElementById('email-div').style.visibility = 'hidden';
	    document.getElementById('pass-div').style.visibility = 'visible';
	    document.getElementById('repass-div').style.visibility = 'hidden';
	});

	$( "#repassword" ).focus(function() {
	    document.getElementById('email-div').style.visibility = 'hidden';
	    document.getElementById('pass-div').style.visibility = 'hidden';
	    document.getElementById('repass-div').style.visibility = 'visible';
	});

	$('#email-div').click(function(){
		document.getElementById('email-div').style.visibility = 'hidden';
	});

	$('#pass-div').click(function(){
		document.getElementById('pass-div').style.visibility = 'hidden';
	});

	$('#repass-div').click(function(){
		document.getElementById('repass-div').style.visibility = 'hidden';
	});
});