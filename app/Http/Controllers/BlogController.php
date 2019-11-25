<?php

namespace App\Http\Controllers;

use App\{Blog, Category, Subcategory, Tag, User};
use Illuminate\Http\Request;
use App\Http\Requests\BlogFormRequest;
use App\Http\Requests\DocumentFormRequest;
use Files;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with(['files', 'author', 'category', 'subcategory'])->paginate(10);
        
        return view('blogs.index', compact('blogs'));
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
        $users = User::select('id', 'name', 'last_name')->orderBy('last_name', 'asc')->get();
        $estados = [['id' => '1', 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']];

        return view('blogs.form', compact('categories', 'tags', 'users', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogFormRequest $request)
    {
        $blog = new Blog();
        $blog->fill($request->all());
        $blog->slug = $blog->name;
        $blog->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $blog, 'images/blogs');

        if($request->has('tags'))
            $blog->tags()->attach($request->tags);

        $toastr = ['toastr' => 'success', 'msg' => 'Blog agregado con éxito, ahora puede agregar archvos!!!'];

        return redirect()->route('blog.edit', $blog->id)->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = Category::with(['subcategories'])->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        $users = User::select('id', 'name', 'last_name')->orderBy('last_name', 'asc')->get();
        $estados = [['id' => '1', 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']];

        return view('blogs.form', compact('categories', 'tags', 'users', 'blog', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BlogFormRequest  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogFormRequest $request, Blog $blog)
    {
        $blog->fill($request->all());
        $blog->slug = $blog->name;
        $blog->save();

        if($request->has('file'))
        {
            if($blog->image)
                Files::delete($blog->image->id);

            $file = Files::save($request->file, $blog, 'images/blogs');
        }

        $blog->tags()->detach();
        if($request->has('tags'))
            $blog->tags()->attach($request->tags);
        
        $toastr = ['toastr' => 'success', 'msg' => 'Blog actualizado con éxito!'];

        return redirect()->route('blog.show', $blog->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $nombre = $blog->name;

        foreach ($blog->files as $key => $value) {
            Files::delete($value->id);
        }

        $blog->tags()->detach();
        $blog->comments()->detach();
        $blog->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Blog: '.$nombre.' eliminado'];
        return redirect()->route('blog.index')->with($toastr);
    }

    public function uploadFile(DocumentFormRequest $request, $blog_id)
    {
        $blog = Blog::find($blog_id);
        if(!empty($blog))
        {
            $file = Files::save($request->file, $blog, 'documents/blogs');
            return response()->json(["msg" => "Docuemnto cargado con éxito"]);
        }

        return response()->json(["msg" => "No existe el blog"], 400);
    }

    public function deleteFile($file_id)
    {
        Files::delete($file_id);
        $toastr = ['toastr' => 'success', 'msg' => 'Archivo eliminado con éxito!!'];
        return redirect()->back()->with($toastr);
    }
}
