@extends('App')
@section('content')
<div class="container-fluid"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3></center> 
					<hr style="width:100%; border-color: black;">
				</div>
				<div class="panel-body">
					@include('Login/messages') 
					<form method="POST" action="{{ route('login') }}">  
						@csrf   
						<div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="Rut">Ingrese RUN</label></center>
	                        	<input type="text" class="form-control" name="RUN" id="RUN" oninput="checkRut(this)" placeholder="RUN" value="{{ old('RUN') }}">
	                      	</div>
	                    </div>
	                    <div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="password"><center>Ingrese Contraseña</center></label></center> 
	                        	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" >
	                      	</div>
	                   	</div>
	                   	<button type="submit" class="btn btn-primary btn-block">Aceptar</button>
					</form>
					<center>
						<br>
						<a href="{{ route('Registrarse') }}">Registrar</a>
						<br>
						<a href="{{ route('Recuprar') }}">Recuperar Contraseña</a>
					</center> 
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection