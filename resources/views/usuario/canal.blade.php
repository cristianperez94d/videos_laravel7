@extends('layouts.app')

@section('content')
    <div id="" class="row justify-content-center m-1">
        <h2 class="col-sm-6">Canal de <b>{{$usuario->name}}</b> </h2>

    </div>
    <!-- Lista de videos -->
    @include('video.videosList')


@endsection 