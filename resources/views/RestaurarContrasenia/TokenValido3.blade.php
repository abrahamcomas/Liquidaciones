@extends('App')
@section('content') 
<div class="container-fluid"> 
	<div class="row"> 
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo restaurar contraseña</h3></center> 
					<hr style="width:100%; border-color: green;">
				</div>
				<div class="panel-body">
					<center>
						<h5> {{ $Datos->Nombres }} {{ $Datos->Apellidos }} </h5>
					</center> 
					<br>
					@include('Login/messages')
					<form method="POST" action="{{ route('RestaurarC3') }}">
							@csrf @method('PATCH')
							<input type="hidden" id="Id_Funcionario" name="Id_Funcionario" value="{{ $Datos->Id_Funcionario }}">
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Contrasenia"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="ContraseniaCO" name="ContraseniaCO" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Confirmar_Contraseña"><center>Confirmar Contraseña</center></label></center> 
		                        	<input type="password" id="Confirmar_ContraseniaCO" name="Confirmar_ContraseniaCO" class="form-control" placeholder="Confirmar Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                  
		                   	<button class="btn btn-success active btn-block">Aceptar</button>
						</form>
					<br>
					<center>
						<a href="{{ route('Index') }}" style="color: green;">Volver</a>
					</center> 
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection  