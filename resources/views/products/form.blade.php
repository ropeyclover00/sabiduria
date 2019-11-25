@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de productos
					<a class="float-right" href="{{route('producto.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
				    	Información básica
				    </a>
				  </li>
				  @if(!empty($producto))
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
						<!-- Formulario -->
						@if(isset($producto))
						{!! Form::model($producto, ['route' => ['producto.update', $producto->id], 'files' => true]) !!}
						<!--<form action="{{ route('producto.update', $producto->id) }}" method="POST">-->
							<input type="hidden" name="_method" value="PATCH">
						@else
						<!--<form action="{{ route('producto.store') }}" method="POST">-->
						{!! Form::open(['route' => 'producto.store', 'files' => true]) !!}
						@endif
							@csrf

							<!-- 1. STATUS -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="status">Estatus</label>
								<div class="col-8">
									<select class="form-control" name="status" id="status" required>
										<option 
											@if(empty($producto))
												selected
											@endif 
										>
											Seleccione una opción
										</option>
										@foreach($estados as $estado)
											<option value="{{$estado['id']}}" 
												@if( (!empty($producto) && $producto->status == $estado['id']) || old('status') === $estado['id'])  
													selected @endif
											>
												{{$estado['name']}}
											</option>
										@endforeach
									</select>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>		

							<!-- 10. DESTACADO -->
							<div class="form-check mb-3">
								<div class="row">
									<div class="col-8 offset-2">
										<input  type="checkbox" 
												value="1" 
												@if( !empty($producto) && $producto->outstanding )
													checked
												@endif 
												class="form-check-input" 
												id="outstanding" 
												name="outstanding"
										>
							    		<label class="form-check-label" for="outstanding">Destacado</label>	
									</div>
								</div>
		      				</div>				

							<!-- 2. NOMBRE -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
								<div class="col-md-8">
									<input id="name" 
										   type="text" 
										   name="name" 
										   value="@if(empty(old('name'))){{ $producto->name ?? '' }}@endif{{ old('name') }}" 
										   class="form-control"
										   required>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- 3. ISBN -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="isbn">	
									ISBN
								</label>
								<div class="col-md-8">
									<input id="isbn" 
										   type="text" 
										   name="isbn" 
										   value="@if(empty(old('isbn'))){{ $producto->isbn ?? '' }}@endif{{ old('isbn') }}" 
										   class="form-control"
										   required>
								    <span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>

							<!-- 4. AÑO -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="year">	
									Año de publicación
								</label>
								<div class="col-md-8">
									<input id="year" 
										   type="text" 
										   name="year" 
										   value="@if(empty(old('year'))){{ $producto->year ?? '' }}@endif{{ old('year') }}" 
										   class="form-control"
										   required>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- 5. PAÍS -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="country_id">
									País
								</label>
								<div class="col-8">
									<select class="form-control" name="country_id" id="country_id" required>
										<option>Seleccione una opción</option>
										@foreach($countries as $country)
											<option value="{{$country->id}}" 
												@if( (!empty($producto) && $producto->country_id == $country->id ) || old('country_id') == $country->id) 
													selected @endif
											>
												{{$country->name}}
											</option>
										@endforeach
									</select>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- 6. CATEGORIA -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="category_id">Categorias</label>
								<div class="col-8">
									<select class="form-control" name="category_id" id="category_id" required>
										<option>Seleccione una opción</option>
										@foreach($categories as $category)
											<option value="{{$category->id}}" 
												@if( (!empty($producto) && $producto->category_id == $category->id ) || old('category_id') == $category->id) 
													selected @endif
											>
												{{$category->name}}
											</option>
										@endforeach
									</select>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- 7. SUBCATEGORIA -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="subcategory_id">Subcategoria</label>
								<div class="col-8">
									<select class="form-control" name="subcategory_id" id="subcategory_id" required>
										<option 
											@if(empty($producto))
												selected
											@endif 
										>
											Seleccione una opción
										</option>
										
									</select>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- 8. PRECIO -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="price">	
									Precio
								</label>
								<div class="col-md-8">
									<input id="price" 
										   type="text" 
										   name="price" 
										   value="@if(empty(old('price'))){{ $producto->price ?? '' }}@endif{{ old('price') }}" 
										   class="form-control"
										   required>
								   <span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
								
							</div>

							<!-- 9. STOCK -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="stock">	
									Stock
								</label>
								<div class="col-md-8">
									<input id="stock" 
										   type="text" 
										   name="stock" 
										   value="@if(empty(old('stock'))){{ $producto->stock ?? '' }}@endif{{ old('stock') }}" 
										   class="form-control"
										   required>
								    <span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>

							<!-- 11. EDITORIALES -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="editorials">Editoriales</label>
								<div class="col-8">
									<select class="form-control" name="editorials[]" multiple="multiple" id="editorials">
									</select>
								</div>
							</div>	

							<!-- 12. AUTORES -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="authors">
									Autores
								</label>
								<div class="col-8">
									<select class="form-control" name="authors[]" multiple="multiple" id="authors">
									</select>
								</div>
							</div>	

							<!-- 13. TAGS -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="tags">Tags</label>
								<div class="col-8">
									<select class="form-control" name="tags[]" multiple="multiple" id="tags">
									</select>
								</div>
							</div>	

							<!-- 14. DESCRIPCION -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="description">
									Descripción
								</label>
							</div>
							<div class="form-group row">
								<div class="row">
									<div class="col-md-12 offset-1">
										<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
										<textarea class="form-control" 
												  name="description" 
												  id="contenido" 
												  rows="4"
												  > @if(empty(old('description'))){{ $producto->description ?? '' }}@endif{{old('description')}}</textarea>
									</div>	
								</div>
							</div>	

							<!-- 15. IMAGEN -->							
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

						@if(isset($producto->image))
						<div class="row mt-5">
							<div class="col-10 offset-1">
								<h5>Imagen Actual:</h5>
								<img src="{{$producto->img_url}}" alt="" width="60%">
							</div>
						</div>
						@endif
					</div>

	    			<div class="tab-pane fade mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	    				
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
	var category_id = @if(isset($producto->category_id)) @json($producto->category_id) @else '' @endif;
	var old_subcategory_id = @json(old('subcategory_id'));
	var subcategory_id = @if(isset($producto->subcategory_id)) @json($producto->subcategory_id) @else '' @endif;
	
	var old_tags = @json(old('tags'));
	var tags = @json($tags);
	var tags_producto = @if(!empty($producto)) @json($producto->tags_ids) @else null @endif;

	var old_editorials = @json(old('editorials'));
	var editorials = @json($editorials);
	var editorials_producto = @if(!empty($producto)) @json($producto->editorials_ids) @else null @endif;

	var old_authors = @json(old('authors'));
	var authors = @json($authors);
	var authors_producto = @if(!empty($producto)) @json($producto->authors_ids) @else null @endif;

	/*Dropzone.options.dropzone = {
		init: function() {
			this.on("success", function(file) { this.removeFile(file) });
		}
	}*/

	$(function(){

		$('#myTab a').on('click', function (e) {
			e.preventDefault()
			$(this).tab('show')
		})

		setTags();
		$('#tags').select2();

		setEditorials();
		$('#editorials').select2();

		setAuthors();
		$('#authors').select2();

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
				
				tags_producto = old_tags;
			}

			for (var i = 0; i < tags.length; i++) {
				var selected = "";
				
				if(tags_producto && tags_producto.indexOf(tags[i].id) != -1)
						selected = 'selected';

				tagSelect.append('<option value="' + tags[i].id + '" ' + selected +'>' + tags[i].name + '</option>');	
			}
		}

		function setEditorials()
		{
			var editorialSelect = $('#editorials');
			editorialSelect.html('');

			if(old_editorials != null)
			{
				for (var i = old_editorials.length - 1; i >= 0; i--) 
					old_editorials[i] = parseInt(old_editorials[i]);
				
				editorials_producto = old_editorials;
			}

			for (var i = 0; i < editorials.length; i++) {
				var selected = "";
				
				if(editorials_producto && editorials_producto.indexOf(editorials[i].id) != -1)
						selected = 'selected';

				editorialSelect.append('<option value="' + editorials[i].id + '" ' + selected +'>' + editorials[i].name + '</option>');	
			}
		}

		function setAuthors()
		{
			var authorSelect = $('#authors');
			authorSelect.html('');

			if(old_authors != null)
			{
				for (var i = old_authors.length - 1; i >= 0; i--) 
					old_authors[i] = parseInt(old_authors[i]);
				
				authors_producto = old_authors;
			}

			for (var i = 0; i < authors.length; i++) {
				var selected = "";
				
				if(authors_producto && authors_producto.indexOf(authors[i].id) != -1)
						selected = 'selected';

				authorSelect.append('<option value="' + authors[i].id + '" ' + selected +'>' + authors[i].name + ' ' + authors[i].last_name +'</option>');	
			}
		}

	});

	function confirmacion(id)
	{
		return confirm('¿Seguro que desea eliminar este archivo?');
	}
	
</script>

@endsection