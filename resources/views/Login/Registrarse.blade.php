@extends('App')
@section('content') 
<div class="container-fluid">  
	<center><h3>Registro liquidaciones de sueldo</h3></center> 
	{{-- <center><h5>(Si su Rut es inferior a 10 millones debe anteponer un 0)</h5></center>  --}}
	<hr style="width:100%; border-color: green;">
	<div class="d-flex justify-content-center">
  		<div class="p-2 bd-highlight">
  			<button type="button" class="btn btn-success codigo">Código</button>
  		</div>
  		<div class="p-2 bd-highlight">
  			<button type="button" class="btn btn-success plantacontrata">Planta y Contrata</button>
  		</div>
  		<div class="p-2 bd-highlight">
  			<button type="button" class="btn btn-success cementerio">Cementerio</button>
  		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			@include('Login/messages')
			<div style="display: none;" id="codigo">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h5>Código del trabajo</h5></center>
						<hr style="width:100%; border-color: green;">
					</div>
					<div class="panel-body">
						<form method="POST" action="{{ route('RegistroCO') }}">
							@csrf @method('PATCH')
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="RutCO" id="RutCO" value="{{ old('RutCO') }}" oninput="checkRut(this)" placeholder="Rut" >
		                        	<!--{!! $errors->first('Rut','<span class="help-block">:message</span>') !!}-->
		                      	</div>
		                    </div>
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
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Email"><center>Ingrese Email</center></label></center> 
		                        	<input type="email" id="EmailCO" name="EmailCO" value="{{ old('EmailCO') }}" class="form-control" placeholder="Email" >
		                      	</div>
		                   	</div>
		                   	<button class="btn btn-success active btn-block">Aceptar</button>
						</form>
					</div>
				</div> 
			</div>

			<div style="display: none;" id="plantacontrata">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h5>Planta y Contrata</h5></center>
						<hr style="width:100%; border-color: green;">
					</div>
					<div class="panel-body">
						<form method="POST" action="{{ route('Registro') }}">
							@csrf @method('PATCH')
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="Rut" id="Rut" value="{{ old('Rut') }}" oninput="checkRut(this)" placeholder="Rut" >
		                        	<!--{!! $errors->first('Rut','<span class="help-block">:message</span>') !!}-->
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Contrasenia"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="Contrasenia" name="Contrasenia" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Confirmar_Contraseña"><center>Confirmar Contraseña</center></label></center> 
		                        	<input type="password" id="Confirmar_Contrasenia" name="Confirmar_Contrasenia" class="form-control" placeholder="Confirmar Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Email"><center>Ingrese Email</center></label></center> 
		                        	<input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" placeholder="Email" >
		                      	</div>
		                   	</div>
		                   	<button class="btn btn-success active btn-block">Aceptar</button>
						</form> 
					</div>
				</div> 
			</div>
			<div style="display: none;" id="cementerio">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h5>Cementerio</h5></center>
						<hr style="width:100%; border-color: green;">
					</div>
					<div class="panel-body">
						<form method="POST" action="{{ route('RegistroCE') }}">
							@csrf @method('PATCH')
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="RutCE" id="RutCE" value="{{ old('RutCE') }}" oninput="checkRut(this)" placeholder="Rut" >
		                        	<!--{!! $errors->first('Rut','<span class="help-block">:message</span>') !!}-->
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Contrasenia"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="ContraseniaCE" name="ContraseniaCE" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Confirmar_Contraseña"><center>Confirmar Contraseña</center></label></center> 
		                        	<input type="password" id="Confirmar_ContraseniaCE" name="Confirmar_ContraseniaCE" class="form-control" placeholder="Confirmar Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Email"><center>Ingrese Email</center></label></center> 
		                        	<input type="email" id="EmailCE" name="EmailCE" value="{{ old('EmailCE') }}" class="form-control" placeholder="Email" >
		                      	</div> 
		                   	</div>
		                   	<button class="btn btn-success active btn-block">Aceptar</button>
						</form>
					</div>
				</div> 
			</div>
			<br>
	<center>
		<a href="{{ route('Index') }}" style="color: green;">Volver</a>
	</center>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
	 		$(document).on('click', '.codigo', function(){
	 			$("#codigo").show('500');
	 			$("#plantacontrata").hide();
	 			$("#cementerio").hide();
 					
	        });
	        $(document).on('click', '.plantacontrata', function(){
	 			$("#plantacontrata").show('500');
	 			$("#codigo").hide();
	 			$("#cementerio").hide();
 					
	        });
	        $(document).on('click', '.cementerio', function(){
	 			$("#cementerio").show('500');
	 			$("#codigo").hide();
	 			$("#plantacontrata").hide();
 					
	        });
	});	
</script>
@endsection