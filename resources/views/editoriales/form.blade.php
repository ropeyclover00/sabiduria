@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de Editoriales
					<a class="float-right" href="{{route('editorial.index')}}">Regresar</a> 
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
					@if(isset($editorial))
					{!! Form::model($editorial, ['route' => ['editorial.update', $editorial->id], 'files' => true]) !!}
					<!--<form action="{{ route('editorial.update', $editorial->id) }}" method="POST">-->
						<input type="hidden" name="_method" value="PATCH">
					@else
					<!--<form action="{{ route('editorial.store') }}" method="POST">-->
					{!! Form::open(['route' => 'editorial.store', 'files' => true]) !!}
					@endif
						@csrf
						<!-- NOMBRE -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
							<div class="col-md-8">
								<input id="name" 
									   type="text" 
									   name="name" 
									   value="{{ $editorial->name ?? '' }}{{ old('name') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	

						<!-- DIRECCIÓN -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="address">	Dirección </label>
							<div class="col-md-8">
								<textarea class="form-control" 
										  name="address" 
										  id="address" 
										  rows="4"
										  >{{ $editorial->address ?? '' }}{{old('address')}}</textarea>
							</div>
						</div>	

						<!-- TELÉFONO -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="phone">	Teléfono </label>
							<div class="col-md-8">
								<input id="phone" 
									   type="text" 
									   name="phone" 
									   value="{{ $editorial->phone ?? '' }}{{ old('phone') }}" 
									   class="form-control"
									   required>
							</div>
						</div>							

						<!-- EMAIL -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="email">	Email </label>
							<div class="col-md-8">
								<input id="email" 
									   type="email" 
									   name="email" 
									   value="{{ $editorial->email ?? '' }}{{ old('email') }}" 
									   class="form-control">
							</div>
						</div>	

						<!-- URL -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="url">	Url </label>
							<div class="col-md-8">
								<input id="url" 
									   type="url" 
									   name="url" 
									   value="{{ $editorial->url ?? '' }}{{ old('url') }}" 
									   class="form-control">
							</div>
						</div>	

						<!-- PAIS -->
						<div class="form-group row">
							<label class="col-md-3 col-form-label text-md-right" for="country_id">País</label>
							<div class="col-8">
								<select class="form-control" name="country_id" id="country_id" required>
									<option value="null" 
										@if(empty($editorial))
											selected
										@endif 
									>
										Seleccione una opción
									</option>
									@foreach($countries as $country)
										<option value="{{$country->id}}" 
											@if(!empty($editorial) && $editorial->country_id == $country->id) 
												selected @endif
										>
											{{$country->name}}
										</option>
									@endforeach
								</select>
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

					@if(isset($editorial->img_url))
					<div class="row mt-5">
						<div class="col-10 offset-1">
							<h5>Imagen Actual:</h5>
							<img src="{{$editorial->img_url}}" alt="" width="60%">
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
<script>
	$(function(){
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	})
	
</script>

@endsection