@extends('App')
@section('content')
<div class="container-fluid"> 
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Liquidaciones de sueldo</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group {{ $errors->has('Rut') ? 'has-error' : '' }}">
	                      	<div class="form-label-group">
	                      		<center><label for="Rut">Ingrese RUN</label></center>
	                        	<input type="text" class="form-control" name="Rut" id="Rut" oninput="checkRut(this)" placeholder="RUN" >
	                        	{!! $errors->first('Rut','<span class="help-block">:message</span>') !!}
	                      	</div>
	                    </div>
	                    <div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="password"><center>Ingrese Contraseña</center></label></center> 
	                        	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" >
	                        	{!! $errors->first('password','<span class="help-block">:message</span>') !!}
	                      	</div>
	                   	</div>
	                   	<button class="btn btn-primary btn-block">Aceptar</button>
					</form>
					<a href="{{ route('registro') }}">Registrar</a>
				</div>
			</div> 
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection