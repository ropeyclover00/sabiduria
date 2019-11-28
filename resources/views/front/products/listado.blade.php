@extends('layouts.template')

@section('content')
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<h3 class="p-b-50">Productos</h3>
			<div class="row isotope-grid">
				
				@foreach($products as $product)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{$product->img_url}}" alt="IMG-PRODUCT" style="height:400px;">

						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="{{route('producto-detalle', $product->id)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$product->name}}
								</a>

								<span class="stext-105 cl3">
									${{$product->price_format}} MXN
								</span>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
@endsection