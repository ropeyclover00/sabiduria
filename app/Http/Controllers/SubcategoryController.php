<?php

namespace App\Http\Controllers;

use App\{Category,Subcategory};
use Illuminate\Http\Request;
use App\Http\Requests\SubcategoryFormRequest;
use Files;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with(['files', 'category'])->paginate(10);

        foreach ($subcategories as $key => &$subcategory) {
            if(isset($subcategory->files[0]))
                $subcategory->imgUrl = Files::getUrl($subcategory->files[0]->id);
        }

        return view('subcategorias.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('subcategorias.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SubcategoryFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryFormRequest $request)
    {
        $subcategory = new Subcategory();
        $subcategory->fill($request->all());
        $subcategory->slug = $subcategory->name;

        //dd($category);

        $subcategory->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $subcategory, 'images/subcategorias');
        
        $toastr = ['toastr' => 'success', 'msg' => 'Subcategoria agregada con éxito'];

        return redirect()->route('subcategoria.index')->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategorium)
    {
        $subcategory = $subcategorium;

        if(isset($subcategory->files[0]))
            $subcategory->imgUrl = Files::getUrl($subcategory->files[0]->id);

        return view('subcategorias.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategorium)
    {
        $subcategory = $subcategorium;
        $categories = Category::select('id', 'name')->get();

        if(isset($subcategory->files[0]))
            $subcategory->imgUrl = Files::getUrl($subcategory->files[0]->id);

        return view('subcategorias.form', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SubcategoryFormRequest  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryFormRequest $request, Subcategory $subcategorium)
    {
        $subcategorium->fill($request->all());
        $subcategorium->slug = $subcategorium->name;
        $subcategorium->save();

        if($request->has('file'))
        {
            //Si hay una imagen ya cargada se elimina
            if(isset($subcategorium->files[0]))
                Files::delete($subcategorium->files[0]->id);

            $file = Files::save($request->file('file'), $subcategorium, 'images/subcategorias');
        }

        $toastr = ['toastr' => 'success', 'msg' => 'Subcategoria actualizada con éxito!'];

        return redirect()->route('subcategoria.show', $subcategorium->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategorium)
    {

        if(count($subcategorium->products) || count($subcategorium->blogs))
        {
            $toastr = ['toastr' => 'error', 'msg' => 'Por integridad en la base de datos, no puede eliminar una subcategoria que tiene productos y/o blogs dependientes.'];
            return redirect()->back()->with($toastr);
        }

        foreach ($subcategorium->files as $key => $file) {
            Files::delete($file->id);
        }

        $nombre = $subcategorium->name;
        $subcategorium->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Subcategoria: '.$nombre.' eliminada'];

        return redirect()->route('subcategoria.index')->with($toastr);
    }
}
