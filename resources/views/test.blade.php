 @extends('layout.master')

  @section('title')
  Test ajax
@stop

 @section('header')
	<div class="page-header">
        <h1>Test</h1>
      </div>
@stop

 @section('content')

 		<body onload="process()">
 			<h3>The chuff bucket</h3>
 			Enter the food you would like to order:
 			<input type="text" id="userInput">
 			<div id="underInput"></div>
 		</body>
	

          

         

          {!! Html::script('js/jquery.min.js') !!}
          {!! Html::script('js/ajaxtest.js') !!}

<script>

	


</script>
          	
@stop

