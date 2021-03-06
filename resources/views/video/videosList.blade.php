@if(count($videos) >=1 )

<div id="" class="row justify-content-center m-1">

    @foreach($videos as $video)
       
        <div id="" class="col-sm-12 col-md-8 p-0" style="">
            <div class="card">
                <div class="row p-1 bg-dark">
                    <div class="col-md-4">
                        @if(Storage::disk('images')->has($video->imagen_vid))
                            <img src="{{ url('miniatura/'.$video->imagen_vid) }}"class="card-img h-100" alt="Imagen">
                        @endif
                    </div>
                
                    <div class="col-md-8">
                        
                        <div class="card-body p-2 bg-dark text-light">
                            <h4 id="" class="card-title">
                                <a href="{{ route('videoDetalle', [ 'video_id'=>$video->id ]) }}" class="text-light">{{ $video->titulo_vid}}</a>
                            </h4>
                            <p class="card-text"><a href="{{ route('canal',['usuario_id'=>$video->usuario->id]) }}" class="text-light">{{ $video->usuario->name}}</a></p>
                        </div>
                        <!-- boton de accion -->
                        <div class="card-footer d-flex align-items-end  justify-content-center p-1 bg-dark rounded-bottom">
                            <a href="{{ route('videoDetalle', [ 'video_id'=>$video->id ]) }}" class="btn text-success">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            @if(Auth::check() && Auth::user()->id === $video->usuario->id)
                                <a href="{{ route('editarVideo', ['video_id'=>$video->id] ) }}" class="btn text-warning">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </a>
        
                                <!-- Button trigger modal eliminar -->
                                <a role="button" class="btn text-danger" data-toggle="modal" data-target="#exampleModal{{$video->id}}">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
        
                                <!-- Modal eliminar -->
                                <div class="modal fade" id="exampleModal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Video</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{$video->titulo_vid}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <a href="{{ route('borrarVideo',['video_id'=>$video->id]) }}" role="button" class="btn btn-danger">Eliminar</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
        
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>                

    @endforeach
</div>
@else
<div class="alert alert-info">
    No hay videos actualmente!!
</div>
@endif
{{ $videos->links() }}