<meta charset="utf-8">
<title>Liquidaciones</title>
<head>
	{{-- @php
		header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	@endphp --}}
	<link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!--Para que funione el ajax-->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	<script type="text/javascript">
		function checkRut(rut) 
		    {
			    var valor = rut.value.replace('.','');
			    valor = valor.replace('-','');
			    cuerpo = valor.slice(0,-1);
			    dv = valor.slice(-1).toUpperCase(); 
			    rut.value = cuerpo + '-'+ dv
			    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
			    suma = 0;
			    multiplo = 2;
			    for(i=1;i<=cuerpo.length;i++) {
			        index = multiplo * valor.charAt(cuerpo.length - i);
			        suma = suma + index;
			        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
			    }
			    dvEsperado = 11 - (suma % 11);
			    dv = (dv == 'K')?10:dv;
			    dv = (dv == 0)?11:dv;
			    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
			    rut.setCustomValidity('');
		    }
	</script>




<style type="text/css">

	 #h { 

        height:30px;
        background: #000000;
        background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.1) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(255, 255, 255,.25) 0%, rgba(0, 0, 0,.1) 100%), -moz-linear-gradient(-45deg,  #000000 0%, #000000 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -webkit-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -o-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -o-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -ms-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), linear-gradient(135deg,  #000000 0%,#000000 100%);

    }

    /*body { 
        width: 100%;
        height:100%;
        background: #000000;
        background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.1) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(255, 255, 255,.25) 0%, rgba(0, 0, 0,.1) 100%), -moz-linear-gradient(-45deg,  #000000 0%, #000000 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -webkit-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -o-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -o-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), -ms-linear-gradient(-45deg,  #000000 0%,#000000 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(65, 255, 0,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(255, 255, 255,.25) 0%,rgba(65, 255, 0) 100%), linear-gradient(135deg,  #000000 0%,#000000 100%);

    }*/
</style>

	<nav class="navbar navbar-expand-lg navbar-light bg-light" id="h">
	  	@if (Route::has('Index')) 
			<div class="top-right link">
				@auth
					<a class="navbar-brand" href="#" style="color: white;">Bienvenido {{ Auth::user()->Nombres}} {{ Auth::user()->Apellidos }}</a>
				@else
					<a class="navbar-brand" href="#" style="color: white;">Liquidaciones de sueldo</a>		
				@endauth
			</div>
		@endif
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>
	  	<ul class="navbar-nav ml-auto">
	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	@if (Route::has('Index'))
				<div class="top-right link">
					@auth
						<a href="{{ route('CerrarSesion') }}" style="color: white;">Cerrar Sesión</a>
					@endauth
				</div>
			@endif
  		</div>
	</nav>
	<img id="imagen1" img src="{{ asset('imagenes/logo2.png') }}" width="200" height="60"/>
</head>
<div class="container">
	@yield("content")
 	@yield('scripts')
	@yield("foot")
</div>
	

