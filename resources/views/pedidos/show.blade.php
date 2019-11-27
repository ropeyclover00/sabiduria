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
								{{$pedido->estado}}
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
										<th>Usuario</th>
										<th>Puntuación</th>
										<th>Comentario</th>
										<th>Fecha de publicación</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($pedido->details as $detail)
										<tr>
											<th>{{$detail->user_name}}</th>
											<th>{{$detail->score}} estrellas</th>
											<th>{{$detail->content}}</th>
											<th>{{ $detail->created_at->format('d-m-Y') }}</th>
											<th>
												<form 	method="POST" 
												onsubmit="return confirmacion_comentario()" 
												action="{{ route('comentario.destroy', $detail->id) }}">
												
													@method("DELETE")
													@csrf
													<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
												</form>	
											</th>
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
