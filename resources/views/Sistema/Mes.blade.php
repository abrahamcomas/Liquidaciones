@extends('App')
@section('content')
<div class="container-fluid">
	<center><h3>Liquidaciones de Sueldo año {{ $Anio }}</h3></center> 
	<hr style="width:100%; border-color: green;"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<form method="POST" action="{{ route('CrearPDF') }}">  
				@csrf
				<input type="hidden" name="RUN" value="{{ $RUN }}">
				<input type="hidden" name="Anio" value="{{ $Anio }}">
				<select id="Mes" name="Mes" class="form-control">
	    			@foreach($ListaMes as $mes)
					@if ($mes->Mes==1))
					    <option value="1">Enero</option>
					@endif
					@if ($mes->Mes==2))
					    <option value="2">Febrero</option>
					@endif
					@if ($mes->Mes==3))
					    <option value="3">Marzo</option>
					@endif
					@if ($mes->Mes==4))
					    <option value="4">Abril</option>
					@endif
					@if ($mes->Mes==5))
					    <option value="5">Mayo</option>
					@endif
					@if ($mes->Mes==6))
					    <option value="6">Junio</option>
					@endif
					@if ($mes->Mes==7))
					    <option value="7">Julio</option>
					@endif
					@if ($mes->Mes==8))
					    <option value="8">Agosto</option>
					@endif
					@if ($mes->Mes==9))
					    <option value="9">Septiembre</option>
					@endif
					@if ($mes->Mes==10))
					    <option value="10">Octubre</option>
					@endif
					@if ($mes->Mes==11))
					    <option value="11">Noviembre</option>
					@endif
					@if ($mes->Mes==12))
					    <option value="12">Diciembre</option>
					@endif
	       			@endforeach
				</select>
				<br>
                <div class="form-group">
                  	<div class="form-label-group">
                  		<center>
                  			<button type="submit" class="btn btn-success active" formtarget="_blank">Imprimir PDF</button>
                  		</center> 
                  	</div>
               	</div>
            </form>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
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
	<hr style="width:100%; border-color: green;">
		<center>
		<a href="javascript:history.back()" style="color: green;"> Volver</a>
		</center>	
				</div>
	 
			</div> 
		</div>
	</div>
</div>
@endsection   
