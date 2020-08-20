@extends('App')
@section('content')
<div class="container-fluid"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center>
						<h3>Liquidaciones de Sueldo</h3>
					</center>  
					<hr style="width:100%; border-color: green;">
					<div class="panel-body">
						<center>
							<h2><strong>{{ $resultado }}</strong></h2>
						</center>				
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

