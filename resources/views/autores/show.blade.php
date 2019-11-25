@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos del autor 
            		<a class="float-right" href="{{route('autor.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-2" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$autor->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Nombre Completo:</b>
						</div>
						<div class="col-9">
							{{$autor->full_name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Fecha de nacimiento:</b>
						</div>
						<div class="col-9">
							{{$autor->birthday->format('d-m-Y')}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Dirección:</b>
						</div>
						<div class="col-9">
							{{$autor->address}}
						</div>
					</div>

					
					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Email:</b>
						</div>
						<div class="col-9">
							{{$autor->email}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>País:</b>
						</div>
						<div class="col-9">
							{{ $autor->country->name }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Libros</b>
						</div>
						<div class="col-9">
							{{ $autor->products_string }}
						</div>
					</div>
					
					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($autor->img_url)
								<img src="{{ $autor->img_url }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
					
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('autor.edit', $autor->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('autor.destroy', $autor->id) }}">
							
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
		return confirm('¿Desea eliminar este autor?');
	}
</script>
@endsection
