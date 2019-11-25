@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos del producto 
            		<a class="float-right" href="{{route('producto.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-3" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$producto->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Estatus:</b>
						</div>
						<div class="col-9">
							{{$producto->estatus}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Nombre:</b>
						</div>
						<div class="col-9">
							{{$producto->name}}
							@if($producto->outstanding)
								&nbsp;<span style="color:red">*producto destacado</span>
							@endif
						</div>
					</div>
	
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Slug:</b>
						</div>
						<div class="col-9">
							{{ $producto->slug }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>ISBN:</b>
						</div>
						<div class="col-9">
							{{$producto->isbn}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>País de origen:</b>
						</div>
						<div class="col-9">
							{{$producto->country->name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Año de publicación:</b>
						</div>
						<div class="col-9">
							{{$producto->year}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Autores:</b>
						</div>
						<div class="col-9">
							{{ $producto->authors_string }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Editoriales:</b>
						</div>
						<div class="col-9">
							{{ $producto->editorials_string }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Categoria:</b>
						</div>
						<div class="col-9">
							{{$producto->category_name}}
						</div>
					</div>

					
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Subcategoria:</b>
						</div>
						<div class="col-9">
							{{$producto->subcategory_name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Precio:</b>
						</div>
						<div class="col-9">
							{{$producto->price}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Stock:</b>
						</div>
						<div class="col-9">
							{{$producto->stock}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Descripción:</b>
						</div>
						<div class="col-10">
							{!! $producto->description !!}
						</div>
					</div>
					
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Tags:</b>
						</div>
						<div class="col-9">
							{{$producto->tags_string}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($producto->img_url)
								<img src="{{ $producto->img_url }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
										
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('producto.edit', $producto->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('producto.destroy', $producto->id) }}">
							
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
		return confirm('¿Desea eliminar este blog?');
	}
</script>
@endsection
