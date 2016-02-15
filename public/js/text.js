 	
$(document).ready(function(){

	$('#myModal').on('shown.bs.modal', function () {
  		$('#myInput').focus()
	});

	$.ajaxSetup({
	        headers : {
	            'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
	        }
	    });

 	document.getElementById('text-div').style.display = "none";
 	document.getElementById('login').style.display = "none";



	$( "#text" ).focus(function() {
	    document.getElementById('text-div').style.display = 'block';
	   
	});



	$('#show-login').click(function(){
		document.getElementById('login').style.display = 'block';
	});



	$('button.up').click(function(event){ 
			var pom = $(event.target);
			var url =  window.location.pathname;
			var id =  pom.get(0).id;
				$.ajax({
		     		 url: url+'/comments/plus',
		     		 type: "get",
		     		 data: {'id': id},
		     		 success: function(data){
		     		 
		     		 	

		      		   document.getElementById(pom.get(0).id).innerHTML =  data ;
		     		 	
		     		 }
		    });      

			
		    
		  }); 

	$('button.down').click(function(event){ 
			var pom = $(event.target);
			var url =  window.location.pathname;
			var id =  pom.get(0).id;
				$.ajax({
		     		 url: url+'/comments/minus',
		     		 type: "get",
		     		 data: {'id': id},
		     		 success: function(data){
		     		 
		     		 	

		      		   document.getElementById(pom.get(0).id).innerHTML =  data ;
		     		 	
		     		 }
		    });      

			
		    
		  }); 

	$('button.send').click(function(){
		var url =  window.location.pathname;
		var text = $("#text").val();

		if(text.length >1 && text.length < 255){
			$.ajax({
		     		 url: url+'/comments',
		     		 type: "post",
		     		 data: {'text_id': $("input[name=text_id]").val(), 'potpis' : $("input[name=potpis]").val(), 'text' : $("#text").val() },
		     		 success: function(data){
		     		 
		     		 	if(data.success ){
		     		 		document.getElementById('text').value = null;
		     		 		document.getElementById('potpis').value = null; 
		     		 	 	
		     		 	}else{
		     		 		document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \">" + data.messages + "</p>"; 
		     		 	}

		      		  
		     		 	
		     		 }
            });
		}else{
			document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \"> Komentar mora biti velicine izmedju 1 i 255 karaktera</p>"; 
		}	
	});

	var id_kom = null;

	$('button.m_m').click(function(event){
		var pom = $(event.target);
		var id =  pom.get(0).id;
		document.getElementById('modal_comments').innerHTML = "<input type=\"hidden\" id=\"comments_id\" value="+id+">"


	});

	$('button.modal_send').click(function(){
		var id = $("#comments_id").val();
		var text = $("#modal_text").val();
		var potpis = $("#modal_potpis").val();
		alert(id);
		// var url =  window.location.pathname;
		// var text = $("#text").val();

		// if(text.length >1 && text.length < 255){
		// 	$.ajax({
		//      		 url: url+'/comments',
		//      		 type: "post",
		//      		 data: {'text_id': $("input[name=text_id]").val(), 'potpis' : $("input[name=potpis]").val(), 'text' : $("#text").val() },
		//      		 success: function(data){
		     		 
		//      		 	if(data.success ){
		//      		 		document.getElementById('text').value = null;
		//      		 		document.getElementById('potpis').value = null; 
		     		 	 	
		//      		 	}else{
		//      		 		document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \">" + data.messages + "</p>"; 
		//      		 	}

		      		  
		     		 	
		//      		 }
  //           });
		// }else{
		// 	document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \"> Komentar mora biti velicine izmedju 1 i 255 karaktera</p>"; 
		// }	
	});

});

