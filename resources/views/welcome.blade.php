 @extends('layout.master')


 @section('title')
  index
@stop


 @section('header')
  <div class="container">
      <div class="page-header">
        <h1>Index</h1>
      </div>

@stop

 @section('content')
   
   @if (count($texts) > 0)  
          <div class="alert alert-info">
            
            <ul>
              @foreach ($texts as $text)
              <li>{{ link_to('text/'.$text->id, $title = $text->text, $attributes = array(), $secure = null)}}</li>
              @endforeach
            </ul>
          </div>
          @endif

        <hr>
        {{ link_to('home/login', $title = 'log in', $attributes = array(), $secure = null)}} <br>
        {{ link_to('users/create', $title = 'registration', $attributes = array(), $secure = null)}} <br>
        {{ link_to('home/logout', $title = 'logout', $attributes = array(), $secure = null)}}

       

    </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! Html::script('js/registration.js')!!}

@stop