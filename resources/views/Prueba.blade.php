@extends("layouts/Plantilla")

 @section("Head")

<h1>Contacto</h1>
 @endsection

  @section("body")

<h1>body</h1>




@if(count($alumnos))

<table width="50%" border="1"> 
	
@foreach($alumnos as $persona)
<tr>
	<td>
		{{ $persona }}
	</td>
</tr>

@endforeach

@else
{{ "Sin alumnos" }}
</table>
@endif



 @endsection

  @section("foot")

<h1>foot</h1>
 @endsection