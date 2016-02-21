

	document.getElementById('email-err').style.display = "none";
	document.getElementById('password-err').style.display = "none";

	$(document).ready(function(){

	$( "#email" ).focus(function() {
		 $('[data-toggle="popover" data-placement="right"]').popover();
	    document.getElementById('email-err').style.display = 'block';
	    document.getElementById('password-err').style.display = "none";
	});

	$( "#password" ).focus(function() {
	   document.getElementById('email-err').style.display = "none";
	    document.getElementById('password-err').style.display = 'block';
	});

	

	$('#email-err').click(function(){
		document.getElementById('email-err').style.display = "none";;
	});

	$('#password-err').click(function(){
		document.getElementById('password-err').style.display = "none";
	});

	
});