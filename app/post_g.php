<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_g extends Model
{
    public function utilisateur(){
        return $this->belongsTo('App\Utilisateur','utilisateur_id');
    }
    public function groupe(){
        return $this->belongsTo('App\Groupe','groupe_id');
    }
}
