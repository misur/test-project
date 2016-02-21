<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    {!!Html::style('css/bootstrap.min.css')!!}

   {{-- {!!Html::style('css/ie10-viewport-bug-workaround.css')!!} --}}

  {!!Html::style('css/dashboard.css')!!}

    {!!Html::script('js/ie-emulation-modes-warning.js')!!}

{!!Html::style('css/jsgrid.min.css')!!}
{!!Html::style('css/jsgrid-theme.min.css')!!}

    

 
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin panel </a>
        </div>
        @yield('navbar')
        
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
       @yield('sidebar')


        @yield('content')
        
        

        
      </div>
    </div>

   {!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/holder.min.js')!!}
    {{-- {!!Html::script('js/ie10-viewport-bug-workaround.js')!!} --}}

     {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.4.0/jsgrid.min.js')!!}

 
   
  </body>
</html>
