@extends('layout.master')


 @section('title')
  Registration
@stop


 @section('header')
  <div class="container">
      <div class="page-header">
        <h1>Prijavi se</h1>
      </div>
@stop

 @section('content')
  

        <script src='https://www.google.com/recaptcha/api.js'></script>

          <pre>Otvaranje naloga će Vam omogućiti pristup naprednijim opcijama ovog servisa.</pre>


  @if (count($errors) > 0)  
          <div class="alert alert-danger">
            
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

         

          {!!Form::open(array('url' => 'users'))!!}
          <table class="table">
              <tr>
                <td><strong>Vaša email adresa:</strong></td>
                <td><input type="text" name="email" id= "email" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">*</td>
                <td> <div id= "email-div" class="alert alert-danger">Unesite postojecu email adressu..</div>


                </td>

              </tr>

              <tr>
                <td><strong>Lozinka:</strong></td>
                <td><input type="password" name="password" id="password">*</td>
                <td> <div  id= "pass-div" class="alert alert-danger">Unesite password veci od 6 karaktera</div></td>
              </tr>

              <tr>
                <td><strong>Ponovite lozinku:</strong></td>
                <td><input type="password" name="repassword" id="repassword">*</td>
                <td> <div  id= "repass-div" class="alert alert-danger">Ponovi password</div></td>
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
                <td>{{ Form::checkbox('agreement', 1, null) }}<strong>Potvrđujem sve od sledećih saglasnosti.</strong>*</td>
                <td></td>
                <td>

                </td>
              </tr>
              <tr>
                <td>  {{ Form::checkbox('condition', 1, null) }}<strong>Slažem se sa Uslovima korišćenja.</strong>*</td>
                <td>

                </td>
                <td>

                </td>
                
              </tr>
              <tr>
                <td><input type="submit" value="prijavi se"> </td>
                <td>* obavezna polja</td>
                <td>

                

                </td>
              </tr>


          </table>
          {!!Form::close()!!}

         


    </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! Html::script('js/registration.js')!!}

@stop