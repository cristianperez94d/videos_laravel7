<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comentario;

class VideoController extends Controller
{
    public function crearVideo(){
        return view('video.crearVideo');
    }

    public function guardarVideo(Request $request){
        // validar formulario
        $datosValidar = $request->validate([
            'titulo'=>['required','min:5'],
            'descripcion'=>['required'],
            'video'=>['mimetypes:video/mp4']
        ]);
        $video = new Video();
        $usuario = \Auth::user();
        $video->fk_id_usu = $usuario->id;
        $video->titulo_vid = $request->input('titulo');
        $video->descripcion_vid = $request->input('descripcion');

        // subir la imagen en miniatura del video
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_ruta = time().$imagen->getClientOriginalName();
            \Storage::disk('images')->put($imagen_ruta, \File::get($imagen));
            $video->imagen_vid = $imagen_ruta;
        }

        // subir el video
        $video_file = $request->file('video');
        if ($video_file) {
            $video_ruta = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_ruta, \File::get($video_file));
            $video->video_vid= $video_ruta;
        }
        
        $video->save();

        return redirect()->route('home')->with(array(
            'respuesta'=>'El video se ha subido correctamente!!'
        ));
        
    }

    public function traerImagen($nombreArchivo){
        $archivo = Storage::disk('images')->get($nombreArchivo);
        return new Response($archivo, 200);
    }
    
    public function traerVideo($nombreArchivo){
        $archivo = Storage::disk('videos')->get($nombreArchivo);
        return new Response($archivo, 200);
    }

    public function traerVideoDetalle($video_id){
        $video = Video::find($video_id);
        return view('video.detalle', array(
            'video'=>$video
        ));
    }

    public function borrarVideo($video_id){
        $usuario = \Auth::user();
        $video = Video::find($video_id);
        $comentario = Comentario::where('fk_id_vid', $video_id)->get();
        if ($usuario && $video->fk_id_usu === $usuario->id) {
            // Eliminar comentarios
            if ($comentario && count($comentario) >=1 ) {
                foreach ($comentario as $item) {
                    $item->delete();
                }
            }
            // Eliminar archivos
            Storage::disk('images')->delete($video->imagen_vid);
            Storage::disk('videos')->delete($video->video_vid);
            // Eliminar video
            $video->delete();

            $mensaje = array('respuesta'=>'video eliminado correctamente');
        }
        else{
            $mensaje = array('respuesta'=>'El video no se ha eliminado');
        }

        return redirect()->route('home')->with($mensaje);
    }

    public function editarVideo($id){
        $usuario = \Auth::user();
        $video = Video::find($id);

        if ($usuario && $video->fk_id_usu === $usuario->id) {
            $video = Video::findOrFail($id);
            return view('video.editar', array(
                'video'=>$video
            ));
        }
        else{
            return redirect()->route('home');
        }
    }

    public function actualizarVideo($video_id , Request $request){
        $datosValidar = $request->validate([
            'titulo'=>['required','min:5'],
            'descripcion'=>['required'],
            'video'=>['mimetypes:video/mp4']
        ]);

        $usuario = \Auth::user();
        $video = Video::findOrFail($video_id);
        $video->fk_id_usu = $usuario->id;
        $video->titulo_vid = $request->input('titulo');
        $video->descripcion_vid = $request->input('descripcion');

        // subir la miniatura
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_ruta = time().$imagen->getClientOriginalName();
            \Storage::disk('images')->put($imagen_ruta, \File::get($imagen));
            Storage::disk('images')->delete($video->imagen_vid);
            $video->imagen_vid = $imagen_ruta;
        }

        // subir el video
        $video_file = $request->file('video');
        if ($video_file) {
            $video_ruta = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_ruta, \File::get($video_file));
            Storage::disk('videos')->delete($video->video_vid);
            $video->video_vid= $video_ruta;
        }

        $video->update();

        return redirect()->route('home')->with(array('respuesta'=>'Video actualizado correctamente'));
    }

    public function buscarVideo($buscar = null, $filtro = null){   
        if (is_null($buscar)) {
            $buscar = \Request::get('search');
        }     
        if (is_null($filtro) && \Request::get('filtro') && !is_null($buscar)) {
            $filtro = \Request::get('filtro');
        }     

        $col="id";
        $orden="desc";
        if (!is_null($filtro)) {
            if ($filtro === 'nuevos') {
                $col="id";
                $orden="desc";
            }
            if ($filtro === 'antiguos') {
                $col="id";
                $orden="asc";              
            }
            if ($filtro === 'alfabetico') {
                $col="titulo_vid";
                $orden="asc"; 
            }
        }

        $videos = Video::where('titulo_vid','LIKE', '%'.$buscar.'%')
            ->orderBy($col,$orden)
            ->paginate(5);

        return view('video.buscar',array(
            'videos'=>$videos,
            'buscar'=>$buscar
        ));
    }

}
