<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCommentaire_ga extends Model
{
    public function utilisateur(){
        return $this->belongsTo('App\Utilisateur','comment_user_id');
    }
    public function post(){
        return $this->belongsTo('App\post_ga','post_id');
    }
}
