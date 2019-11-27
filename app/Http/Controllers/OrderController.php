<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Order::with('user')->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Order $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $pedido)
    {
        $id = $pedido->id;

        $pedido->delete();

        $toastr = ['toastr' => 'success', 'msg' => 'Pedido con ID: ' . $id . ' eliminado correctamente'];

        return redirect()->route('pedido.index')->with($toastr);
    }
}
