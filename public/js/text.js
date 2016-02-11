 	
$(document).ready(function(){

 	document.getElementById('text-div').style.visibility = 'hidden';
 	document.getElementById('login').style.visibility = 'hidden';



	$( "#text" ).focus(function() {
	    document.getElementById('text-div').style.visibility = 'visible';
	   
	});



	$('#show-login').click(function(){
		document.getElementById('login').style.visibility = 'visible';
	});

// 	$('#pass-div').click(function(){
// 		document.getElementById('pass-div').style.visibility = 'hidden';
// 	});

// 	$('#repass-div').click(function(){
// 		document.getElementById('repass-div').style.visibility = 'hidden';
// 	});
});

