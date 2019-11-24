@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de  
					<a class="float-right" href="{{route('autor.index')}}">Regresar</a> 
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
					@if(isset($autor))
					{!! Form::model($autor, ['route' => ['autor.update', $autor->id], 'files' => true]) !!}
					<!--<form action="{{ route('autor.update', $autor->id) }}" method="POST">-->
						<input type="hidden" name="_method" value="PATCH">
					@else
					<!--<form action="{{ route('autor.store') }}" method="POST">-->
					{!! Form::open(['route' => 'autor.store', 'files' => true]) !!}
					@endif
						@csrf
						<!-- NOMBRE -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
							<div class="col-md-8">
								<input id="name" 
									   type="text" 
									   name="name" 
									   value="{{ $autor->name ?? '' }}{{ old('name') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	

						<!-- NOMBRE -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="last_name">	Apellidos </label>
							<div class="col-md-8">
								<input id="last_name" 
									   type="text" 
									   name="last_name" 
									   value="{{ $autor->last_name ?? '' }}{{ old('last_name') }}" 
									   class="form-control"
									   required>
							</div>
						</div>	
	
						<!-- FECHA DE NACIMIENTO -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="birthday">	Fecha de Nacimiento </label>
							<div class="col-md-8">
								<input id="birthday" 
									   type="date" 
									   name="birthday" 
									   value="{{ isset($autor->birthday) ? $autor->birthday->format('Y-m-d') : '' }}{{ old('birthday') }}" 
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
										  >{{ $autor->address ?? '' }}{{old('address')}}</textarea>
							</div>
						</div>	


						<!-- EMAIL -->
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="email">	Email </label>
							<div class="col-md-8">
								<input id="email" 
									   type="email" 
									   name="email" 
									   value="{{ $autor->email ?? '' }}{{ old('email') }}" 
									   class="form-control">
							</div>
						</div>	

						<!-- PAIS -->
						<div class="form-group row">
							<label class="col-md-3 col-form-label text-md-right" for="country_id">País</label>
							<div class="col-8">
								<select class="form-control" name="country_id" id="country_id" required>
									<option value="null" 
										@if(empty($autor))
											selected
										@endif 
									>
										Seleccione una opción
									</option>
									@foreach($countries as $country)
										<option value="{{$country->id}}" 
											@if(!empty($autor) && $autor->country_id == $country->id) 
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

					@if(isset($autor->img_url))
					<div class="row mt-5">
						<div class="col-10 offset-1">
							<h5>Imagen Actual:</h5>
							<img src="{{$autor->img_url}}" alt="" width="60%">
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