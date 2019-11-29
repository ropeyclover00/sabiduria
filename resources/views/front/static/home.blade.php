@extends('layouts.template')

@section('content')
    
    <!-- Banners -->
    <section class="section-slide">
        <div class="wrap-slick1 rs1-slick1">
            <div class="slick1">
                 
                <div class="item-slick1" style="background-image: url(images/home/banner3.jpg);">
                    <div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
									Bienvenido a <br> Libreria Sabiduria
								</h2>
							</div>
						</div>
					</div>
                </div>

                <div class="item-slick1" style="background-image: url(images/home/banner1.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1" style="color: white">
									Nuevos Libros
								</h2>
							</div>
						</div>
					</div>
                </div>

                <div class="item-slick1" style="background-image: url(images/home/banner2.jpg);">
                    <div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1" style="color: white">
									Contactanos
								</h2>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product -->
    @if( count($products) )
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Nuevos Libros
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								
								@foreach($products as $product)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="{{$product->img_url}}" style="height: 400px" alt="IMG-PRODUCT">
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="{{route('producto-detalle', $product->id)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													{{$product->name}}
												</a>
												<span class="stext-105 cl3">
													${{ $product->price_format }}
												</span>
											</div>

											
										</div>
									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>

				
				
			</div>
		</div>
	</section>
	@endif

	<!-- Blog -->
	@if(count($blogs))
	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Blogs
				</h3>
			</div>

			<div class="row">
				
				@foreach($blogs as $blog)
				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="{{route('blog-detalle', $blog->id)}}">
								<img src="{{$blog->img_url}}" alt="IMG-BLOG" style="height: 400px;">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										Por
									</span>

									<span class="cl5">
										{{$blog->author_name}}
									</span>
								</span>

								<span>
									<span class="cl4">
										el
									</span>

									<span class="cl5">
										{{$blog->created_at->toFormattedDateString()}}
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="{{route('blog-detalle', $blog->id)}}" class="mtext-101 cl2 hov-cl1 trans-04">
									{{$blog->name}}
								</a>
							</h4>

						</div>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
	</section>
	@endif

@endsection
