<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>

	</thead>
	<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{$category->id}}</td>
				<td>{{$categoty->name}}</td>
				<td><a href="{{ route('categoria.show', $categoria->id) }}" class="btn btn-sm btn-info"> Ver Detalle</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
