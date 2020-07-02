@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3>
					<h5>Usuario Registrado Correctamente</h5></center>
							<hr style="width:100%; border-color: black;">
				</div>
				<div class="panel-body">
					
					
					<br>
					<a href="{{ route('Index') }}">Volver</a>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
	</div>
</div>
@endsection