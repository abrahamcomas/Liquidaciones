@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3>
					<h5>Recuperar Contraseña</h5></center>
					<hr style="width:100%; border-color: green;">
				</div>
				<div class="panel-body">
					@include('Login/messages')  
					<form method="POST" action="{{ route('ContraseñaEnviada') }}">
						@csrf 
	                   	<div class="form-group">
	                      	<div class="form-label-group">
	                      		<center><label for="password"><center>Ingrese Email{{ 	 $R = Str::random(60), }}</center></label></center> 
	                        	<input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" placeholder="Email" >
	                      	</div>
	                   	</div>
	                   	<button class="btn btn-success active btn-block">Enviar</button>
					</form>
					<center>
						<br>
						<a href="{{ route('Index') }}" style="color: green;">Volver</a>
					</center>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection