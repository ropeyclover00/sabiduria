@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de autores</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('autor.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nuevo autor
		</a>
		<br><br>
		
		@if(count($authors))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre Completo</th>
					<th scope="col">Dirección</th>
					<th scope="col">Email</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($authors as $author)
					<tr>
						<th scope="row">{{$author->id}}</th>
						<td>{{$author->full_name}}</td>
						<td>{{$author->address}}</td>
						<td>{{$author->email}}</td>
						<td>
							@if($author->img_url)
								<img src="{{ $author->img_url }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('autor.show', $author->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		{{ $authors->links() }}
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection