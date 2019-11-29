@extends('layouts.template')

@section('content')
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<span  class="stext-109 cl8 hov-cl1 trans-04">
				Categoria
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

			<span class="stext-109 cl8 hov-cl1 trans-04">
				{{$blog->category->name}}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

			<span class="stext-109 cl8 hov-cl1 trans-04">
				{{$blog->subcategory->name}}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

			<span class="stext-109 cl4">
				{{$blog->name}}
			</span>
		</div>
	</div>

	<!-- Content page -->
	<section class="bg0 p-t-52 p-b-20">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!--  -->
						<h4 class="mtext-112 cl2 p-b-20">
							{{$blog->name}}
						</h4>

						<div class="wrap-pic-w how-pos5-parent">
							<img src="{{$blog->img_url}}" alt="IMG-BLOG" style="height:600px;">
						</div>

						<div class="p-t-32">
							<span class="flex-w flex-m stext-111 cl2 p-b-19">
								<span>
									<span class="cl4">Por</span> {{$blog->author_name}}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{ $blog->created_at->toFormattedDateString() }}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{ $blog->tags_string }}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{ count($blog->comments) }} Comentarios
								</span>
							</span>

							<h4 class="ltext-109 cl2 p-b-28">
								{{$blog->title}}
							</h4>

							<p class="stext-117 cl6 p-b-26">
								{!! $blog->content !!}
							</p>
						</div>

						<hr>

						@if(!count($blog->comments))
							<h3 class="mt-5 mb-5">No hay comentarios</h3>
							<hr>
						@else
							<h3 class="mt-5 mb-5">Comentarios</h3>
						@endif

						@foreach($blog->comments as $comment)
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
						<div class="p-t-40">
							<h5 class="mtext-113 cl2 p-b-5">
								Deja tu comentario
							</h5>

							
							<form action="{{ route('blog-comentario', $blog->id) }}" method="POST">
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
								<div class="bor19 m-b-20">
									<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="content" placeholder="Comment..."></textarea>
								</div>

								<button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
									Enviar
								</button>
							</form>
						</div>
						@endif
					</div>
				</div>

				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
						
						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-20">
								Archivos descargables
							</h4>

							@if(!count($blog->documents))
							<h6>No hay por el momento</h6>
							@endif
							<ul>
								@foreach($blog->documents as $document)
								<li class="p-b-7">
									<a href="{{ $document['url'] }}" download class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span style="color:blue">
											<i class="fa fa-download"></i> &nbsp;{{$document['name']}}
										</span>
									</a>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="p-t-50">
							<h4 class="mtext-112 cl2 p-b-27">
								Tags
							</h4>

							<div class="flex-w m-r--5">
								@foreach($blog->tags as $tag)
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									{{$tag->name}}
								</a>
								@endforeach
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

@endsection