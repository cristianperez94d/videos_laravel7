@extends ('layouts.app')

@section('content')

    <div class="container">
        <h2 class="">Actualizar video</h2>
        <hr>
        <form action="{{ route('actualizarVideo',['video_id' => $video->id]) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>                        
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $video->titulo_vid }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" id="" cols="30" rows="10" >{{ $video->descripcion_vid }}</textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Miniatura</label>
                <div class="text-center">
                    @if(Storage::disk('images')->has($video->imagen_vid))
                        <img src="{{ url('miniatura/'.$video->imagen_vid) }}"class="card-img-top col-sm-5" alt="Imagen">
                    @endif
                </div>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
                      
            <div class="form-group">              
                <label for="video">Archivo de Video</label>
                <input type="file" class="form-control" id="video" name="video">
                <!-- video -->
                <video id="video-player" class ="w-100" controls>
                    <source src="{{ route('traerVideo', ['nombreArchivo'=>$video->video_vid]) }}">
                    tu navegador no es compatible con HTML5
                </video>
            </div>
            <button type="submit" class="btn btn-success">Modificar Video</button>
        </form>
    </div>

@endsection