<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
   public function utilisateurs(){
       return $this->morphMany('App\Utilisateur','utilisateurable');
   }
}
