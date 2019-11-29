<?php

namespace App\Http\Controllers;

use App\{Cart, State};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->with(['product'])->get();
        $estados = State::with(['cities'])->orderBy('name', 'asc')->get();

        

        $total = 0;
        foreach ($carts as $key => $cart)
            $total += $cart->product->price * $cart->quantity;
        
        $total = '$' . number_format((float) $total, 2, '.',',') . " MXN";

        return view('front.cart.index', compact('carts', 'estados', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $user_id = Auth::user()->id;

        Cart::create([
            'quantity' => $request->quantity,
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);

        $toastr = ['toastr' => 'success', 'msg' => 'Producto agregado al carrito'];

        return redirect()->back()->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $carrito)
    {
        $carrito->delete();

        $toastr = ['toastr' => 'success', 'msg' => 'Articulo eliminado correctamente'];

        return redirect()->back()->with($toastr);
    }
}
