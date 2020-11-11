<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function from(){
        return $this->belongsTo('App\Utilisateur','from_id');
    }
    public function to(){
        return $this->belongsTo('App\Utilisateur','to_id');
    }
}
