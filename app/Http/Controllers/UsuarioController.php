<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\Video;
use App\Comentario;

class UsuarioController extends Controller
{
    public function canal($usuario_id){
        $usuario = User::find($usuario_id);
        if (!is_object($usuario)) {
            return redirect()->route('home');
        }

        $videos = Video::where('fk_id_usu',$usuario_id)->paginate(5);

        return view('usuario.canal', array(
            'usuario'=>$usuario,
            'videos'=>$videos
        ));
    }
}
