<?php

namespace App\Policies;

use App\User;
use App\Utilisateur;
use Illuminate\Auth\Access\HandlesAuthorization;

class UtilisateurPolicy
{
    use HandlesAuthorization;

  public function talkTo(Utilisateur $user, Utilisateur $to){
      return $user->user->id !== $to->user->id;
  }
}
