<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Rutas del controlador Video
Route::get('/crear-video', 'VideoController@crearVideo')
    ->name('crearVideo')
    ->middleware('auth');
Route::post('/guardar-video', 'VideoController@guardarVideo')
    ->name('guardarVideo')
    ->middleware('auth');
Route::get('/miniatura/{nombreArchivo}', 'VideoController@traerImagen')
    ->name('imagenVideo');    
Route::get('/video-file/{nombreArchivo}', 'VideoController@traerVideo')
    ->name('traerVideo');    
Route::get('/video/{video_id}', 'VideoController@traerVideoDetalle')
    ->name('videoDetalle');  
Route::get('/borrar-video/{video_id}', 'VideoController@borrarVideo')
    ->name('borrarVideo')
    ->middleware('auth');  
Route::get('/editar-video/{video_id}', 'VideoController@editarVideo')
    ->name('editarVideo')
    ->middleware('auth');    
Route::post('/editar-video/{video_id}', 'VideoController@actualizarVideo')
    ->name('actualizarVideo')
    ->middleware('auth');    
Route::get('/buscar/{video_id?}/{filtro?}', 'VideoController@buscarVideo')
    ->name('buscarVideo');    
    
// comentarios
Route::post('/comentario', 'comentarioController@crearComentario')
        ->name('crearComentario')
        ->middleware('auth');
Route::get('/borrar-comentario/{comentario_id}', 'comentarioController@borrarComentario')
        ->name('borrarComentario')
        ->middleware('auth');

// usuarios
Route::get('/canal/{usuario_id}', 'usuarioController@canal')
    ->name('canal');

    