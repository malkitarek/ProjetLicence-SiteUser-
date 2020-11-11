<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amie extends Model
{
    protected $fillable = [
        'utilisateur_id','from_id', 'accepter',
    ];}
