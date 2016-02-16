 	




$(document).ready(function(){
var url =  window.location.pathname;
$.ajax({ url: url+"/comments",
		type: "get",
		data: {'id': $("input[name=text_id]").val()},
        success: function(data){
            readComments(data);
           // alert(data.messages[1].text);
      	}
});

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


	$('button.send').click(function(){
		var url =  window.location.pathname;
		var text = $("#text").val();
		var potpis = $("#potpis").val();
		if(text.length >1 && text.length < 255){
			$.ajax({
		     		 url: url+'/comments',
		     		 type: "post",
		     		 data: {'text_id': $("input[name=text_id]").val(), 'potpis' : $("input[name=potpis]").val(), 'text' : $("#text").val() },
		     		 success: function(data){
		     		 
		     		 	if(data.success ){
		     		 		document.getElementById('text').value = null;
		     		 		if(typeof potpis !== 'undefined'){
		     		 			document.getElementById('potpis').value = ""; 
		     		 		}
		     		 		
		     		 		 readComments(data);



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
		alert('ok');
		return false;
		var id = $("#comments_id").val();
		var text = $("#modal_text").val();

		var potpis = $("#modal_potpis").val();
		var user_id = $("#modal_user_id").val();

		if(text.length >1 && text.length < 255){

			 if(typeof user_id === 'undefined' || user_id === null){
				
					if(potpis.length === 0){
						alert('bad');
					}else{
						alert('bad');
					}
				}else{
					alert('bad');
				}
				
		}

		
	});



});

 	function readComments(data){

		for (var i = 0; i < data.messages.length; i++) {
	
				var div = document.createElement('div');
				div.id = data.messages[i].id;
				div.className = 'row';
			    div.innerHTML ="<p class='text-danger'>"+data.messages[i].username + "</p>"+
			    "|"+data.messages[i].text + " <br>"+data.messages[i].created_at + " |minus <p id='"+data.messages[i].id + "_minus'> "+data.messages[i].minus + " </p>"+
			    " |plus <p id='"+data.messages[i].id + "_plus'> "+data.messages[i].plus + " </p>"+
			    "| Ocjena: <button type='button' id='"+data.messages[i].id + "'onclick='up(this.id)' class='btn btn-default up'><span class='glyphicon glyphicon-plus-sign'></span> </button>"+
			     " <button type='button' id='"+data.messages[i].id + "'onclick='down(id)' class='btn btn-default down'><span class='glyphicon glyphicon-minus-sign'></span></button>| "+
			     " <button type='button' class='btn btn-default m_m' id='"+data.messages[i].id + "' data-toggle='modal' data-target='#myModal'>Komentar</button>"+
				"|<a href=''>Prijavi</a>" +
            "<hr>";
 	            document.getElementById('comm').appendChild(div);

		}


 	}

 	

 	function sendRK(potpis,user_id){
			alert('ok 2 '+ potpis+' - ' + user_id);
	}

	function up(id){ 
			var url =  window.location.pathname;
		
				$.ajax({
		     		 url: url+'/comments/plus',
		     		 type: "get",
		     		 data: {'id': id},
		     		 success: function(data){
		     		 
		     		 	

		      		   document.getElementById(id+'_plus').innerHTML =  data ;
		     		 	
		     		 }
		    }); 	    
	}

	function down(id){
			var url =  window.location.pathname;
				$.ajax({
		     		 url: url+'/comments/minus',
		     		 type: "get",
		     		 data: {'id': id},
		     		 success: function(data){
		     		 
		     		 	

		      		   document.getElementById(id+'_minus').innerHTML =  data ;
		     		 	
		     		 }
		    });      	    
	}

	function sortLatest(){
		

		var url =  window.location.pathname;
		$.ajax({ url: url+"/comments/sortbyCreate",
				type: "get",
				data: {'id': $("input[name=text_id]").val()},
		        success: function(data){
		        	 
					$( "#comm" ).empty();
		           	readComments(data);
		      	}
		});
	}

	function sortPlus(){
		

		var url =  window.location.pathname;
		$.ajax({ url: url+"/comments/sortbyPlus",
				type: "get",
				data: {'id': $("input[name=text_id]").val()},
		        success: function(data){
		        	 
					$( "#comm" ).empty();
		           	readComments(data);
		      	}
		});
	}

	function sortMinus(){
		

		var url =  window.location.pathname;
		$.ajax({ url: url+"/comments/sortbyMinus",
				type: "get",
				data: {'id': $("input[name=text_id]").val()},
		        success: function(data){
		        	 
					$( "#comm" ).empty();
		           	readComments(data);
		      	}
		});
	}

