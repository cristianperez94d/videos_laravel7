<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 't_video';
    // Relacion uno a muchos
    public function comentario(){
        return $this->hasMany('App\Comentario', 'fk_id_vid')->orderBy('id','desc');
    }
    // Relacioon de muchos a uno
    public function usuario(){
        return $this->belongsTo('App\User', 'fk_id_usu');
    }
}
