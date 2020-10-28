@extends('App')
@section('content')
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
					<div  style="display:none;" id="EnvindoCorreo">
	                  	<samp>
	                  		<h5 align="center"><strong>Enviando correo... Espere Por Favor</strong></h5>
	                  	</samp>
	                  	<center>
	                  		<img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
	                  	</center>
                	</div>
					<div id="content"> 
						@include('Login/messages')  
						<form method="POST" action="{{ route('ContraseniaEnviada') }}">
							@csrf 
		                   	<div class="form-group">
		                      	<div class="form-label-group">
		                      		<center><label for="password">Ingrese Email</label></center> 
		                        	<input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" placeholder="Email" required>
		                      	</div>
		                   	</div>
		                   	<div class="form-group">
		                   		<div class="form-label-group">
		                            <center><label for="C">Tipo Contrato</label></center>
		                            <select size="1" class="form-control" name="C" id="C" required>
		                                <option value="" selected>Seleccionar</option>
		                                <option value="1">Planta o Contrata</option>
		                                <option value="2">Cementerio</option>
		                                <option value="3">Código</option>
		                            </select> 
	                        	</div>
	                        </div> 
		                   	<button id="btnEnviar" class="btn btn-success active btn-block enviar">Enviar</button>
						</form>
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
@endsection 
@section('scripts')
	<script type="text/javascript">
		// $(document).ready(function(){
 	// 		$(document).on('click', '.enviar', function(){
 	// 			var btnEnviar = $("#btnEnviar");
 	// 		 btnEnviar.attr("disabled","disabled");
		// 	  btnEnviar.text("Enviando");
               
		// 	});   
  //       });

    //       $(document).ready(function () {
    // $("#formCorreo").bind("submit",function(){
    //     // Capturamnos el boton de envío
    //     var btnEnviar = $("#btnEnviar");
    //     $.ajax({
    //         type: $(this).attr("method"),
    //         url: $(this).attr("action"),
    //         data:$(this).serialize(),
    //         beforeSend: function(){
    //             /*
    //             * Esta función se ejecuta durante el envió de la petición al
    //             * servidor.
    //             * */
    //             // btnEnviar.text("Enviando"); Para button 
    //             btnEnviar.val("Enviando"); // Para input de tipo button
    //             btnEnviar.attr("disabled","disabled");
    //         },
    //         complete:function(data){
    //             /*
    //             * Se ejecuta al termino de la petición
    //             * */
    //             btnEnviar.val("Enviar formulario");
    //             btnEnviar.removeAttr("disabled");
    //         },
    //         success: function(data){
    //              			$("#content").hide();
		  //   $("#EnvindoCorreo").show(); 
    //         },
           
    //     });
    //     // Nos permite cancelar el envio del formulario
    //     return false;
    // });
// });
	</script>
@endsection 


