@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos del usuario 
            		<a class="float-right" href="{{route('usuario.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-2" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$usuario->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Nombre:</b>
						</div>
						<div class="col-9">
							{{$usuario->name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Apellido:</b>
						</div>
						<div class="col-9">
							{{$usuario->last_name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Email:</b>
						</div>
						<div class="col-10">
							{{ $usuario->email }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Rol:</b>
						</div>
						<div class="col-10">
							{{ $usuario->rol_name }}
						</div>
					</div>	

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Dirección:</b>
						</div>
						<div class="col-10">
							---<br>
							@if( !empty($usuario->address) )
							{{ $usuario->address }} no. {{$usuario->exterior_number}} 
							@endif
							@if( !empty($usuario->interior_number) )
							 int. {{ $usuario->interior_number }}
							@endif
							<br>
							@if( !empty($usuario->between_streets) )
								entre calles: {{ $usuario->between_streets }} <br>
							@endif
							@if( !empty($usuario->suburb) )
								colonia: {{ $usuario->suburb }} 
							@endif
							@if( !empty($usuario->postal_code) )
								C.P. {{ $usuario->postal_code }} <br>
							@endif
							{{ $usuario->city->name ?? '' }} {{ $usuario->state->name ?? '' }} 
						</div>
					</div>					

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Teléfono:</b>
						</div>
						<div class="col-10">
							{{ $usuario->phone ?? 'N/A' }}
						</div>
					</div>	

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Celular:</b>
						</div>
						<div class="col-10">
							{{ $usuario->cellphone ?? 'N/A' }}
						</div>
					</div>	

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Blogs:</b>
						</div>
						<div class="col-10">
							{{ $usuario->blogs_string }}
						</div>
					</div>	
					
					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($usuario->imgUrl)
								<img src="{{ $usuario->imgUrl }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
					
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('usuario.edit', $usuario->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('usuario.destroy', $usuario->id) }}">
							
								@method("DELETE")
								@csrf
								<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>		
						</div>

					</div>
					
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script>
	function confirmacion()
	{
		return confirm('¿Desea eliminar este usuario?');
	}
</script>
@endsection
