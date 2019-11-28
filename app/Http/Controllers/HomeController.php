<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Files;
use App\{Blog, Product, Category};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::take(5)->get();
        $blogs = Blog::take(3)->get();

        return view('front.static.home', compact('products', 'blogs'));
    }

    public function cuenta()
    {
        return view('front.usuario.cuenta');
    }

    public function nosotros()
    {
        return view('front.static.nosotros');
    }

    public function contacto()
    {
        return view('front.static.contacto');
    }

    public function carrito()
    {
        return view('front.cart.index');
    }
    
}
