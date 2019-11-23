@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de tags</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('tag.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nuevo tag
		</a>
		<br><br>
		
		@if(count($tags))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($tags as $tag)
					<tr>
						<th scope="row">{{$tag->id}}</th>
						<td>{{$tag->name}}</td>
						
						<td><a href="{{ route('tag.show', $tag->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $tags->links() }}		
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection