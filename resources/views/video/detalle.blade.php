@extends('layouts.app')

@section('content')

<div class="container">
    <h2>{{$video->titulo_vid}}</h2>
    <hr>
    <div class="card mb-3 p-0 col-md-8">
        <!-- video -->
        <video id="video-player" class ="w-100" controls>
            <source src="{{ route('traerVideo', ['nombreArchivo'=>$video->video_vid]) }}">
            tu navegador no es compatible con HTML5
        </video>
        <!-- decripcion -->
        <div class="card-body">
            <h5 class="card-title">Subido por: {{$video->usuario->name}}</h5>
            <p class="card-text">{{$video->descripcion_vid}}</p>
            <p class="card-text"><small class="text-muted">{{$video->usuario->created_at}}</small></p>
        </div>
        <hr>
        <!-- comentarios -->
        <div class="container pb-3">
            <h3>Comentarios</h3>
            @include('video.comentarios')
        </div>
    </div>

</div>

@endsection