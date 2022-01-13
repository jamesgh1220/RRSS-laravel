<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images'; /** La tabla con la que esta trabajando en la BD */

    /** Relacion One To Many */
    public function comments() { 
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');;
    }

    /** Relacion One To Many */
    public function likes() {
        return $this->hasMany('App\Like');
    }

    /** Relacion Many To One */
    public function user() {
        return $this->belongsTo('App\User', 'user_id'); /** (Modelo User, Campo de esta tabla) */
    }
}
