<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagFormRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TagFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagFormRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->all());
        $tag->slug = $tag->name;
        $tag->save();

        $toastr = ['toastr' => 'success', 'msg' => 'Tag agregado con éxito'];

        return redirect()->route('tag.index')->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.form', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TagFormRequest  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagFormRequest $request, Tag $tag)
    {
        $tag->fill($request->all());
        $tag->slug = $tag->name;
        $tag->save();

        $toastr = ['toastr' => 'success', 'msg' => 'Tag actualizado con éxito!'];

        return redirect()->route('tag.show', $tag->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $nombre = $tag->name;
        $tag->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Tag: '.$nombre.' eliminado'];

        return redirect()->route('tag.index')->with($toastr);
    }
}
