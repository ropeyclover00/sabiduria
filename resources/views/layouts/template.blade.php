<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ICONO ======================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/MagnificPopup/magnific-popup.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login/main.css')}}">
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">

</head>
<body class="animsition">

	<!-- Header -->
	<header class="header-v2">
		
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">
					
					<!-- Logo desktop -->		
					<a class="logo">
						<img src="{{asset('images/home/logo.png')}}" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{route('home')}}">Home</a>
							</li>

							<li>
								<a href="{{route('productos')}}">Productos</a>
								
							</li>

							<li>
								<a href="{{route('blogs')}}">Blogs</a>
							</li>	
							<li>
								<a href="{{route('nosotros')}}">Nosotros</a>
							</li>							
							<li>
								<a href="{{route('contacto')}}">Contáctanos</a>
							</li>	
							
						</ul>
					</div>	

					@if(Auth::user())
					<div style="margin-left: 140px;">
						<b>Usuario:</b> {{ Auth::user()->full_name }}
					</div>
					@endif
					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m h-full">
						
							
						<div class="flex-c-m h-full p-l-18 p-r-25 bor5">
							<a href="{{ route('carrito') }}">
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11" >
									<i class="zmdi zmdi-shopping-cart"></i>
								</div>
							</a>
						</div>
							
						<div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Busqueda...">
				</form>
			</div>
		</div>
	</header>

	<!-- Sidebar -->
	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-13">
						<a href="{{route('home')}}" class="stext-102 cl2 hov-cl1 trans-04">
							Home
						</a>
					</li>
					
					<li class="p-b-13">
						@guest
						<a href="{{ route('login') }}" class="stext-102 cl2 hov-cl1 trans-04">
							Iniciar Sesión
						</a>
						@else
						<a class="stext-102 cl2 hov-cl1 trans-04" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
						@endguest
					</li>

					<li class="p-b-13">
						@guest
						<a href="{{ route('register') }}" class="stext-102 cl2 hov-cl1 trans-04">
							Registrarse
						</a>
						@else
						<a href="{{ route('cuenta') }}" class="stext-102 cl2 hov-cl1 trans-04">
							Mi cuenta
						</a>
						@endguest

					</li>

					<li class="p-b-13">
						<a href="{{ route('carrito') }}" class="stext-102 cl2 hov-cl1 trans-04">
							Mi Carrito
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{ route('contacto') }}" class="stext-102 cl2 hov-cl1 trans-04">
							Contáctanos
						</a>
					</li>
					
				</ul>

				<div class="sidebar-gallery w-full">
					<span class="mtext-101 cl5">
						Acerca de Nosotros
					</span>

					<p class="stext-108 cl6 p-t-27">
						Sabiduria es una empresa mexicana que nace en el año de 2019. Se dedica a la distribución y comercialización de libros de texto, revistas, material didactico.

						Cuenta con su matriz en la ciudad de Guadalajara, Jalisco.
					</p>
				</div>
			</div>
		</div>
	</aside>


	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Tu Carrito
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-02.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="{{route('carrito')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							Ir al carrito
						</a>

						
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="contenido">
		@yield('content')
	</div>

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			
			<div class="">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="{{asset('images/icons/icon-pay-01.png')}}" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="{{asset('images/icons/icon-pay-02.png')}}" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="{{asset('images/icons/icon-pay-03.png')}}" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="{{asset('images/icons/icon-pay-04.png')}}" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="{{asset('images/icons/icon-pay-05.png')}}" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Sitio desarrollado por Angel Marin Ramirez Castorena
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>

	<!--===============================================================================================-->	
	<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	

<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
	<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
	<!-- SCRIPT PARA LAS NOTIFICACIONES BONIS uwu -->
    <script>
       $(function(){
       	@if(Session::has('toastr') && Session::has('msg'))

            var type = "{{ Session::get('toastr') }}";
            var msg =  "{{ Session::get('msg') }}";

            console.log(type)
            console.log(msg)

            switch(type)
            {
                case 'success':
                    toastr.success(msg);
                    break;
                case 'warning':
                    toastr.warning(msg);
                    break;
                case 'info':
                    toastr.info(msg);
                    break;
                case 'error':
                    toastr.error(msg);
                    break;
            }

       @endif
       })       
    </script>

    @yield('script')

</body>
</html>