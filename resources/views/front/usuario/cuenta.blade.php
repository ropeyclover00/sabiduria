@extends('layouts.template')
@section('content')

<div class="row w-100">
<div class="col-12">
		

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
	
	
	<form action="{{ route('cuenta_update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
		
		<input type="hidden" name="id" value="{{Auth::user()->id}}">
	
		@csrf

		<!-- NOMBRE -->
		<div class="form-group row">	
			<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
			<div class="col-md-8">
				<input id="name" 
					   type="text" 
					   name="name" 
					   value="@if(empty(old('name'))){{ Auth::user()->name ?? '' }}@endif{{ old('name') }}" 
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
					   value="@if(empty(old('last_name'))){{ Auth::user()->last_name ?? '' }}@endif{{ old('last_name') }}" 
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
					   value="@if(empty(old('email'))){{ Auth::user()->email ?? '' }}@endif{{ old('email') }}" 
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
					   @if(empty(Auth::user())) required @endif>
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
					   value="@if(empty(old('address'))){{ Auth::user()->address ?? '' }}@endif{{ old('address') }}" 
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
					   value="@if(empty(old('exterior_number'))){{ Auth::user()->exterior_number ?? '' }}@endif{{ old('exterior_number') }}" 
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
					   value="@if(empty(old('interior_number'))){{ Auth::user()->interior_number ?? '' }}@endif{{ old('interior_number') }}" 
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
					   value="@if(empty(old('between_streets'))){{ Auth::user()->between_streets ?? '' }}@endif{{ old('between_streets') }}" 
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
					   value="@if(empty(old('suburb'))){{ Auth::user()->suburb ?? '' }}@endif{{ old('suburb') }}" 
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
					   value="@if(empty(old('postal_code'))){{ Auth::user()->postal_code ?? '' }}@endif{{ old('postal_code') }}" 
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
					   value="@if(empty(old('phone'))){{ Auth::user()->phone ?? '' }}@endif{{ old('phone') }}" 
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
					   value="@if(empty(old('cellphone'))){{ Auth::user()->cellphone ?? '' }}@endif{{ old('cellphone') }}" 
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
							@if( (!empty(Auth::user()) && Auth::user()->state_id == $state->id ) || old('state_id') == $state->id) 
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
	</form>
	
	<!-- Fin Formulario -->

	@if(isset(Auth::user()->image))
	<div class="row mt-5">
		<div class="col-10 offset-1">
			<h5>Imagen Actual:</h5>
			<img src="{{Auth::user()->img_url}}" alt="" width="40%">
		</div>
	</div>
	@endif
</div>


</div>
</div>
	
@endsection

@section('script')
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script type="text/javascript">
	
	var estados = @json($estados);
	var old_state_id = @json(old('state_id'));
	var state_id = @if(isset(Auth::user()->state_id)) @json(Auth::user()->state_id) @else '' @endif;
	var old_city_id = @json(old('city_id'));
	var city_id = @if(isset(Auth::user()->city_id)) @json(Auth::user()->city_id) @else '' @endif;
	

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