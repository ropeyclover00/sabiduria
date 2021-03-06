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
					
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
					    	Información básica
					    </a>
					  </li>
					  
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Comentarios</a>
					  </li>
					</ul>

					<!-- Tabs panes -->
					<div class="tab-content" id="myTabContent">
					
					<div class="tab-pane fade show active mt-3" id="home" role="tabpanel" aria-labelledby="home-tab">

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

						<h4 class="mt-4">Documentos cargados</h4>
	    				<div class="row w-100">
	    					@if(!count($blog->documents))
								<p>No hay documentos.</p>
	    					@endif
	    					@foreach($blog->documents as $doc)
								<div class="col-4">
									<a href="{!! $doc['url'] !!}"><i class="fa fa-file"></i>{!! $doc['name'] !!}</a>
								</div>
	    					@endforeach
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

					<div class="tab-pane fade mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						@if(count($blog->comments))
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Puntuación</th>
										<th>Comentario</th>
										<th>Fecha de publicación</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($blog->comments as $comment)
										<tr>
											<th>{{$comment->user_name}}</th>
											<th>{{$comment->score}} estrellas</th>
											<th>{{$comment->content}}</th>
											<th>{{ $comment->created_at->format('d-m-Y') }}</th>
											<th>
												<form 	method="POST" 
												onsubmit="return confirmacion_comentario()" 
												action="{{ route('comentario.destroy', $comment->id) }}">
												
													@method("DELETE")
													@csrf
													<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
												</form>	
											</th>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
						<h4>No hay comentarios</h4>
						@endif
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

	function confirmacion_comentario()
	{
		return confirm('¿Desea eliminar este comentario?');	
	}

</script>
@endsection
