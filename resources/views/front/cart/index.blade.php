@extends('layouts.template')

@section('content')
	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Producto</th>
									<th class="column-2"></th>
									<th class="column-3">Precio</th>
									<th class="column-3">Cantidad</th>
									<th class="column-5">Total</th>
									<th></th>
								</tr>

								@if(!count($carts))
								<tr>
									<td colspan="6">No hay productos en su carrito.</td>
								</tr>
								@endif

								@foreach($carts as $key => $cart)
								<tr class="table_row" id="row-{{ $key }}">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{$cart->product->img_url}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$cart->product->name}}</td>
									<td class="column-3">$ {{$cart->product->price_format}}</td>
									<td class="column-3">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity[{{$key}}]" value="{{$cart->quantity}}" disabled style="width: 100%">
										</div>
									</td>
									<td class="column-5">$ {{ ($cart->quantity * $cart->product->price) }}</td>
									<td class="column-3">
										<form 	method="POST" 
										onsubmit="return confirmacion({{$key}})" 
										action="{{ route('carrito_destroy', $cart->id) }}">
										
											@method("DELETE")
											@csrf
											<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
										</form>		
									</td>
								</tr>
								@endforeach
								
							</table>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<form action="{{ route('pedido.store') }}" method="POST">
						@csrf
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Resumen
						</h4>

						@if ($errors->any())
						<div class="alert alert-danger mt-3">
						    <ul>
						        @foreach ($errors->all() as $error)
						            <li>{{ $error }}</li>
						        @endforeach
						    </ul>
						</div>
						@endif

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-417 w-full-ssm">
								<span class="stext-110 cl2">
									Datos de Envío:
								</span>
							</div>

							<div class="size-417 p-r-18 p-r-0-sm w-full-ssm">
								
								<div class="p-t-15">
									
									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="street" placeholder="Calle" value="{{Auth::user()->address}}">
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="num_ext" placeholder="No. Exterior" value="{{Auth::user()->exterior_number}}">
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="num_int" placeholder="No. Interior" value="{{Auth::user()->interior_number}}">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="between_streets" placeholder="Entre calles" value="{{Auth::user()->between_streets}}">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="neighborhood" placeholder="Colonia" value="{{Auth::user()->suburb}}">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postal_code" placeholder="Código postal" value="{{Auth::user()->postal_code}}">
									</div>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="state_id" id="state_id">
											<option>Seleccione un estado</option>
											@foreach($estados as $state)
												<option value="{{ $state->id }}" @if(Auth::user()->state_id == $state->id) selected @endif>
													{{$state->name}}
												</option>
											@endforeach
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="city_id" id="city_id">
											<option>Seleccione un municipio</option>
											@foreach($estados as $state)
												<option value="{{ $state->id }}" @if(Auth::user()->state_id == $state->id) selected @endif>
													{{$state->name}}
												</option>
											@endforeach
										</select>
										<div class="dropDownSelect2"></div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									{{$total}}
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
							Realizar Pedido
						</button>

					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
		
@endsection

@section('script')
	<script>
	
		var estados = @json($estados);
		var old_state_id = @json(old('state_id'));
		var state_id = @if(isset(Auth::user()->state_id)) @json(Auth::user()->state_id) @else '' @endif;
		var old_city_id = @json(old('city_id'));
		var city_id = @if(isset(Auth::user()->city_id)) @json(Auth::user()->city_id) @else '' @endif;

		$(function(){
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
						for (var j = 0; j < ciudades.length; j++) {
							
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
		})

		function confirmacion(key)
		{
			var conf = confirm("¿Seguro desea eliminar este articulo?");
			return conf;
		}
	</script>
@endsection