@extends('layouts.template')
@section('content')

<h1>Bienvenido: {{ Auth::user()->full_name }}</h1>
	
@endsection