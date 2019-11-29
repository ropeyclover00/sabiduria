<?php

namespace App\Http\Controllers;

use App\{Order, Cart};
use Illuminate\Http\Request;
use App\Http\Requests\OrderFormRequest;
use Illuminate\Support\Facades\Auth;

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
    public function store(OrderFormRequest $request)
    {
        $user_id = Auth::user()->id;

        $total = 0;
        $carts = Cart::where('user_id', $user_id)->with(['product'])->get();

        if(!count($carts))
        {
            $toastr = ['toastr' => 'error', 'msg' => 'No hay articulos en su carrito'];
            return redirect()->back()->with($toastr);
        }
        
        foreach ($carts as $key => $cart) 
            $total += $cart->product->price * $cart->quantity;

        $pedido = new Order();
        $pedido->fill($request->all());
        $pedido->user_id = $user_id;
        $pedido->total = $total;
        $pedido->shipping_cost = 0;
        $pedido->save();

        foreach ($carts as $key => $cart) 
        {
            $pedido->details()->create([
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);

            $cart->delete();
        }

        $toastr = ['toastr' => 'success', 'msg' => 'Pedido con ID: ' . $pedido->id . ' creado con éxito'];

        return redirect()->route('pedidos')->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Order $pedido)
    {
        $estados = ['Cancelado', 'Pendiente', 'Pagado', 'Enviado', 'Completado'];
        return view('pedidos.show', compact('pedido', 'estados'));
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
        $request->validate([
            'status' => 'required|integer|max:4|min:0',
        ]);

        $pedido->status = $request->status;
        $pedido->save();

        $toastr = ['toastr' => 'success', 'msg' => 'Estatus actualizado correctamente'];

        return redirect()->back()->with($toastr);
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

    public function getByUser()
    {
        $id = Auth::user()->id;

        $pedidos = Order::where('user_id', $id)->with(['details'])->get();

        return view('front.usuario.pedidos', compact('pedidos'));
    }
}
