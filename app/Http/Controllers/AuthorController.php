<?php

namespace App\Http\Controllers;

use App\{Author, Country};
use Illuminate\Http\Request;
use App\Http\Requests\AuthorFormRequest;
use Files;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with(['files'])->paginate(10);

        return view('autores.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('autores.form', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AuthorFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorFormRequest $request)
    {
        $author = new Author();
        $author->fill($request->all());
        $author->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $author, 'images/autores');

        $toastr = ['toastr' => 'success', 'msg' => 'Autor agregado con éxito'];

        return redirect()->route('autor.index')->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $autor)
    {
        return view('autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $autor)
    {
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('autores.form', compact('autor', 'countries'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AuthorFormRequest  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorFormRequest $request, Author $autor)
    {
        $autor->fill($request->all());
        $autor->save();

        if($request->has('file'))
        {
            if($autor->image)
                Files::delete($autor->image->id);

            $file = Files::save($request->file, $autor, 'images/autores');
        }

        $toastr = ['toastr' => 'success', 'msg' => 'Autor actualizado con éxito!'];

        return redirect()->route('autor.show', $autor->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $autor)
    {
        if($autor->image)
            Files::delete($autor->image->id);

        $nombre = $autor->name;
        $autor->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Autor: '.$nombre.' eliminad@'];
        return redirect()->route('autor.index')->with($toastr);
    }
}
