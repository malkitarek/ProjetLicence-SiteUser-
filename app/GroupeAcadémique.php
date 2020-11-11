<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeAcadémique extends Model
{
    protected $table='groupe_académiques';
    public function utilisateurs(){
        return $this->belongsToMany('App\Utilisateur','groupe_académique_utilisateur');
    }
    public function post_ga(){
        return $this->hasMany('App\post_ga','groupeA_id');
    }
}
