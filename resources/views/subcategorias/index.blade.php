@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de subcategorias</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('subcategoria.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nueva subcategoria
		</a>
		<br><br>
		
		@if(count($subcategories))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Categoria</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($subcategories as $subcategory)
					<tr>
						<th scope="row">{{$subcategory->id}}</th>
						<td>{{$subcategory->name}}</td>
						<td>{{$subcategory->category->name}}</td>
						
						<td>
							@if($subcategory->imgUrl)
								<img src="{{ $subcategory->imgUrl }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('subcategoria.show', $subcategory->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
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