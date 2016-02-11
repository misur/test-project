 @extends('layout.master')

  @section('title')
  Forgot password
@stop

 @section('header')
	<div class="page-header">
        <h1>Zaboravio sam lozinku</h1>
      </div>
@stop

 @section('content')
	

          <pre>Ako zaboravite lozinku koja se odnosi na vaš nalog , možete brzo i bezbedno <br> dobiti novu.Možete izabrati neki od sledećih načina za kreiranje nove lozinke:</pre>
         

            @if (count($errors) > 0)  
		          <div class="alert alert-danger">
		            
		            <ul>
		              @foreach ($errors->all() as $error)
		              <li>{{ $error }}</li>
		              @endforeach
		            </ul>
		          </div>
		          @endif





           {!! Form::open(array('url'=>'home/send')) !!}
          <table class="table">
              <tr>
                <td><strong>Email</strong></td>
                <td>
                {{-- <input type="text" name="email" id= "email" >

                {!!Form::text('email', null, array( 'id' => 'email' , 'class' => 'form-control' , 'placeholder' => 'Email'))!!} --}}

               
			<div class="control-group">
			  <div class="controls">


			     {!! Form::text('email','',array('id'=>'email','class'=>'form-control')) !!}
			  </div>
			</div>
			
			

                </td>
                <td> <div id="email-div">Please insert email</div></td>
              </tr>

              <tr>
                <td><input type="checkbox">Zapamti me</td>
                <td> <input type="submit" value="Posalji">  </td>
                <td></td>
              </tr>
             
              


          </table>
          {!! Form::close() !!}

          


			 
			

         


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script>

	$.ajaxSetup({
	        headers : {
	            'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
	        }
	    });

	document.getElementById('email-div').style.visibility = 'hidden';

	$( "#email" ).focus(function() {
	    document.getElementById('email-div').style.visibility = 'visible';
	    
	   
	});
	
	$(document).ready(function(){
		// $('#getRequest').click(function(){
		// 	$.get('test', function(data){
		// 			var e = $('#email').val();
		// 		 $('#getRequestData').append(e);
				
		// 	});
		// });
		$('#email-div').click(function(){
			document.getElementById('email-div').style.visibility = 'hidden';
		});


		// $('.send-btn').click(function(){    
		// 	var e = $('#email').val();

		// 	if(e.length === 0){
		// 		document.getElementById('email-div').style.visibility = 'visible';
		// 	}else{
		// 		$.ajax({
		//      		 url: 'send',
		//      		 type: "post",
		//      		 data: {'email':$('input[name=email]').val(), '_token': $('input[name=_token]').val()},
		//      		 success: function(data){
		      		  

		//         	// window.location.href = "http://localhost/test-project/public/login";
		//      		 }
		//     });      

		// 	}
		    
		//   }); 

		
	});



</script>
          	
@stop

