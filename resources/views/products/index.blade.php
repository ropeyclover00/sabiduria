@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de Productos</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('producto.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nuevo producto
		</a>
		<br><br>
		
		@if(count($products))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">ISBN</th>
					<th scope="col">Categoria</th>
					<th scope="col">Subcategoria</th>
					<th></th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<th scope="row">{{$product->id}}</th>
						<td>{{$product->name}}</td>
						<td>{{$product->isbn}}</td>
						<td>{{$product->category_name}}</td>
						<td>{{$product->subcategory_name}}</td>
						<td>
							@if($product->img_url)
								<img src="{{ $product->img_url }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('producto.show', $product->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		{{ $products->links() }}
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection