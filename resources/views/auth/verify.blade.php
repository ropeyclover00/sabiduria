@extends('layouts.template')

@section('content')
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url({{asset('images/home/bg-01.jpg')}});">
                    <span class="login100-form-title-1">
                        Verifica tu email
                    </span>
                </div>

                <div class="" style="padding: 30px 80px 30px 80px">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{'Se ha enviado un nuevo link de verificación a tu email'}}
                        </div>
                    @endif
                    
                    <h5>
                        {{'Antes de continuar, Revisa el link de verificación que fue enviado a tu email.'}}
                    </h5>
                    <br>

                    <h5>
                        {{'Si no has recibido el email'}}
                    </h5>
                    <br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Enviar otro link') }}</button>.
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


