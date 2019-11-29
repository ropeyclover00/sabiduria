@extends('layouts.template')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/home/banner3.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Blogs
		</h2>
	</section>	
	
	<section class="bg0 p-t-62 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!-- item blog -->
						@foreach($blogs as $blog)
						<div class="p-b-63">
							<a href="{{route('blog-detalle', $blog->id)}}" class="hov-img0 how-pos5-parent">
								<img src="{{$blog->img_url}}" alt="IMG-BLOG" style="height: 400px;">
							</a>

							<div class="p-t-32">
								<h4 class="p-b-15">
									<a href="{{ route('blog-detalle', $blog->id) }}" class="ltext-108 cl2 hov-cl1 trans-04">
										{{$blog->name}}
									</a>
								</h4>


								<div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">Por</span> {{$blog->author_name}}
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

										<span>
											{{$blog->tags_string}}  
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

										<span>
											{{count($blog->comments)}} Comentarios
										</span>
									</span>

									<a href="{{ route('blog-detalle', $blog->id) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
										Ver

										<i class="fa fa-long-arrow-right m-l-9"></i>
									</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
						

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-33">
								Categorias
							</h4>

							<ul>
								@foreach($categories as $category)
								<li class="bor18">
									<a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
										{{{$category->name}}}
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
								
								@foreach($tags as $tag)
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