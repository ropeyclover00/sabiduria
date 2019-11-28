<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comentario)
    {
        $comentario->delete();

        $toastr = ['toastr' => 'success', 'msg' => 'Comentario eliminado correctamente'];

        return redirect()->back()->with($toastr);
    }
}
