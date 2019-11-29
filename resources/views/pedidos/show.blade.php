@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Datos del pedido 
            		<a class="float-right" href="{{route('pedido.index')}}">Regresar</a> 
            	</div>

				@if ($errors->any())
				<div class="alert alert-danger">
				    <ul>
				        @foreach ($errors->all() as $error)
				            <li>{{ $error }}</li>
				        @endforeach
				    </ul>
				</div>
				@endif

            	<div class="card-body">

            		<!-- Nav tabs -->
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  
					  <li class="nav-item">
					    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
					    	Información básica
					    </a>
					  </li>
					  
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Productos del pedido</a>
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
								{{$pedido->id}}
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Estatus:</b>
							</div>
							<div class="col-9">
								<form action="{{ route('pedido.update', $pedido->id) }}" method="POST">
									<input type="hidden" name="_method" value="PATCH">
									@csrf
									<select name="status" id="status">
										<option>Seleccione una opción</option>
										@foreach($estados as $key => $estado)
										<option value="{{$key}}"
											@if($pedido->status == $key)
												selected
											@endif
										>
											{{$estado}}
										</option>
										@endforeach
									</select>
									<input type="submit" class="btn btn-sm btn-success" value="Aceptar">
								</form>
								
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Cliente:</b>
							</div>
							<div class="col-9">
								{{$pedido->client_name}}
							</div>
						</div>
		
						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Subtotal:</b>
							</div>
							<div class="col-9">
								${{ number_format($pedido->subtotal, 2, '.', ',') }} MXN
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Costo de envío:</b>
							</div>
							<div class="col-9">
								{{number_format($pedido->shipping_cost, 2, '.', ',')}}
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Total:</b>
							</div>
							<div class="col-9">
								${{ number_format($pedido->total, 2, '.', ',') }} MXN
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Calle:</b>
							</div>
							<div class="col-9">
								{{ $pedido->street ?? 'N/A' }}
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Número exterior:</b>
							</div>
							<div class="col-9">
								{{ $pedido->num_ext ?? 'N/A' }}
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Número interior:</b>
							</div>
							<div class="col-9">
								{{ $pedido->num_int ?? 'N/A' }}
							</div>
						</div>

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Entre calles:</b>
							</div>
							<div class="col-9">
								{{ $pedido->between_streets ?? 'N/A' }}
							</div>
						</div>						

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Colonia:</b>
							</div>
							<div class="col-9">
								{{ $pedido->neighborhood ?? 'N/A' }}
							</div>
						</div>						

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Código Postal:</b>
							</div>
							<div class="col-9">
								{{ $pedido->postal_code ?? 'N/A' }}
							</div>
						</div>	

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Ciudad:</b>
							</div>
							<div class="col-9">
								{{ $pedido->city_name ?? 'N/A' }}
							</div>
						</div>	

						<div class="row w-100 mt-4">
							<div class="col-3" style="text-align: right;">
								<b>Estado:</b>
							</div>
							<div class="col-9">
								{{ $pedido->state_name ?? 'N/A' }}
							</div>
						</div>						
											
						<div class="row mt-4">
						
							
							<div class="col-2">
								<form 	method="POST" 
								onsubmit="return confirmacion()" 
								action="{{ route('pedido.destroy', $pedido->id) }}">
								
									@method("DELETE")
									@csrf
									<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
								</form>		
							</div>

						</div>
					</div>


	    			<div class="tab-pane fade mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						@if(count($pedido->details))
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th></th>
										<th>Producto</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									@foreach($pedido->details as $detail)
										<tr>
											<td>
												@if($detail->product->img_url)
													<img src="{{ $detail->product->img_url }}" alt="" width="70px">
												@else
												-
												@endif
											</td>
											<td>{{ $detail->product->name }}</td>
											<td>{{ $detail->quantity }}</td>
											<td>{{ $detail->price_format }}</td>
											<td>{{ $detail->total_format }}</td>

										</tr>
									@endforeach
								</tbody>
							</table>
						@else
						<h4>No hay datos</h4>
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
		return confirm('¿Desea eliminar este pedido?');
	}

	

</script>
@endsection
