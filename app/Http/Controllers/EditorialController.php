<?php

namespace App\Http\Controllers;

use App\{Editorial, Country};
use Illuminate\Http\Request;
use App\Http\Requests\EditorialFormRequest;
use Files;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editorials = Editorial::with(['files'])->paginate(10);

        return view('editoriales.index', compact('editorials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('editoriales.form', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EditorialFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditorialFormRequest $request)
    {
        $editorial = new Editorial();
        $editorial->fill($request->all());
        $editorial->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $editorial, 'images/editoriales');

        $toastr = ['toastr' => 'success', 'msg' => 'Editorial agregada con éxito'];

        return redirect()->route('editorial.index')->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Editorial  $editorial
     * @return \Illuminate\Http\Response
     */
    public function show(Editorial $editorial)
    {
        return view('editoriales.show', compact('editorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Editorial  $editorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Editorial $editorial)
    {
       $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
       return view('editoriales.form', compact('editorial', 'countries'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Editorial  $editorial
     * @return \Illuminate\Http\EditorialFormRequest
     */
    public function update(EditorialFormRequest $request, Editorial $editorial)
    {
        $editorial->fill($request->all());
        $editorial->save();

        if($request->has('file'))
        {
            if($editorial->image)
                Files::delete($editorial->image->id);

            $file = Files::save($request->file, $editorial, 'images/editoriales');
        }

        $toastr = ['toastr' => 'success', 'msg' => 'Editorial actualizada con éxito!'];

        return redirect()->route('editorial.show', $editorial->id)->with($toastr);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Editorial  $editorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Editorial $editorial)
    {
        if($editorial->image)
            Files::delete($editorial->image->id);

        $nombre = $editorial->name;
        $editorial->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Editorial: '.$nombre.' eliminada'];
        return redirect()->route('editorial.index')->with($toastr);
        
    }
}
