<div class="card-body">	
	@if ($errors->any())
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
	@endif

	@if(isset($category))
	<form action="{{ route('categoria.update', $category->id) }}" method="POST">
		<input type="hidden" name="_method" value="PATCH">
	@else
	<form action="{{ route('categoria.store') }}" method="POST">
	@endif
		@csrf
		<div class="form-group">	
				<label>	Nombre </label>
				<input type="text" name="name" value="{{ $categoria->name ?? '' }} {{ old('name') }}" class="form">
		</div>	
	</form>


algo	

</div>
