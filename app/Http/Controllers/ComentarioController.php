<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use\App\Comentario;

class ComentarioController extends Controller
{
    public function crearComentario(Request $request){
        $datosValidar = $request->validate([
            'texto'=>['required']
        ]);
        $comentario = new Comentario();
        $usuario = \Auth::user();

        $comentario->fk_id_usu = $usuario->id;
        $comentario->fk_id_vid = $request->input('video_id');
        $comentario->texto_com = $request->input('texto');

        $comentario->save();
        return redirect()->route('videoDetalle',['video_id'=>$comentario->fk_id_vid])->with(array('respuesta'=>'Comentario añadido correctamente'));
    }

    public function borrarComentario($comentario_id){
        $usuario = \Auth::user();
        $comentario = Comentario::find($comentario_id);

        if ($usuario && ($comentario->fk_id_usu === $usuario->id || $comentario->video->fk_id_vid === $usuario->id) ) {
            $comentario->delete();
            return redirect()->route('videoDetalle',['video_id'=>$comentario->fk_id_vid])->with(array('respuesta'=>'Comentario eliminado correctamente'));
        }

    }
}
