@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de Blogs
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
				  @if(!empty($blog))
				  <li class="nav-item">
				    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Archivos</a>
				  </li>
				  @endif
				</ul>
				
				<!-- Tabs panes -->
				<div class="tab-content" id="myTabContent">
					
					<div class="tab-pane fade show active mt-3" id="home" role="tabpanel" aria-labelledby="home-tab">
						@if ($errors->any())
						<div class="alert alert-danger">
						    <ul>
						        @foreach ($errors->all() as $error)
						            <li>{{ $error }}</li>
						        @endforeach
						    </ul>
						</div>
						@endif
						<!-- Formulario --->
						@if(isset($blog))
						{!! Form::model($blog, ['route' => ['blog.update', $blog->id], 'files' => true]) !!}
						<!--<form action="{{ route('blog.update', $blog->id) }}" method="POST">-->
							<input type="hidden" name="_method" value="PATCH">
						@else
						<!--<form action="{{ route('blog.store') }}" method="POST">-->
						{!! Form::open(['route' => 'blog.store', 'files' => true]) !!}
						@endif
							@csrf

							<!-- STATUS -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="status">Estatus</label>
								<div class="col-8">
									<select class="form-control" name="status" id="status" required>
										<option 
											@if(empty($blog))
												selected
											@endif 
										>
											Seleccione una opción
										</option>
										@foreach($estados as $estado)
											<option value="{{$estado['id']}}" 
												@if( (!empty($blog) && $blog->status == $estado['id']) || old('status') === $estado['id'])  
													selected @endif
											>
												{{$estado['name']}}
											</option>
										@endforeach
									</select>
								</div>
							</div>						

							<!-- NOMBRE -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
								<div class="col-md-8">
									<input id="name" 
										   type="text" 
										   name="name" 
										   value="@if(empty(old('name'))){{ $blog->name ?? '' }}@endif{{ old('name') }}" 
										   class="form-control"
										   required>
								</div>
							</div>	

							<!-- CATEGORIA -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="category_id">Categorias</label>
								<div class="col-8">
									<select class="form-control" name="category_id" id="category_id" required>
										<option>Seleccione una opción {{old('category_id')}}</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}" 
												@if( (!empty($blog) && $blog->category_id == $category->id ) || old('category_id') == $category->id) 
													selected @endif
											>
												{{$category->name}}
											</option>
										@endforeach
									</select>
								</div>
							</div>	

							<!-- SUBCATEGORIA -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="subcategory_id">Subcategoria</label>
								<div class="col-8">
									<select class="form-control" name="subcategory_id" id="subcategory_id" required>
										<option 
											@if(empty($blog))
												selected
											@endif 
										>
											Seleccione una opción
										</option>
										
									</select>
								</div>
							</div>	

							<!-- AUTOR -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="user_id">Autor</label>
								<div class="col-8">
									<select class="form-control" name="user_id" id="user_id" required>
										<option>Seleccione una opción</option>
										@foreach($users as $user)
											<option value="{{$user->id}}" 
												@if( (!empty($blog) && $blog->user_id == $user->id) || old('user_id') == $user->id) 
													selected @endif
											>
												{{$user->formal_name}}
											</option>
										@endforeach
									</select>
								</div>
							</div>	

							<!-- TAGS -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="tags">Tags</label>
								<div class="col-8">
									<select class="form-control" name="tags[]" multiple="multiple" id="tags">
									</select>
								</div>
							</div>	
							
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="user_id">Contenido</label>
							</div>

							<!-- CONTENIDO -->
							<div class="form-group row">	
								

								<div class="row">
									<div class="col-md-12 offset-1">
										<textarea class="form-control" 
												  name="content" 
												  id="contenido" 
												  rows="4"
												  > @if(empty(old('content'))){{ $blog->content ?? '' }}@endif{{old('content')}}</textarea>
									</div>	
								</div>
								
							</div>	

							
							<div class="custom-file col-md-8 offset-3 mb-4" >
							    <input type="file" class="custom-file-input" id="customFileLang" name="file" lang="es">
							    <label class="custom-file-label" for="customFileLang">Elige una imagen</label>
							</div>
							
							<div class="form-group row mb-0">
		                        <div class="col-md-6 offset-md-4">
		                            <button type="submit" class="btn btn-primary">
		                                Guardar
		                            </button>
		                        </div>
		                    </div>
						<!--</form>-->
						{!! Form::close() !!}
						<!-- Fin Formulario -->

						@if(isset($blog->image))
						<div class="row mt-5">
							<div class="col-10 offset-1">
								<h5>Imagen Actual:</h5>
								<img src="{{$blog->img_url}}" alt="" width="60%">
							</div>
						</div>
						@endif
					</div>

	    			<div class="tab-pane fade mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	    				<h3>Suelta o selecciona los archvios:<br> pdf, word, excel o power point</h3>
	    				<div class="row">
	    					<div class="col-8 offset-2">
	    						<form action="{{ route('file_blog', $blog->id ?? null) }}" id="dropzone" class="dropzone" method="POST" enctype="multipart/form-data">
	    							@csrf
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
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{ asset('vendor/dropzone/min/dropzone.min.js')}}"></script>
<script type="text/javascript">
	
	var categorias = @json($categories);
	var old_category_id = @json(old('category_id'));
	var category_id = @if(isset($blog->category_id)) @json($blog->category_id) @else '' @endif;
	var old_subcategory_id = @json(old('subcategory_id'));
	var subcategory_id = @if(isset($blog->subcategory_id)) @json($blog->subcategory_id) @else '' @endif;
	var old_tags = @json(old('tags'));
	var tags = @json($tags);
	var tags_blog = @if(!empty($blog)) @json($blog->tags_ids) @else null @endif;


	Dropzone.options.dropzone = {
		init: function() {
			this.on("success", function(file) { this.removeFile(file) });
		}
	}

	$(function(){

		$('#myTab a').on('click', function (e) {
			e.preventDefault()
			$(this).tab('show')
		})

		setTags();
		$('#tags').select2();


		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});

		CKEDITOR.config.height = 400;
		CKEDITOR.config.width = 'auto';
		CKEDITOR.replace('contenido');

		$('#category_id').change(function(){
			var option = this.value;
			setSubcategories(option);
		});

		if(old_category_id)
			setSubcategories(old_category_id);
		else if(category_id !== "")
			setSubcategories(category_id);

		function setSubcategories(option)
		{
			var selectSub = $('#subcategory_id');
			selectSub.html("");
			selectSub.append('<option>Seleccione una opción</option>');

			for (var i = categorias.length - 1; i >= 0; i--) {
				if(categorias[i].id == parseInt(option))
				{
					var subcategorias = categorias[i].subcategories;
					for (var j = subcategorias.length - 1; j >= 0; j--) {
						
						var selected = "";
						if(old_subcategory_id != 'null')
							if(subcategorias[j].id == old_subcategory_id)
								selected = "selected";
							else if(subcategorias[j].id == subcategory_id)
								selected = "selected";
						else 
						{
							if(subcategorias[j].id == subcategory_id)
								selected = "selected";
						}

						selectSub.append('<option value="' + subcategorias[j].id + '" ' + selected +'>' + subcategorias[j].name + '</option>');						
					}
					break;
				}
			}
		}

		function setTags()
		{
			var tagSelect = $('#tags');
			tagSelect.html('');

			if(old_tags != null)
			{
				for (var i = old_tags.length - 1; i >= 0; i--) 
					old_tags[i] = parseInt(old_tags[i]);
				
				tags_blog = old_tags;
			}

			for (var i = 0; i < tags.length; i++) {
				var selected = "";
				
				if(tags_blog && tags_blog.indexOf(tags[i].id) != -1)
						selected = 'selected';

				tagSelect.append('<option value="' + tags[i].id + '" ' + selected +'>' + tags[i].name + '</option>');	
			}
		}
	})
	
</script>

@endsection