@extends('App')
@section('content') 
<div class="container-fluid"> 
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3>Liquidaciones de sueldo</h3></center> 
					<hr style="width:100%; border-color: green;">
				</div>
				<div class="panel-body">
					<br>
					<center>
						<h5 style="color: red;">Error, Link no valido</h5>
					</center> 
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