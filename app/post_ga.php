<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_ga extends Model
{
    public function utilisateur(){
        return $this->belongsTo('App\Utilisateur','utilisateur_id');
    }
    public function groupeAcademique(){
        return $this->belongsTo('App\GroupeAcadémique','groupeA_id');
    }
}
