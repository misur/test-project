 @extends('layout.master')

  @section('title')
  Reset password
@stop

 @section('header')
	<div class="page-header">
        <h1>Reset password</h1>
      </div>
@stop

 @section('content')
	

          
           <script src='https://www.google.com/recaptcha/api.js'></script>

            @if (count($errors) > 0)  
		          <div class="alert alert-danger">
		            
		            <ul>
		              @foreach ($errors->all() as $error)
		              <li>{{ $error }}</li>
		              @endforeach
		            </ul>
		          </div>
		          @endif




{!!Form::open(array('url' => '#'))!!}
          <table class="table">
            

              <tr>
                <td><strong>Lozinka:</strong></td>
                <td><input type="password" name="password" id="password">*</td>
                <td> <div  id= "pass-div"><p class="bg-danger">Unesite password veci od 6 karaktera</p></div></td>
              </tr>

              <tr>
                <td><strong>Ponovite lozinku:</strong></td>
                <td><input type="password" name="repassword" id="repassword">*</td>
                <td> <div  id= "repass-div"><p class="bg-danger">Ponovi password</p></div></td>
              </tr>
              <tr>
                <td><strong>Dokaz da  niste robot:</strong></td>
                <td>
                 <div class="g-recaptcha" data-sitekey="6LdgVRcTAAAAAOURqXVZMYzVqAbARqgvLdmaLzBa"></div>

                </td>
                <td>
                </td>
              </tr>
              
              <tr>
                <td><input type="submit" value="OK"> </td>
                <td></td>
                <td>

                

                </td>
              </tr>


          </table>
          {!!Form::close()!!}
          


			 
			

         


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script>

	$.ajaxSetup({
	        headers : {
	            'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
	        }
	    });

	document.getElementById('pass-div').style.visibility = 'hidden';
	document.getElementById('repass-div').style.visibility = 'hidden';

	
	
	$(document).ready(function(){
			




	$( "#password" ).focus(function() {
	    
	    document.getElementById('pass-div').style.visibility = 'visible';
	    document.getElementById('repass-div').style.visibility = 'hidden';
	});

	$( "#repassword" ).focus(function() {
	  
	    document.getElementById('pass-div').style.visibility = 'hidden';
	    document.getElementById('repass-div').style.visibility = 'visible';
	});


	$('#pass-div').click(function(){
		document.getElementById('pass-div').style.visibility = 'hidden';
	});

	$('#repass-div').click(function(){
		document.getElementById('repass-div').style.visibility = 'hidden';
	});
});

		
	



</script>
          	
@stop

