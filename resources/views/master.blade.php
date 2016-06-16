<!DOCTYPE html>
<html lang="es">
<head>
	<title>Cube Summation - Eng. John Moreno</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	{!! Html::style('css/main.css') !!}
	{!! Html::script('js/main.js') !!}
	{!! Html::script('js/fnAjax.js') !!}
</head>
<body>
	<div class="container text-center">
		<img src="images/cube.gif" height="150">
		<h3>CUBE SUMMATION</h3>
		<hr>
		
		<div id="alertMsg" class="alert alert-danger fade in" style="display:none;">
			<a href="#" class="close" onclick="closeAlert();return false;">&times;</a>
			<span>&nbsp;</span>
		</div>
		
		@yield('contenido')
		
	</div>
</body>
</html>