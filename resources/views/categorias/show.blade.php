@extends('layouts.template')

@section('content')

<div class="row w-100">
	<div class="col-10 offset-1">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Referencia</th>
					<th scope="col">Descripción</th>
					<th scope="col">Slug</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				
				<tr>
					<th scope="row">{{$category->id}}</th>
					<td>{{$category->name}}</td>
					<td>{{$category->reference }}</td>
					<td>{{$category->description }}</td>
					<td>{{$category->slug }}</td>
					<td>
						<form method="POST" action="{{ route('categoria.destroy', $category->id) }}">
							<!--<input type="hidden" name="_method" value="DELETE">-->
							@method("DELETE")
							@csrf
							<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
						</form>
						<a href="{{route('categoria.edit', $category->id)}}" class="btn btn-sm btn-info">Editar</a>
					</td>
				</tr>
				
			</tbody>
			</table>		
	</div>
</div>

@endsection
