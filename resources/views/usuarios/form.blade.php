@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de Usuarios
					<a class="float-right" href="{{route('usuario.index')}}">Regresar</a> 
            	</div>
            	<div class="card-body">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
				    	Información básica
				    </a>
				  </li>
				  @if(!empty($usuario))
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
						@if(isset($usuario))
						{!! Form::model($usuario, ['route' => ['usuario.update', $usuario->id], 'files' => true]) !!}
						<!--<form action="{{ route('usuario.update', $usuario->id) }}" method="POST">-->
							<input type="hidden" name="_method" value="PATCH">
							<input type="hidden" name="id" value="{{$usuario->id}}">
						@else
						<!--<form action="{{ route('usuario.store') }}" method="POST">-->
						{!! Form::open(['route' => 'usuario.store', 'files' => true]) !!}
						@endif
							@csrf

							<!-- ROL -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="rol">Rol</label>
								<div class="col-8">
									<select class="form-control" name="rol" id="rol" required>
										<option> Seleccione una opción </option>
										@foreach($roles as $rol)
											<option value="{{$rol['id']}}" 
												@if( (!empty($usuario) && $usuario->rol == $rol['id']) || old('status') === $rol['id'])  
													selected @endif
											>
												{{$rol['name']}}
											</option>
										@endforeach
									</select>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>						

							<!-- NOMBRE -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
								<div class="col-md-8">
									<input id="name" 
										   type="text" 
										   name="name" 
										   value="@if(empty(old('name'))){{ $usuario->name ?? '' }}@endif{{ old('name') }}" 
										   class="form-control"
										   required>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- APELLIDO -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="name">	
									Apellido
								</label>
								<div class="col-md-8">
									<input id="last_name" 
										   type="text" 
										   name="last_name" 
										   value="@if(empty(old('last_name'))){{ $usuario->last_name ?? '' }}@endif{{ old('last_name') }}" 
										   class="form-control"
										   required>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- EMAIL -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="email">	
									Email
								</label>
								<div class="col-md-8">
									<input id="email" 
										   type="text" 
										   name="email" 
										   value="@if(empty(old('email'))){{ $usuario->email ?? '' }}@endif{{ old('email') }}" 
										   class="form-control"
										   required>
									<span style="font-size: .8rem; color: red;">*campo obligatorio</span>
								</div>
							</div>	

							<!-- PASSWORD -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="password">	
									Password
								</label>
								<div class="col-md-8">
									<input id="password" 
										   type="password" 
										   name="password" 
										   value="" 
										   class="form-control"
										   @if(empty($usuario)) required @endif>
								</div>
							</div>	

							<!-- DIRECCION -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="address">	
									Calle
								</label>
								<div class="col-md-8">
									<input id="address" 
										   type="text" 
										   name="address" 
										   value="@if(empty(old('address'))){{ $usuario->address ?? '' }}@endif{{ old('address') }}" 
										   class="form-control"
										   >
								</div>
							</div>	

							<!-- No. exterior -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="exterior_number">
									No. Exterior
								</label>
								<div class="col-md-8">
									<input id="exterior_number" 
										   type="text" 
										   name="exterior_number" 
										   value="@if(empty(old('exterior_number'))){{ $usuario->exterior_number ?? '' }}@endif{{ old('exterior_number') }}" 
										   class="form-control"
										   >
								</div>
							</div>	

							<!-- No interior -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="interior_number">
									No. Interior
								</label>
								<div class="col-md-8">
									<input id="interior_number" 
										   type="text" 
										   name="interior_number" 
										   value="@if(empty(old('interior_number'))){{ $usuario->interior_number ?? '' }}@endif{{ old('interior_number') }}" 
										   class="form-control"
										   >
								</div>
							</div>	
	
							<!-- Entre calles -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="between_streets">	
									Entre Calles
								</label>
								<div class="col-md-8">
									<input id="between_streets" 
										   type="text" 
										   name="between_streets" 
										   value="@if(empty(old('between_streets'))){{ $usuario->between_streets ?? '' }}@endif{{ old('between_streets') }}" 
										   class="form-control"
										   >
								</div>
							</div>
							
							<!-- COLONIA -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="suburb">	
									Colonia
								</label>
								<div class="col-md-8">
									<input id="suburb" 
										   type="text" 
										   name="suburb" 
										   value="@if(empty(old('suburb'))){{ $usuario->suburb ?? '' }}@endif{{ old('suburb') }}" 
										   class="form-control"
										   >
								</div>
							</div>	

							<!-- CP -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="postal_code">	
									Código Postal
								</label>
								<div class="col-md-8">
									<input id="postal_code" 
										   type="text" 
										   name="postal_code" 
										   value="@if(empty(old('postal_code'))){{ $usuario->postal_code ?? '' }}@endif{{ old('postal_code') }}" 
										   class="form-control"
										   >
								</div>
							</div>	

							<!-- TELEFONO -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="phone">	
									Telefono
								</label>
								<div class="col-md-8">
									<input id="phone" 
										   type="text" 
										   name="phone" 
										   value="@if(empty(old('phone'))){{ $usuario->phone ?? '' }}@endif{{ old('phone') }}" 
										   class="form-control"
										   >
								</div>
							</div>

							<!-- CELULAR -->
							<div class="form-group row">	
								<label class="col-md-3 col-form-label text-md-right" for="cellphone">	
									Celular
								</label>
								<div class="col-md-8">
									<input id="cellphone" 
										   type="text" 
										   name="cellphone" 
										   value="@if(empty(old('cellphone'))){{ $usuario->cellphone ?? '' }}@endif{{ old('cellphone') }}" 
										   class="form-control"
										   >
								</div>
							</div>	

							<!-- ESTADO -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="state_id">Estado</label>
								<div class="col-8">
									<select class="form-control" name="state_id" id="state_id" >
										<option value="">Seleccione una opción</option>
										@foreach($estados as $state)
											<option value="{{$state->id}}" 
												@if( (!empty($usuario) && $usuario->state_id == $state->id ) || old('state_id') == $state->id) 
													selected @endif
											>
												{{$state->name}}
											</option>
										@endforeach
									</select>
									
								</div>
							</div>	

							<!-- CIUDAD -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right" for="city_id">Ciudad</label>
								<div class="col-8">
									<select class="form-control" name="city_id" id="city_id" >
										<option value="">Seleccione una opción</option>
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

						@if(isset($usuario->image))
						<div class="row mt-5">
							<div class="col-10 offset-1">
								<h5>Imagen Actual:</h5>
								<img src="{{$usuario->img_url}}" alt="" width="60%">
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
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script type="text/javascript">
	
	var estados = @json($estados);
	var old_state_id = @json(old('state_id'));
	var state_id = @if(isset($usuario->state_id)) @json($usuario->state_id) @else '' @endif;
	var old_city_id = @json(old('city_id'));
	var city_id = @if(isset($usuario->city_id)) @json($usuario->city_id) @else '' @endif;
	

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

		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});

		$('#state_id').change(function(){
			var option = this.value;
			setCities(option);
		});

		if(old_state_id)
			setCities(old_state_id);
		else if(state_id !== "")
			setCities(state_id);

		function setCities(option)
		{
			var selectSub = $('#city_id');
			selectSub.html("");
			selectSub.append('<option value="">Seleccione una opción</option>');

			for (var i = estados.length - 1; i >= 0; i--) {
				if(estados[i].id == parseInt(option))
				{
					var ciudades = estados[i].cities;
					for (var j = ciudades.length - 1; j >= 0; j--) {
						
						var selected = "";
						if(old_city_id != 'null')
							if(ciudades[j].id == old_city_id)
								selected = "selected";
							else if(ciudades[j].id == city_id)
								selected = "selected";
						else 
						{
							if(ciudades[j].id == city_id)
								selected = "selected";
						}

						selectSub.append('<option value="' + ciudades[j].id + '" ' + selected +'>' + ciudades[j].name + '</option>');						
					}
					break;
				}
			}
		}

	

	});

	function confirmacion(id)
	{
		

		return confirm('¿Seguro que desea eliminar este archivo?')
		
	}
	
</script>

@endsection