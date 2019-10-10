@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-10 offset-1">
		<a class="btn btn-success" href="{{ route('categoria.create') }}">Agregar nueva categoria</a>
		<br><br>
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Referencia</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<th scope="row">{{$category->id}}</th>
						<td>{{$category->name}}</td>
						<td>{{$category->reference }}</td>
						<td><a href="{{ route('categoria.show', $category->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
			</table>		
	</div>
</div>

@endsection