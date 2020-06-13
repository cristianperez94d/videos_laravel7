@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="">Crear un nuevo video</h2>
        <hr>
        <form action="{{ route('guardarVideo') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control" id="descripcion" name="descripcion" id="" cols="30" rows="10" >{{ old('descripcion') }}</textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Miniatura</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="form-group">
                <label for="video">Archivo de Video</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>
            <button type="submit" class="btn btn-success">Crear Video</button>
        </form>
    </div>
@endSection

