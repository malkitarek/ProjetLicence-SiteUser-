<?php

namespace App\Http\Controllers;
use App\Amie;
use Illuminate\Database\Query\Builder;
use App\User;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AmieController extends Controller
{
    public function retrouver (){
        $id=Auth::user()->id;

        $id2=Auth::user()->utilisateur->id;
        $groupeA=Utilisateur::find($id2)-> groupe_académiques()->get();
        $groupes=Utilisateur::find($id2)-> groupes()->get();


       $amieinvite=Utilisateur::rightJoin('users','utilisateurs.id','=','users.utilisateur_id')->rightJoin('amies','users.id','=','amies.utilisateur_id')
           ->where('amies.from_id',$id)->where('amies.accepter',0)->get();
        $idAmis=Amie::whereRaw("(from_id=$id OR utilisateur_id=$id)")->where('accepter',1)->get();
        //$idAmisInvit=Amie::where('from_id',$id)->where('accepter',1)->get();

        $users=User::whereRaw("(id != $id) AND ( (id NOT IN (SELECT from_id FROM amies WHERE ( utilisateur_id=$id AND accepter=1))) AND (id NOT IN (SELECT utilisateur_id FROM amies WHERE (from_id=$id))))")->get();


        //return $idAmisInvit;

        return view('amies.retrouver')->with('users',$users)->with('amieinvite',$amieinvite)
            ->with('idAmis',$idAmis)->with('groupe',$groupeA)->with('groupes',$groupes);

    }
    public function envoyer($id){

        Auth::user()->ajouter($id);
        return back();
    }
    public function accepter($nom,$id){
        $idd=Auth::user()->id;

        $chk=Amie::where('utilisateur_id',$id)->where('from_id',$idd)->update(['accepter'=>true]);
        if($chk){

        return back()->with('message','vous êtes maintenant ami avec'.' '.$nom);}
else{return back()->with('message','erreur');}
    }
    public function amis(){
        $id=Auth::user()->id;
        $ami1=DB::table('amies')->leftJoin('users','users.id','amies.from_id')->leftJoin('utilisateurs','utilisateurs.id','users.utilisateur_id')->where('amies.accepter',true)->where('amies.utilisateur_id',$id)->get();
        $ami2=DB::table('amies')->leftJoin('users','users.id','amies.utilisateur_id')->leftJoin('utilisateurs','utilisateurs.id','users.utilisateur_id')->where('amies.accepter',true)->where('amies.from_id',$id)->get();
        $amis=array_merge($ami1->toArray(),$ami2->toArray());
        $id2=Auth::user()->utilisateur->id;
        $groupeA=Utilisateur::find($id2)-> groupe_académiques()->get();
        $groupes=Utilisateur::find($id2)-> groupes()->get();
        return view('amies.list_amis')->with('amis',$amis)->with('groupe',$groupeA)->with('groupes',$groupes);
    }
    public function supprimer($id){
       $idauth=Auth::user()->id;
        $usersupp=Amie::where('utilisateur_id',$id)->where('from_id',$idauth);
        $usersupp->delete();
        return back();

    }

    public function supprimerAmi($id){
        $iduser=User::where('utilisateur_id',$id)->value('id');
          $idAuth=Auth::user()->id;
          $supp=Amie::where(function ($query) use($iduser) {
              $query->where('utilisateur_id', $iduser)
                  ->where('from_id', Auth::user()->id);
          })->orWhere(function($query) use($iduser){
              $query->where('utilisateur_id',Auth::user()->id)
                  ->where('from_id', $iduser);});

          $supp->delete();
          return back();


    }
}
