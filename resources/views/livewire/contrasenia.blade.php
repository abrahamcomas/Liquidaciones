<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3>
					<h5>Recuperar Contraseña</h5></center>
					<hr style="width:100%; border-color: green;">  
				</div>
				<div class="panel-body">
					@include('Login/messages')  
                   	<div class="form-group">
                      	<div class="form-label-group">
                      		<center><label for="password">Ingrese Email</label></center> 
                      		 @error('Email') <span class="error">{{ $message }}</span> @enderror
                        	<input type="email" wire:model="Email" class="form-control" placeholder="Email">
                      	</div>
                   	</div>
                   	<div class="form-group">
                   		<div class="form-label-group">
                            <center><label for="C">Tipo Contrato</label></center>
                            <select size="1" class="form-control"  wire:model="C">
                                <option value="" selected>Seleccionar</option>
                                <option value="1">Planta o Contrata</option>
                                <option value="2">Cementerio</option>
                                <option value="3">Código</option>
                            </select> 
                    	</div>
                    </div>   
 
                   	<button wire:click="Enviarcorreo" wire:loading.remove class="btn btn-success active btn-block enviar">Enviar</button>
					
					<div wire:loading wire:target="Enviarcorreo">
	                  	<center>
	                  		 <samp>
                  				<h5 align="center"><strong>Espere Por Favor...</strong></h5>
                  			</samp>
	                  			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
	                  	</center>
				    </div>
				    @if ($resultado!=1)
				  	<hr style="width:100%; border-color: green;"> 
						<div class="alert alert-danger">
						    <ul>
						        <strong>{{ $resultado }}</strong>
						    </ul>
			   			</div>
			   			<hr style="width:100%; border-color: green;"> 
		   			@endif
				    <div>
						<center>
							<br> 
							<a href="{{ route('Index') }}" style="color: green;">Volver</a>
						</center>
					</div>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
