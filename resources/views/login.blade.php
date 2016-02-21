 @extends('layout.master')


 @section('title')
  Log in
@stop


 @section('header')
  <div class="container">
      <div class="page-header">
        <h1>Login</h1>
      </div>
@stop

 @section('content')
  

          <pre>Niste se registrovali? <a href="/test-project/public/users/create"><p class="text-danger">Registruj se.</p></a></pre>


            @if (count($errors) > 0)  
          <div class="alert alert-danger">
            
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form method="POST" action="login" >

          
          <table class="table">
              <tr>
                <td><strong>Vaša email adresa:</strong></td>
                <td><input type="text" name="email" id= "email" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."></td>
                <td id="email-err" class="alert alert-danger" role="alert"> Unesi email adersu!</td>
                <td></td>
              </tr>

              <tr>
                <td><strong>Lozinka:</strong></td>
                <td><input type="password" id="password" name="password"></td>
                <td id="password-err" class="alert alert-danger" role="alert"> Unesi validnu lozinku!</td>
                <td></td>
              </tr>
              <tr>
                <td><input type="checkbox">Zapamti me</td>
                <td> <td><input type="submit" value="prijavi se"> </td></td>
                <td></td>
              </tr>
             
              


          </table>

          </form>

          <pre><a href="forgotpass"><p class="text-danger"> Zaboravio sam lozinku </p></a><br><a href="/test-project/public/users/create"><p class="text-danger"> Registruj se.</p></a></pre>


          


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! Html::script('js/login.js')!!}

@stop