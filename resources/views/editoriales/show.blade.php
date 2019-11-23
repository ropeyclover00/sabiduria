@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos de la editorial 
            		<a class="float-right" href="{{route('editorial.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-2" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$editorial->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Nombre:</b>
						</div>
						<div class="col-9">
							{{$editorial->name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Dirección:</b>
						</div>
						<div class="col-9">
							{{$editorial->address}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Teléfono:</b>
						</div>
						<div class="col-9">
							{{$editorial->phone}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Email:</b>
						</div>
						<div class="col-9">
							{{$editorial->email}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>URL:</b>
						</div>
						<div class="col-9">
							<a href="{{$editorial->url ?? '#'}}">Ver sitio</a>
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>País:</b>
						</div>
						<div class="col-9">
							{{ $editorial->country->name }}
						</div>
					</div>
					
					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($editorial->img_url)
								<img src="{{ $editorial->img_url }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
					
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('editorial.edit', $editorial->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('editorial.destroy', $editorial->id) }}">
							
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
		return confirm('¿Desea eliminar esta editorial?');
	}
</script>
@endsection
