<?php

namespace App\Http\Controllers;

use App\{User, State, City};
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Files;
//Has para contraseñas
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = State::with(['cities'])->orderBy('name', 'asc')->get();
        $roles = [['id' => 1, 'name' => 'Cliente',], ['id' => 2, 'name' => 'Administrador',]];

        return view('usuarios.form', compact('estados', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $usuario = new User();
        $usuario->fill($request->all());
        if(!empty($request->password))
            $usuario->password = Hash::make($request->password);
        $usuario->save();

        if($request->has('file'))
            $file = Files::save($request->file('file'), $usuario, 'images/usuarios');

        $toastr = ['toastr' => 'success', 'msg' => 'Usuario agregado con éxito'];

        return redirect()->route('usuario.show', $usuario->id)->with($toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $estados = State::with(['cities'])->orderBy('name', 'asc')->get();
        $roles = [['id' => 1, 'name' => 'Cliente',], ['id' => 2, 'name' => 'Administrador',]];

        return view('usuarios.form', compact('estados', 'usuario', 'roles'));
    }

    public function cuenta()
    {
        $estados = State::with(['cities'])->orderBy('name', 'asc')->get();
        $roles = [['id' => 1, 'name' => 'Cliente',], ['id' => 2, 'name' => 'Administrador',]];

        return view('front.usuario.cuenta', compact('estados'));
    }

    public function updateCuenta(UserFormRequest $request, User $usuario)
    {
        if(empty($request->password))
        {
            unset($request['password']);
        }

        $usuario->fill($request->all());
        if(!empty($request->password))
            $usuario->password = Hash::make($request->password);
        $usuario->save();

        if($request->has('file'))
        {
            if($usuario->image)
                Files::delete($usuario->image->id);

            $file = Files::save($request->file, $usuario, 'images/usuarios');
        }
        
        $toastr = ['toastr' => 'success', 'msg' => 'Información actualizada con éxito!'];

        return redirect()->back()->with($toastr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $usuario)
    {
        if(empty($request->password))
        {
            unset($request['password']);
        }

        $usuario->fill($request->all());
        if(!empty($request->password))
            $usuario->password = Hash::make($request->password);
        $usuario->save();

        if($request->has('file'))
        {
            if($usuario->image)
                Files::delete($usuario->image->id);

            $file = Files::save($request->file, $usuario, 'images/usuarios');
        }
        
        $toastr = ['toastr' => 'success', 'msg' => 'usuario actualizado con éxito!'];

        return redirect()->route('usuario.show', $usuario->id)->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {

        if(count($usuario->blogs))
        {
            $toastr = ['toastr' => 'error', 'msg' => 'Por integridad en la base de datos, no puede eliminar un usuario que tiene blogs dependientes.'];
            return redirect()->back()->with($toastr);
        }

        $nombre = $usuario->full_name;

        foreach ($usuario->files as $key => $value) {
            Files::delete($value->id);
        }

        $usuario->delete();

        $toastr = ['toastr' => 'warning', 'msg' => 'Usuario: '.$nombre.' eliminado'];
        return redirect()->route('usuario.index')->with($toastr);
    }
}
