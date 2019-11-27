@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de Usuarios</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('usuario.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nuevo usuario
		</a>
		<br><br>
		
		@if(count($usuarios))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre Completo</th>
					<th scope="col">Email</th>
					<th scope="col">Rol</th>
					<th></th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($usuarios as $usuario)
					<tr>
						<th scope="row">{{$usuario->id}}</th>
						<td>{{$usuario->full_name}}</td>
						<td>{{$usuario->email}}</td>
						<td>{{$usuario->rol_name}}</td>
						
						<td>
							@if($usuario->img_url)
								<img src="{{ $usuario->img_url }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('usuario.show', $usuario->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		{{ $usuarios->links() }}
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection