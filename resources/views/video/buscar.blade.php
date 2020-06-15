@extends('layouts.app')

@section('content')
    <div id="" class="row justify-content-center m-1">
        <h2 class="col-sm-6">Resultado de la Busqueda: <b>{{$buscar}}</b> </h2>
        <div class="col-12 col-sm-6">

            <form action="{{ url('/buscar/'.$buscar) }}" method="get" class="row">
                <div class="form-group col-sm-9 pr-1">
                    <select name="filtro" class="custom-select">
                        <option selected>Seleccione para ordenar</option>
                        <option value="antiguos">Mas antiguos primero</option>
                        <option value="nuevos">Mas nuevos primero</option>
                        <option value="alfabetico">De la A a la Z</option>
                    </select>
                </div>
                <div class="col-sm-3 p-0">
                    <input type="submit" value="Ordenar" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    <!-- Lista de videos -->
    @include('video.videosList')
@endsection