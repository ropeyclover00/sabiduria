{{$category->name}}

<table>
	<td>	
		<a href="{{route('categoria.edit', $category->id)}}" class="btn btn-sm btn-info">Editar</a>
	</td>

	<td>	
		<form method="POST" action="{{ route('categoria.destroy', $category-id) }}">
			<!--<input type="hidden" name="_method" value="DELETE">-->
			@method("DELETE")
			@csrf
			<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
		</form>
	</td>

</table>