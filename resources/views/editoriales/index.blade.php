@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de editoriales</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('editorial.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nueva editorial
		</a>
		<br><br>
		
		@if(count($editorials))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Dirección</th>
					<th scope="col">Teléfono</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($editorials as $editorial)
					<tr>
						<th scope="row">{{$editorial->id}}</th>
						<td>{{$editorial->name}}</td>
						<td>{{$editorial->address}}</td>
						<td>{{$editorial->phone}}</td>
						<td>
							@if($editorial->img_url)
								<img src="{{ $editorial->img_url }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('editorial.show', $editorial->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		{{ $editorials->links() }}
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection