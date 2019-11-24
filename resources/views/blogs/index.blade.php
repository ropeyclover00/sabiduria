@extends('layouts.app')

@section('content')

<div class="row w-100">
	<div class="col-1"></div>
	<div class="col-10">
		<h3>Listado de blogs</h3>
		<hr>
		<a class="btn btn-success btn-sm" href="{{ route('blog.create') }}">
			<i class="fa fa-plus"></i>
			Agregar nuevo blog
		</a>
		<br><br>
		
		@if(count($blogs))

		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Autor</th>
					<th scope="col">Categoria</th>
					<th scope="col">Subcategoria</th>
					<th></th>
					<th scope="col">Acciones</th>
				</tr>

			</thead>
			<tbody>
				@foreach($blogs as $blog)
					<tr>
						<th scope="row">{{$blog->id}}</th>
						<td>{{$blog->name}}</td>
						<td>{{$blog->author_name}}</td>
						<td>{{$blog->category_name}}</td>
						<td>{{$blog->subcategory_name}}</td>
						<td>
							@if($blog->img_url)
								<img src="{{ $blog->img_url }}" alt="" width="70px">
							@else
							-
							@endif
						</td>
						<td><a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-info"> Ver Detalles</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>		
		{{ $blogs->links() }}
		@else
		<h4 style="color:blue">No hay información en la base de datos.</h4>
		@endif
	</div>
</div>

@endsection