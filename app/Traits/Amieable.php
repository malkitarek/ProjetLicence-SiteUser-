<?php
/**
 * Created by PhpStorm.
 * User: pc bridge
 * Date: 03/04/2018
 * Time: 11:46
 */
namespace App\Traits;

use App\Amie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
trait Amieable{

    public function ajouter ($id){
        $amie=Amie::create([
           'utilisateur_id'=>$this->id,
            'from_id'=>$id,
            'accepter'=>false,

        ]);
      if($amie) return $amie;
      return 'error';
    }

}