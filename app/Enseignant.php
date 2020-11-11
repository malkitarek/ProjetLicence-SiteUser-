<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table =  'enseignants';
    public function utilisateurs(){
        return $this->morphMany('App\Utilisateur','utilisateurable');
    }
}
