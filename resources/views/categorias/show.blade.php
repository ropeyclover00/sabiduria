@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos de la categoria 
            		<a class="float-right" href="{{route('categoria.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-2" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$category->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Nombre:</b>
						</div>
						<div class="col-9">
							{{$category->name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Slug:</b>
						</div>
						<div class="col-9">
							{{$category->slug}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Descripción:</b>
						</div>
						<div class="col-10">
							{!! $category->description !!}
						</div>
					</div>
					
					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($category->imgUrl)
								<img src="{{ $category->imgUrl }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
					
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('categoria.edit', $category->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('categoria.destroy', $category->id) }}">
							
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
		return confirm('¿Desea eliminar esta categoria?');
	}
</script>
@endsection
