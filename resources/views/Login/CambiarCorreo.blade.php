@extends('App')
@section('content')
<div class="container-fluid"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center>
						<h3>Cambiar Email</h3>
					</center>  
					<hr style="width:100%; border-color: green;">
					<div class="panel-body"> 
						@include('Login/messages') 
						<form method="POST" action="{{ route('FormCorreo') }}">   
							@csrf   
							 <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password"><center>Ingrese Contraseña Actual</center></label></center> 
		                        	<input type="password" id="passwordActual" name="passwordActual" class="form-control" placeholder="Contraseña" >
		                      	</div>
		                   	</div>					                    
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password"><center>Ingrese Nuevo Email</center></label></center> 
		                        	<input type="email" id="Correo" name="Correo" class="form-control" placeholder="Correo" >
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-success active btn-block">Aceptar</button>
						</form>
						<hr style="width:100%; border-color: green;">
						<center> 
							<a href="{{ route('VolverIndex') }}" style="color: green;">Volver</a>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection   

