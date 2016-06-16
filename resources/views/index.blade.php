@extends('master')

@section('contenido')

	{!! Form::open(['id' => 'frmCube', 'url' => 'operations', 'onsubmit' => 'return runInputValidation();']) !!}
			
		<div class="form-group">
			{!! Form::label('cubeDimensions', 'Cube dimensions (N x N x N):') !!}
			<div class="input-group spinner">
			    <input type="text" id="cubeDimensions" name="cubeDimensions" class="form-control number" value="3" min="1" max="100" size="30">
			    <div class="input-group-btn-vertical">
			      	<button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
			      	<button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
			    </div>
			</div>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-lg btn-margin">
    			<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;&nbsp;Continuar
  			</button>
  		</div>

	{!! Form::close() !!}

@stop