@if (session('respuesta'))
        <div class="alert alert-success" role="alert">
            {{ session('respuesta') }}
        </div>
@endif

@if(Auth::check())
<form action="{{ route('crearComentario') }}" method="post">
    @csrf
    <input type="hidden" name="video_id" value="{{ $video->id }}">
    <p>
        <textarea class="form-control" name="texto" id="" class="w-100" rows="3" required></textarea>
    </p>
    <input type="submit" class="btn btn-success" value="comentar">    
</form>
@endif

@if(isset($video->comentario))
    <div class="container">
        @foreach($video->comentario as $comentario)
        <div class="card mb-3 mt-3">        
            <div class="card-body">
                <h5 class="card-title">{{$comentario->usuario->name}}</h5>
                <p class="card-text">{{$comentario->texto_com}}</p>
                <p class="card-text"><small class="text-muted">{{$comentario->created_at}}</small></p>
            </div>
            @if(Auth::check() &&  (Auth::user()->id === $comentario->fk_id_usu || Auth::user()->id === $video->fk_id_usu))
            
                <!-- Button trigger modal eliminar comentario-->
                <a role="button" class="btn-sm text-danger col-3" data-toggle="modal" data-target="#exampleModal{{$comentario->id}}">
                    <i class="fas fa-trash"></i> Eliminar
                </a>

                <!-- Modal eliminar comentario-->
                <div class="modal fade" id="exampleModal{{$comentario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Comentario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{$comentario->texto_com}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="{{ route('borrarComentario',['comentario_id'=>$comentario->id]) }}" role="button" class="btn btn-danger">Eliminar</a>
                        </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
        @endforeach
    </div>
@endif
