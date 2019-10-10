@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">Formulario de Categorias</div>
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
					@if(isset($category))
					<form action="{{ route('categoria.update', $category->id) }}" method="POST">
						<input type="hidden" name="_method" value="PATCH">
					@else
					<form action="{{ route('categoria.store') }}" method="POST">
					@endif
						@csrf
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
							<div class="col-md-8">
								<input id="name" 
									   type="text" 
									   name="name" 
									   value="{{ $category->name ?? '' }}{{ old('name') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	

						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="description">	Descripción </label>
							<div class="col-md-8">
								<textarea class="form-control" 
										  name="description" 
										  id="description" 
										  rows="4"
										  required>{{ $category->description ?? '' }}{{old('description')}}</textarea>
							</div>
						</div>	

						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="reference">	Referencia </label>
							<div class="col-md-8">
								<input id="reference" 
									   type="number" 
									   name="reference" 
									   value="{{ $category->reference ?? '' }}{{ old('reference') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	

						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="slug">	Slug </label>
							<div class="col-md-8">
								<input id="slug" 
									   type="text" 
									   name="slug" 
									   value="{{ $category->slug ?? '' }}{{ old('slug') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	

						 <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
					</form>
					<!-- Fin Formulario -->
        		
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection
