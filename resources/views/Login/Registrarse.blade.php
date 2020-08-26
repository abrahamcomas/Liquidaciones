@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3>
					<h5>Registro</h5></center>
					<hr style="width:100%; border-color: green;">
				</div>
				<div class="panel-body">
					@include('Login/messages')
					<form method="POST" action="{{ route('Registro') }}">
						@csrf @method('PATCH')
						<div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="Rut">Ingrese RUN</label></center>
	                        	<input type="text" class="form-control" name="Rut" id="Rut" value="{{ old('Rut') }}" oninput="checkRut(this)" placeholder="RUN" >
	                        	<!--{!! $errors->first('Rut','<span class="help-block">:message</span>') !!}-->
	                      	</div>
	                    </div>
	                    <div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="Contraseña"><center>Ingrese Contraseña</center></label></center> 
	                        	<input type="password" id="Contrasenia" name="Contrasenia" class="form-control" placeholder="Contraseña" >
	                      	</div>
	                   	</div>
	                   	<div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="Comfirmar_Contraseña"><center>Confirmar Contraseña</center></label></center> 
	                        	<input type="password" id="Comfirmar_Contrasenia" name="Comfirmar_Contrasenia" class="form-control" placeholder="Conformar Contraseña" >
	                      	</div>
	                   	</div>
	                   	<div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="password"><center>Ingrese Email</center></label></center> 
	                        	<input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" placeholder="Email" >
	                      	</div>
	                   	</div>
	                   	<button class="btn btn-success active btn-block">Aceptar</button>
					</form>
					<center>
						<br>
						<a href="{{ route('Index') }}" style="color: green;">Volver</a>
					</center>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection