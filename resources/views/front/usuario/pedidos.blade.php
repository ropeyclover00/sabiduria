@extends('layouts.template')

@section('content')

<div class="row w-100 mt-5 mb-5">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de Pedidos</h3>
		<hr>
		
		@if(count($pedidos))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Fecha de creación</th>
					<th scope="col">Total</th>
					<th scope="col">Estatus</th>
				</tr>

			</thead>
			<tbody>
				@foreach($pedidos as $pedido)
					<tr>
						<th scope="row">{{$pedido->id}}</th>
						<td>{{$pedido->created_at->format('d-m-Y')}}</td>
						<td>${{ number_format($pedido->total, 2, '.', ',')}} MXN</td>
						<td>{{$pedido->estado}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection