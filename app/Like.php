<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    
    /** Relacion Many To One */
    public function user() {
        return $this->belongsTo('App\User', 'user_id'); /** (Modelo User, Campo de esta tabla) */
    } 

    public function image() {
        return $this->belongsTo('App\Image', 'image_id'); /** (Modelo User, Campo de esta tabla) */
    } 
}
