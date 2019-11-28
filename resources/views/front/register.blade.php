@extends('layouts.template')

@section('content')


	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url({{asset('images/home/bg-01.jpg')}});">
					<span class="login100-form-title-1">
						Registro
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					@csrf
					
					<div class="wrap-input100 validate-input m-b-26" data-validate="Debe introducir su nombre">
						<span class="label-input100">Nombre</span>
						<input class="input100" type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Debe introducir su email">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						<span class="focus-input100"></span>
					</div>

					

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Debe introducir su password">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Debe introducir su password">
						<span class="label-input100">Confirmar Password</span>
						<input class="input100" type="password" name="password_confirmation" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Aceptar
						</button>
					</div>

					@error('password')
			            <p style="color:red; font-size: 14px;">
			                <strong>*{{ $message }}</strong>
			            </p>
			        @enderror
			        @error('email')
			            <p style="color:red; font-size: 14px;">
			                <strong>*{{ $message }}</strong>
			            </p>
			        @enderror		

				</form>
			</div>
		
		

		</div>
	</div>
	
@endsection