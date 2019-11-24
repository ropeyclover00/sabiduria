@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos del blog 
            		<a class="float-right" href="{{route('blog.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

					<div class="row w-100">
						<div class="col-3" style="text-align: right;">
							<b>ID:</b>
						</div>
						<div class="col-9">
							{{$blog->id}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Estatus:</b>
						</div>
						<div class="col-9">
							{{$blog->estatus}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Nombre:</b>
						</div>
						<div class="col-9">
							{{$blog->name}}
						</div>
					</div>
	
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Slug:</b>
						</div>
						<div class="col-9">
							{{ $blog->slug }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Autor:</b>
						</div>
						<div class="col-9">
							{{ $blog->author_name }}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Categoria:</b>
						</div>
						<div class="col-9">
							{{$blog->category_name}}
						</div>
					</div>

					
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Subcategoria:</b>
						</div>
						<div class="col-9">
							{{$blog->subcategory_name}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-2" style="text-align: right;">
							<b>Contenido:</b>
						</div>
						<div class="row w-100" style="margin-left: 15px;">
							<div class="col-12 " style="border: solid thin; padding: 10px; ">
								{!! $blog->content !!}
							</div>	
						</div>						
					</div>
					
					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Tags:</b>
						</div>
						<div class="col-9">
							{{$blog->tags_string}}
						</div>
					</div>

					<div class="row w-100 mt-4">
						<div class="col-3" style="text-align: right;">
							<b>Imagen:</b>
						</div>
						<div class="col-9">
							@if($blog->img_url)
								<img src="{{ $blog->img_url }}" alt="" width="50%">
							@else
								N/A
							@endif
						</div>
					</div>
										
					<div class="row mt-4">
						<div class="offset-4 col-2">
							<a href="{{route('blog.edit', $blog->id)}}" class="btn btn-sm btn-info">
								Editar
							</a>
							
						</div>
						
						<div class="col-2">
							<form 	method="POST" 
							onsubmit="return confirmacion()" 
							action="{{ route('blog.destroy', $blog->id) }}">
							
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
