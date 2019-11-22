@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de categorias</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('categoria.create') }}">Agregar nueva categoria</a>
		<br><br>
		
		@if(count($categories))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<th scope="row">{{$category->id}}</th>
						<td>{{$category->name}}</td>
						<td>
							@if($category->imgUrl)
								<img src="{{ $category->imgUrl }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('categoria.show', $category->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
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