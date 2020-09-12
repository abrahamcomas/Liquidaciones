@extends('App')
@section('content')
<div class="container-fluid">  
<center><h3>Liquidaciones de Sueldo</h3></center> 
	<center><h5>Seleccione año</h5></center> 
	<hr style="width:100%; border-color: green;">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"> 
			<center>
                <h6>
                	<center>
                		Días Administrativos Disponibles <strong>{{ $R_numerodiassolicitados }}</strong>
                	</center>
                </h6>
            </center>			
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<center>
                <h6> 
                	<center>
                		Días de Feriado Legal Disponibles <strong>{{ $sqlDiasFeriados }}</strong>
                	</center>
                </h6>
            </center>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	</div>
	<hr style="width:100%; border-color: green;">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<form method="POST" action="{{ route('ConsultaMesCe') }}"> 
							@csrf
							<input type="hidden" name="RUN" value="{{ $RUN }}">
							<input type="hidden" name="Id_Funcionario" value="{{ $Id_Funcionario }}">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<select id="Anio" name="Anio" class="form-control">
										
						       			@foreach($resultado as $anio)
						       				<option value="{{ $anio->Ano }}">{{ $anio->Ano }}</option>
						       			@endforeach
									</select>
								</div>
							</div>
							<br>
		                    <div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><button type="submit" class="btn btn-success active">Continuar</button></center>
		                      	</div>
		                   	</div> 
						</form>
					</div>
					<div class="panel-body"> 
					</div> 
				</div> 		
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection   
