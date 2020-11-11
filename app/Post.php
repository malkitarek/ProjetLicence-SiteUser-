<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public function utilisateur(){
        return $this->belongsTo('App\Utilisateur','user_id');
    }
    public function postaimes(){

        return $this->hasMany('App\PostAime','post_id');
    }
    public function postcommentaires(){

        return $this->hasMany('App\PostCommentaire','post_id');
    }
   /*public function utilisateuraimes(){
        return $this->belongsToMany('App\Utilisateur','post_aimes','post_id','aime_user_id');
    }*/


}
