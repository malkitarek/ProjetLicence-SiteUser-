<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public function user(){
       return $this->hasOne('App\User');
    }
    public function utilisateurable(){
        return $this->morphTo();
    }
    public function groupe_académiques(){
        return $this->belongsToMany('App\GroupeAcadémique','groupe_académique_utilisateur');
    }
    public function groupes(){
        return $this->belongsToMany('App\Groupe','groupe_utilisateur');
    }

    public function post(){
        return $this->hasMany('App\Post','user_id');
    }
    public function post_ga(){
        return $this->hasMany('App\post_ga','utilisateur_id');
    }
    public function post_g(){
        return $this->hasMany('App\post_g','utilisateur_id');
    }
    public function postaimes(){
        return $this->hasMany('App\PostAime','aime_user_id');
    }

    public function groupes_admin(){
        return $this->hasMany('App\Groupe','utilisateur_id');
    }
    /*public function postaimes(){
        return $this->belongsToMany('App\Post','post_aimes','aime_user_id','post_id');
    }*/
}
