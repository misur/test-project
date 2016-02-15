<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

<meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
    <meta name="_token" content="{!! csrf_token() !!}"/> 
    <link rel="icon" href="../../favicon.ico">

    <title> @yield('title')</title>

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/ie10-viewport-bug-workaround.css') !!}
    {!! Html::style('css/sticky-footer.css') !!}
    {{-- {!! Html::style('js/ie-emulation-modes-warning.js') !!} --}}

   
  </head>

  <body>

   <div class="container">

   @yield('header')

   @yield('content')
     

           @if(Auth::check())
             logedd user:
             {!!Auth::user()->email!!}
           @endif 

    </div>


    {{-- {!!Html::script('js/bootstrap.min.js')!!} --}}
     {!!Html::script('js/bootstrap.js')!!}

<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
    
  </body>
</html>
