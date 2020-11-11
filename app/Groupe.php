<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table='groupes';
    public function utilisateurs(){
        return $this->belongsToMany('App\Utilisateur','groupe_utilisateur');
    }
    public function post_g(){
        return $this->hasMany('App\post_g','groupe_id');
    }
    public function admin(){
        return $this->belongsTo('App\Utilisateur','utilisateur_id');
    }
}
