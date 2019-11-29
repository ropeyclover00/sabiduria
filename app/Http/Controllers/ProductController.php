<?php

namespace App\Http\Controllers;

use App\{Product, Category, Subcategory, Tag, Country, Author, Editorial};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductFormRequest;
use Files;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['files', 'category', 'subcategory'])->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with(['subcategories'])->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        $estados = [['id' => '1', 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']];
        $authors = Author::select('id', 'name', 'last_name')->orderBy('name', 'asc')->get();
        $editorials = Editorial::select('id', 'name')->orderBy('name', 'asc')->get();        

        return view('products.form', compact('categories', 'tags', 'countries', 'estados', 'authors', 'editorials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->slug = $product->name;
        $product->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $product, 'images/productos');

        if($request->has('tags'))
            $product->tags()->attach($request->tags);

        //editoriales
        if($request->has('editorials'))
            $product->editorials()->attach($request->editorials);

        //autores
        if($request->has('authors'))
            $product->authors()->attach($request->authors);

        $toastr = ['toastr' => 'success', 'msg' => 'Producto agregado con éxito'];

        return redirect()->route('producto.index', $product->id)->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $producto)
    {
        return view('products.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $producto)
    {
        $categories = Category::with(['subcategories'])->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        $estados = [['id' => '1', 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']];
        $authors = Author::select('id', 'name', 'last_name')->orderBy('name', 'asc')->get();
        $editorials = Editorial::select('id', 'name')->orderBy('name', 'asc')->get();

        return view('products.form', compact('categories', 'tags', 'countries', 'estados', 'producto', 'authors', 'editorials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $producto)
    {
        $producto->fill($request->all());
        $producto->slug = $producto->name;

        if(!$request->has('outstanding'))
            $producto->outstanding = 0;

        $producto->save();

        if($request->has('file'))
        {
            if($producto->image)
                Files::delete($producto->image->id);

            $file = Files::save($request->file, $producto, 'images/productos');
        }

        //tags
        $producto->tags()->detach();
        if($request->has('tags'))
            $producto->tags()->attach($request->tags);

        //editoriales
        $producto->editorials()->detach();
        if($request->has('editorials'))
            $producto->editorials()->attach($request->editorials);

        //autores
        $producto->authors()->detach();
        if($request->has('authors'))
            $producto->authors()->attach($request->authors);
        
        $toastr = ['toastr' => 'success', 'msg' => 'producto actualizado con éxito!'];

        return redirect()->route('producto.show', $producto->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $producto)
    {
        
        if(count($producto->details))
        {
           $toastr = ['toastr' => 'error', 'msg' => 'Por integridad en la base de datos, no puede eliminar un producto que forma parte de un pedido.'];
            return redirect()->back()->with($toastr);
        }

        $nombre = $producto->name;

        if($producto->image)
            Files::delete($producto->image->id);

        $producto->tags()->detach();
        $producto->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Producto: '.$nombre.' eliminado'];
        return redirect()->route('producto.index')->with($toastr);
    }

    public function listFront($category_id = null, $subcategory_id = null)
    {
        $products = Product::all();
        return view('front.products.listado', compact('products'));
    }

    public function showFront(Product $producto)
    {
        return view('front.products.detalle', compact('producto'));
    }

    public function addComment(Request $request, Product $producto)
    {
    
        $user_id = Auth::user()->id;

        $producto->comments()
                 ->create(['content' => $request->content, 
                           'score' => $request->score, 
                           'user_id' => $user_id]);

        $toastr = ['toastr' => 'success', 'msg' => 'Comentario agregado correctamente'];

        return redirect()->back()->with($toastr);
    }
}
