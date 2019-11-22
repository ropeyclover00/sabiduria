@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de Subcategorias
					<a class="float-right" href="{{route('subcategoria.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">
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
					@if(isset($subcategory))
					{!! Form::model($subcategory, ['route' => ['subcategoria.update', $subcategory->id], 'files' => true]) !!}
					<!--<form action="{{ route('subcategoria.update', $subcategory->id) }}" method="POST">-->
						<input type="hidden" name="_method" value="PATCH">
					@else
					<!--<form action="{{ route('subcategoria.store') }}" method="POST">-->
					{!! Form::open(['route' => 'subcategoria.store', 'files' => true]) !!}
					@endif
						@csrf
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
							<div class="col-md-8">
								<input id="name" 
									   type="text" 
									   name="name" 
									   value="{{ $subcategory->name ?? '' }}{{ old('name') }}" 
									   class="form-control"
									   required>

							</div>
						</div>	

						<div class="form-group row">
							<label class="col-md-3 col-form-label text-md-right" for="category_id">Categoria</label>
							<div class="col-8">
								<select class="form-control" name="category_id" id="category_id" required>
									<option value="null" 
										@if(empty($subcategory))
											selected
										@endif 
									>
										Seleccione una opción
									</option>
									@foreach($categories as $category)
										<option value="{{$category->id}}" 
											@if(!empty($subcategory) && $subcategory->category_id == $category->id) 
												selected @endif
										>
											{{$category->name}}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="description">	Descripción </label>
							<div class="col-md-8">
								<textarea class="form-control" 
										  name="description" 
										  id="description" 
										  rows="4"
										  >{{ $subcategory->description ?? '' }}{{old('description')}}</textarea>
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

					@if(isset($subcategory->imgUrl))
					<div class="row mt-5">
						<div class="col-10 offset-1">
							<h5>Imagen Actual:</h5>
							<img src="{{$subcategory->imgUrl}}" alt="" width="60%">
						</div>
					</div>
					@endif
        		
            	</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
	$(function(){
		
		//script para el nombre de la imagen
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});

		//script para el ckeditor
		CKEDITOR.config.height = 400;
		CKEDITOR.config.width = 'auto';
		CKEDITOR.replace('description');
	})

	
	
</script>

@endsection