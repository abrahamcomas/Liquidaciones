<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liquidaciones</title>
	 <link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
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
</head>
<body>
	<div class="container">
			<img id="imagen1" img src="{{ asset('imagenes/logo2.png') }}" width="300" height="90"/>
		@yield('content')
	</div>
</body>
</html>