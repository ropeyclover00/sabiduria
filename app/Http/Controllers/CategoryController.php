<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use Files;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['files'])->get();

        foreach ($categories as $key => &$category) {
            if(isset($category->files[0]))
                $category->imgUrl = Files::getUrl($category->files[0]->id);
        }

        //dd($categories);

        return view('categorias.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
      
        $category = new Category();
        $category->fill($request->all());
        $category->slug = $category->name;

        //dd($category);

        $category->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $category, 'images/categorias');
                    
        return redirect()->route('categoria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categorium)
    {
        $category = $categorium;

        if(isset($category->files[0]))
            $category->imgUrl = Files::getUrl($category->files[0]->id);

        return view('categorias.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categorium)
    {
        $category = $categorium;

        if(isset($category->files[0]))
            $category->imgUrl = Files::getUrl($category->files[0]->id);

        return view('categorias.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $categorium)
    {
        $categorium->fill($request->all());
        $categorium->slug = $categorium->name;
        $categorium->save();

        if($request->has('file'))
        {
            //Si hay una imagen ya cargada se elimina
            if(isset($categorium->files[0]))
                Files::delete($categorium->files[0]->id);

            $file = Files::save($request->file('file'), $categorium, 'images/categorias');
        }

        return redirect()->route('categoria.show', $categorium->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categorium)
    {
        
        foreach ($categorium->files as $key => $file) {
            Files::delete($file->id);
        }

        $categorium->delete();

        return redirect()->route('categoria.index');
    }
}
