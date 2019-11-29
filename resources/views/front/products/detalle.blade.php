@extends('layouts.template')

@section('content')
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<span class="stext-109 cl8 hov-cl1 trans-04">
				Categoria
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

			<span class="stext-109 cl8 hov-cl1 trans-04">
				{{$producto->category->name}}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

			<span class="stext-109 cl4">
				{{$producto->subcategory->name}}
			</span>
		</div>
	</div>
	
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								
								<div class="item-slick3" data-thumb="{{$producto->img_url}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{$producto->img_url}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{$producto->img_url}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{$producto->name}}
						</h4>

						<span class="mtext-106 cl2">
							${{$producto->price_format}}
						</span>

						<p class="stext-102 cl3 p-t-23">
							<b>ISBN:</b> {{$producto->isbn}}
						</p>

						<p class="stext-102 cl3 p-t-23">
							<b>Autores:</b> {{$producto->authors_string}}
						</p>

						<p class="stext-102 cl3 p-t-23">
							<b>Editoriales:</b> {{$producto->editorials_string}}
						</p>

						<p class="stext-102 cl3 p-t-23">
							<b>ISBN:</b> {{$producto->isbn}}
						</p>
						
						<!-- AÑADIR AL CARRITO  -->
						<div class="p-t-33">
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
								<form action="{{ route('carrito2', $producto->id) }}" onsubmit="return validaSesion()" method="POST">
									@csrf
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" >
										Añadir al carrito
									</button>
								</form>
								</div>
							</div>	
						</div>

						
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Descripción</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Comentarios ({{count($producto->comments)}})</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{!! $producto->description !!}
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										
										@if(!count($producto->comments))
											<center><h3>No hay comentarios</h3></center>
										@endif

										@foreach($producto->comments as $comment)
											<div class="flex-w flex-t p-b-68">
												<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
													<img src="{{$comment->user->img_url}}" alt="AVATAR">
												</div>

												<div class="size-207">
													<div class="flex-w flex-sb-m p-b-17">
														<span class="mtext-107 cl2 p-r-20">
															{{$comment->user_name}}
														</span>

														<span class="fs-18 cl11">
															@for($i = 0; $i < $comment->score; $i++)
																<i class="zmdi zmdi-star"></i>
															@endfor
															@for($i = $comment->score; $i < 5; $i++)
																<i class="zmdi zmdi-star-outline"></i>
															@endfor
															
														</span>
													</div>

													<p class="stext-102 cl6">
														{!! $comment->content !!}
													</p>
												</div>
											</div>
										@endforeach
										
										@if(Auth::user())
										<!-- Add review -->
										<form class="w-full" method="POST" action="{{ route('producto-comentario', $producto->id) }}">
											<h5 class="mtext-108 cl2 p-b-7">
												Añadir un comentario
											</h5>
											@csrf
											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Tu Calificación
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="score">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="content">Tu comentario</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="content" name="content"></textarea>
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Enviar
											</button>
										</form>
										@endif
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">

			<span class="stext-107 cl6 p-lr-25">
				Tags:
				@foreach($producto->tags as $tag)
					<a href="#">{{$tag->name}}</a> 
				@endforeach
			</span>
		</div>
	</section>


@endsection('content')

@section('script')
	<script>
		var sesion = @if(Auth::user()) @json(true) @else @json(false) @endif;
		
		function validaSesion ()
		{
			
			if(!sesion)
				swal("", "Debe iniciar sesion antes de añadir al carrito", "info");
				
			return sesion;
		}
	</script>
@endsection