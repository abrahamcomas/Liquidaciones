<div class="container-fluid">
	<center><h3>Liquidaciones de Sueldo año {{ $Anio }}</h3></center>  
	<hr style="width:100%; border-color: green;"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
			<form method="POST" action="{{ route('CrearPDF') }}">   
				@csrf
				<input type="hidden" name="RUN" value="{{ $RUN }}">
				<input type="hidden" name="Anio" value="{{ $Anio }}">
				<select class="form-control" wire:model="MesSelect" id="Mes" name="Mes">
					<option select="">Seleccionar</option>
	    			@foreach($ListaMes as $mes)
						@if ($mes->Mes==1)
						    <option value="1">Enero</option>
				
						@elseif ($mes->Mes==2)
						    <option value="2">Febrero</option>
				
						@elseif ($mes->Mes==3)
						    <option value="3">Marzo</option>
		
						@elseif ($mes->Mes==4)
						    <option value="4">Abril</option>
				
						@elseif ($mes->Mes==5)
						    <option value="5">Mayo</option>
				
						@elseif ($mes->Mes==6)
						    <option value="6">Junio</option>
			
						@elseif ($mes->Mes==7)
						    <option value="7">Julio</option>
			
						@elseif ($mes->Mes==8)
						    <option value="8">Agosto</option>
			
						@elseif ($mes->Mes==9)
						    <option value="9">Septiembre</option>
				
						@elseif ($mes->Mes==10)
						    <option value="10">Octubre</option>
					
						@elseif ($mes->Mes==11)
						    <option value="11">Noviembre</option>
				
						@elseif ($mes->Mes==12)
						    <option value="12">Diciembre</option>
						@endif
	       			@endforeach
				</select>
				<br> 
                <div class="form-group">
                  	<div wire:loading.remove class="form-label-group">
                  		<center>
                  			<button type="submit" class="btn btn-success active" formtarget="_blank">Imprimirs PDF</button>
                  		</center> 
                  	</div>
               	</div>
            </form>
		</div> 
		<div wire:loading class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
          	<center>
          		 <samp>
      				<h5 align="center"><strong>Espere Por Favor...</strong></h5>
      			</samp>
          			<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
          	</center>
		</div>
		<div wire:loading.remove class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
			@if($PlanillaSuplementaria!='[]') 
				<form method="POST" action="{{ route('CrearPMG') }}">
					@csrf   
					<input type="hidden" name="Anio" value="{{ $Anio }}">
					<input type="hidden" name="RUN" value="{{ $RUN }}">
					<input type="hidden" name="Mes" value="{{ $PlanillaSuplementaria }}">
					<center>
              			<button type="submit" class="btn btn-success active" formtarget="_blank">PMG Disponible</button>
              		</center>
				</form>
			@else
				<center>
              		<button type="button" class="btn btn-danger active">PMG No Disponible</button>
              	</center>
			@endif
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
	</div> 

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<form method="POST" action="{{ route('CrearPDFActual') }}">
			@csrf 
				<input type="hidden" name="RUN" value="{{ $RUN }}">
				<input type="hidden" name="Anio" value="{{ $Anio }}"> 
				@php
					$date_ano=date("Y");
				@endphp

				@if (!isset($MesActual) AND $Anio==$date_ano) 
						<hr style="width:100%; border-color: green;">
						@if (date("n")==1)
						    @php
								$MesActual = "Diciembre";
							@endphp
						@endif
						@if (date("n")==2)
						    @php
								$MesActual = "Enero";
							@endphp
						@endif
						@if (date("n")==3)
						    @php
								$MesActual = "Febrero";
							@endphp
						@endif
						@if (date("n")==4)
						    @php
								$MesActual = "Marzo";
							@endphp
						@endif
						@if (date("n")==5)
						    @php
								$MesActual = "Abril";
							@endphp
						@endif
						@if (date("n")==6)
						    @php
								$MesActual = "Mayo";
							@endphp
						@endif
						@if (date("n")==7)
						    @php
								$MesActual = "Junio";
							@endphp
						@endif
						@if (date("n")==8)
						    @php
								$MesActual = "Julio";
							@endphp
						@endif
						@if (date("n")==9)
						    @php
								$MesActual = "Agosto";
							@endphp
						@endif
						@if (date("n")==10)
						   @php
								$MesActual = "Septiembre";
							@endphp
						@endif
						@if (date("n")==11)
						    @php
								$MesActual = "Octubre";
							@endphp
						@endif
						@if (date("n")==12)
						   @php
								$MesActual = "Noviembre";
							@endphp
						@endif
					<input type="hidden" name="Mes" value="{{ date("n") }}"> 
					<div class="form-group">
						<div class="form-label-group">
                      		<center>
                      			<h4><center>Ultima Liquidación Disponible<br><strong>{{$MesActual}}</strong></center></h4>
                      			<br>
                      			<button type="submit" class="btn btn-success active" formtarget="_blank">
                      				Liquidacion
                      			</button>
                      		</center>
                      	</div>
               		</div>
				@endif
			</form>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
	<center>
		<a href="javascript:history.back()" style="color: green;"> Volver</a>
	</center>	
</div>
