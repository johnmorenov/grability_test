@extends('master')

@section('contenido')

	{!! Form::open(['id' => 'frmCube']) !!}
		
		<div class="form-group">
			<h3><span class="label label-default">(N * N * N), N = {{ $cubeDimensions }}</span></h3>
			<input type="hidden" id="cubeDimensions" name="cubeDimensions" value="{{ $cubeDimensions }}">
		</div>

		<div class="form-group">
			{!! Form::label('query', 'CUBE Query: ') !!}
			{!! Form::text('query', NULL, ['class' => 'form-control', 'placeholder' => 'ex: UPDATE x y z W, QUERY x1 y1 z1 x2 y2 z2']) !!}
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-success btn-lg" onclick="runCubeQuery();return false;">
    			<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Ejecutar Query
  			</button>
  		</div>
		
		<div class="form-group">
			<span class="loading" style="display:none;"><img src="images/loading.gif"></span>
		</div>

		<div class="form-group">
			<div class="panel panel-info">
			  	<div class="panel-heading text-left">Resultado de las Queries:</div>
			  	<div class="panel-body" id="result"></div>
			</div>
		</div>

	{!! Form::close() !!}

@stop