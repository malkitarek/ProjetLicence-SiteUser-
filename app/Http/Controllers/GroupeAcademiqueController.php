<?php

namespace App\Http\Controllers;

use App\GroupeAcadémique;
use App\post_ga;
use App\PostAime_ga;
use App\PostCommentaire_ga;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GroupeAcademiqueController extends Controller
{
    public function show($id){
     $idA=Auth::user()->utilisateur->id;
        $groupeAca=GroupeAcadémique::find($id);
        $user=Utilisateur::find($idA);


        return view('groupeA.show')->with('groupeAca',$groupeAca)->with('user',$user);
    }

    public function create(Request $request,$id){
        $idA=Auth::user()->utilisateur->id;
        $contenuPGA=$request->contenuPGA;
        $postPGA=new post_ga();
        $postPGA->contenu=$contenuPGA;
        $postPGA->utilisateur_id=$idA;
        $postPGA->groupeA_id=$id;
        $postPGA->save();
        return ['redirect' => 'http://util.web/groupeAcademique/'.$id];

    }
    public function saveImgPGA(Request $request,$ida){
        $img = $request->get('imagePGA');

        $id=Auth::user()->utilisateur->id;

        $exploded = explode(",",$img);

        if(str_contains($exploded[0], 'gif')){
            $ext = 'gif';
        }else if(str_contains($exploded[0], 'png')){
            $ext = 'png';
        }else if(str_contains($exploded[0], 'jpg')){
            $ext = 'jpg';
        }
        else if(str_contains($exploded[0], 'jpeg')){
            $ext = 'jpeg';
        }
    else if(str_contains($exploded[0], 'gif')){
            $ext = 'gif';
        }
    else{
            $ext = 'bmp';
        }

        $decode = base64_decode($exploded[1]);
        $filename = str_random() . "." . $ext;

        $path = public_path().'/images/'.$filename;
        file_put_contents($path,$decode);




        // echo "file uploaded" . $filename;


        $postPGA=new post_ga();
        $postPGA->contenu=$request->contenuPGA;
        $postPGA->image=$filename;
        $postPGA->groupeA_id=$ida;
        $postPGA->utilisateur_id=$id;
        $postPGA->save();




        return ['redirect' => 'http://util.web/groupeAcademique/'.$ida];


    }
    public function index(){
        $postsPGA=post_ga::orderBy('created_at','desc')->with('utilisateur')->get();

        return $postsPGA;

    }
    public function destroy($id){
        $post=post_ga::find($id);
        $post2=PostAime_ga::where('post_id',$id);
        $post3=PostCommentaire_ga::where('post_id',$id);
        $post2->delete();
        $post3->delete();
        $post->delete();
        if($post){
            $postsPGA=post_ga::orderBy('created_at','desc')->with('utilisateur')->get();
            // $posts=Post::orderBy('created_at','desc')->with(['utilisateuraimes','utilisateur'])->get();
            return $postsPGA;
        }}
    public function modfierContenu(Request $request,$id){
        $post=post_ga::find($id);
        $groupeA=$post->groupeA_id;
        $post->contenu=$request->contenuPGA;
        $post->save();





        return ['redirect' => 'http://util.web/groupeAcademique/'.$groupeA];
    }
    /*************************************************************************************/
    public function indexAimer($id){
        $idAuth=Auth::user()->utilisateur->id;

        $posts2=PostAime_ga::where('aime_user_id',$idAuth)->where('post_id',$id)->count();



        return  $posts2;
    }
    public function createAime($id){

        $ida=Auth::user()->utilisateur->id;
        $aime1=PostAime_ga::where('aime_user_id',$ida)->where('post_id',$id)->first();
        if($aime1){
            PostAime_ga::where('aime_user_id',$ida)->where('post_id',$id)->delete();
        }
        else{
            $aime=new PostAime_ga();
            $aime->aime_user_id=$ida;
            $aime->post_id=$id;
            $aime->save();
        }
        $posts2=PostAime_ga::where('aime_user_id',$ida)->where('post_id',$id)->count();



        return  $posts2;




    }
    /********************************************************************************/
    public function indexCommentaire($id){
        $commentaires=PostCommentaire_ga::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
        return $commentaires ;

    }

    public function createCommentaire(Request $request,$id){
        $ida=Auth::user()->utilisateur->id;
        $contenu=$request->contenuC;
        $commentaire=new PostCommentaire_ga();
        $commentaire->contenu=$contenu;
        $commentaire->comment_user_id=$ida;
        $commentaire->post_id=$id;
        $commentaire->save();
        if($commentaire){
            $commentaires=PostCommentaire_ga::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
            return response()->json($commentaires);}
    }

    public function store(Request $request,$id){

     //$path=$request->file('fichier')->store('public/storage');
        $idA=Auth::user()->utilisateur->id;
        $path=$request->file('file')->store('public/storage');
        $fullname=$request->file('file')->getClientOriginalName();
        $name=pathinfo($fullname,PATHINFO_FILENAME);
        $extension=$request->file('file')->getClientOriginalExtension();
        $nameToStore=$name.'.'.$extension;
        $postPGA=new post_ga();
        $postPGA->file=$path;

        $postPGA->groupeA_id=$id;
        $postPGA->utilisateur_id=$idA;
        $postPGA->titre=$nameToStore;
        $postPGA->save();
        return['redirect' => 'http://util.web/groupeAcademique/'.$id];;
    }
    public  function ss($id){
        $dl=post_ga::find($id);
        return Storage::download($dl->file,$dl->titre);
    }

public function showPhoto($id){
        $idA=Auth::user()->utilisateur->id;
        $images=post_ga::where('groupeA_id',$id)->where('image','!=',null)->orderBy('created_at','desc')->get();
    $user=Utilisateur::find($idA);
    $groupeAca=GroupeAcadémique::find($id);
        return view('groupeA.photo')->with('images',$images)->with('user',$user)->with('groupeAca',$groupeAca);
}
public function showMembre($id){
    $idA=Auth::user()->utilisateur->id;
    $membre=GroupeAcadémique::find($id)->utilisateurs()->get();
    $user=Utilisateur::find($idA);
    $groupeAca=GroupeAcadémique::find($id);

    return view('groupeA.membre')->with('membre',$membre)->with('user',$user)->with('groupeAca',$groupeAca);

}
public function showFichier($id){
    $idA=Auth::user()->utilisateur->id;
    $files=post_ga::where('groupeA_id',$id)->where('file','!=',null)->orderBy('created_at','desc')->get();
    $user=Utilisateur::find($idA);
    $groupeAca=GroupeAcadémique::find($id);
    return view('groupeA.fichier')->with('files',$files)->with('user',$user)->with('groupeAca',$groupeAca);


}


}
