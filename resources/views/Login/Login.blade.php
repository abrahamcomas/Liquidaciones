@extends('App')
@section('content')
<div class="container-fluid" id="content"> 
	<center><h3>Liquidaciones de sueldo</h3></center> 
	<hr style="width:100%; border-color: green;">
	@if(Auth::guard('Codigo')->check())
		<center> 
			<a href="{{ route('VolverIndexCo') }}" style="color: green;"><H1>Ingresar</H1></a>
		</center>		
	@elseif(Auth::guard('Cementerio')->check())
		<center> 
			<a href="{{ route('VolverIndexCe') }}" style="color: green;"><H1>Ingresar</H1></a>
		</center>		
	@elseif(Auth::guard('web')->check())
		<center>  
			<a href="{{ route('VolverIndex') }}" style="color: green;"><H1>Ingresar</H1></a>
		</center>		 
	@else
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
	@endif
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
						<form method="POST" action="{{ route('loginCO') }}">  
							@csrf   
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="RUNCO" id="RUNCO" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUNCO') }}">
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="passwordCO" name="passwordCO" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-success active btn-block">Aceptar</button>
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
						<form method="POST" action="{{ route('login') }}">  
							@csrf   
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="RUN" id="RUN" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUN') }}">
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-success active btn-block">Aceptar</button>
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
						<form method="POST" action="{{ route('loginCE') }}">  
							@csrf   
							<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="Rut">Ingrese Rut</label></center>
		                        	<input type="text" class="form-control" name="RUNCE" id="RUNCE" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUNCE') }}">
		                      	</div>
		                    </div>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password"><center>Ingrese Contraseña</center></label></center> 
		                        	<input type="password" id="passwordCE" name="passwordCE" class="form-control" placeholder="Contraseña" autocomplete="on">
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-success active btn-block">Aceptar</button>
						</form>
					</div>
				</div> 
			</div>
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

	        window.addEventListener( "pageshow", function ( event ) {
			  	var historyTraversal = event.persisted || 
			                         ( typeof window.performance != "undefined" && 
			                              window.performance.navigation.type === 2 );
			  	if ( historyTraversal ) {
			   	 	// Handle page restore.
			    	window.location.reload();
			  	}
			});
	});	

	// var idleTime = 0;
	// 	    $(document).ready(function () {
	// 	        //Increment the idle time counter every minute.
	// 	        var idleInterval = setInterval(timerIncrement, 60000); //1 minute

	// 	        //Zero the idle timer on mouse movement.
	// 	        $(this).mousemove(function (e) {
	// 	            idleTime = 0;
	// 	        });
	// 	        $(this).keypress(function (e) {
	// 	            idleTime = 0;
	// 	        });
	// 	    });

	// 	    function timerIncrement() {
	// 	        idleTime = idleTime + 1;
	// 	        if (idleTime >= 1) { //20 minutes
	// 	            location.href ="{{ url('/') }}";
	// 	        }
	// 	    }
</script>
@endsection