<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 't_comentario';
    // Relacioon de muchos a uno
    public function usuario(){
        return $this->belongsTo('App\User', 'fk_id_usu');
    }
    public function video(){
        return $this->belongsTo('App\Video', 'fk_id_vid');
    }
}
