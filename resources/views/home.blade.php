@extends('layouts.app')

@section('content')
    
<div class="container-fluid">
    @if (session('respuesta'))
        <div class="alert alert-success" role="alert">
            {{ session('respuesta') }}
        </div>
    @endif
    <!-- Lista de videos -->
    @include('video.videosList')

</div>
@endsection
