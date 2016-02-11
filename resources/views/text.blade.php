 @extends('layout.master')


 @section('title')
 Text
@stop


 @section('header')
  <div class="container">
      <div class="page-header">
        <h1>Text</h1>
      </div>
@stop

 @section('content')
  	<h2> {{$text->text}}</h2>
  <hr>
  @if (count($comments) > 0)  
          <div class="alert alert-info">
            
            <ul>
              @foreach ($comments as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
  

@stop