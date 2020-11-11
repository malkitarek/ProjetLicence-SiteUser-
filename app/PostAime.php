<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostAime extends Model
{
    //
    public function utilisateur(){
        return $this->belongsTo('App\Utilisateur','aime_user_id');
    }
    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
}
