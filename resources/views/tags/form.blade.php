@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">
            		Formulario de tags
					<a class="float-right" href="{{route('tag.index')}}">Regresar</a> 
            	</div>
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
					<!-- Formulario --->
					@if(isset($tag))
					{!! Form::model($tag, ['route' => ['tag.update', $tag->id], 'files' => true]) !!}
					<!--<form action="{{ route('tag.update', $tag->id) }}" method="POST">-->
						<input type="hidden" name="_method" value="PATCH">
					@else
					<!--<form action="{{ route('tag.store') }}" method="POST">-->
					{!! Form::open(['route' => 'tag.store', 'files' => true]) !!}
					@endif
						@csrf
						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="name">	Nombre </label>
							<div class="col-md-8">
								<input id="name" 
									   type="text" 
									   name="name" 
									   value="{{ $tag->name ?? '' }}{{ old('name') }}" 
									   class="form-control"
									   required>

							</div>
						</div>	

						<div class="form-group row">	
							<label class="col-md-3 col-form-label text-md-right" for="description">	Descripción </label>
							<div class="col-md-8">
								<textarea class="form-control" 
										  name="description" 
										  id="description" 
										  rows="4"
										  >{{ $tag->description ?? '' }}{{old('description')}}</textarea>
							</div>
						</div>	

					
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
					<!--</form>-->
					{!! Form::close() !!}
					<!-- Fin Formulario -->
        		
            	</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
	$(function(){
		
		CKEDITOR.config.height = 400;
		CKEDITOR.config.width = 'auto';
		CKEDITOR.replace('description');
	})

	
	
</script>

@endsection