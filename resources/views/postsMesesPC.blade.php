@extends('App')
@section('content')
	<div class="container">
		@livewire('meses-p-c',['ListaMes' => $ListaMes,'MesActual' => $MesActual,'RUN' => $RUN,'Id_Funcionario' => $Id_Funcionario,'Anio' => $Anio])  
	</div>  
@endsection 