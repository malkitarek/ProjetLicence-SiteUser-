<?php

namespace App\Http\Controllers;

use App\Groupe;
use App\Groupe_Utilisateur;
use App\post_g;
use App\PostAime_g;
use App\PostCommentaire_g;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupeController extends Controller
{
    public function store(Request $request){
        $idAuth=Auth::user()->utilisateur->id;
        $this->validate($request,(['designation'=>'required','image'=>'image|nullable',
        ]));
        if($request->hasFile('image')){
            $fullname=$request->file('image')->getClientOriginalName();
            $name=pathinfo($fullname,PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $nameToStore=$name.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images',$nameToStore);
            $destinationPath="C:/xampp/htdocs/page_admin/public/storage/images";
            $request->file('image')->move( $destinationPath,$nameToStore);
            //  Storage::disk('s3')->copy('page_admin/public/images/'.$nameToStore, 'util/public/images/'.$nameToStore);

        }
        else{
            $nameToStore='default.jpg';
        }

        $groupe=new Groupe();
        $groupe->utilisateur_id=$idAuth;
        $groupe->designation=$request->input('designation');
        $groupe->image=$nameToStore;
        $groupe->save();
        foreach ($request->input('membres') as $selected_id){
            $g=new Groupe_Utilisateur();

            $g->utilisateur_id=$selected_id;
            $g->groupe_id=$groupe->id;
            $g->save();
        }
        return redirect('/home');


    }
    public function show($id){
        $idA=Auth::user()->utilisateur->id;
        $groupeAca=Groupe::find($id);
        $user=Utilisateur::find($idA);


        return view('groupe.show')->with('groupeAca',$groupeAca)->with('user',$user);
    }
    public function create(Request $request,$id){
        $idA=Auth::user()->utilisateur->id;
        $contenuPGA=$request->contenuPG;
        $postPGA=new post_g();
        $postPGA->contenu=$contenuPGA;
        $postPGA->utilisateur_id=$idA;
        $postPGA->groupe_id=$id;
        $postPGA->save();
        return ['redirect' => 'http://util.web/groupe/'.$id];

    }
    public function saveImgPGA(Request $request,$ida){
        $img = $request->get('imagePG');

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


        $postPGA=new post_g();
        $postPGA->contenu=$request->contenuPG;
        $postPGA->image=$filename;
        $postPGA->groupe_id=$ida;
        $postPGA->utilisateur_id=$id;
        $postPGA->save();




        return ['redirect' => 'http://util.web/groupe/'.$ida];


    }
    public function index(){
        $postsPGA=post_g::orderBy('created_at','desc')->with('utilisateur')->get();

        return $postsPGA;

    }
    public function storee(Request $request,$id){

        //$path=$request->file('fichier')->store('public/storage');
        $idA=Auth::user()->utilisateur->id;
        $path=$request->file('filee')->store('public/storage');
        $fullname=$request->file('filee')->getClientOriginalName();
        $name=pathinfo($fullname,PATHINFO_FILENAME);
        $extension=$request->file('filee')->getClientOriginalExtension();
        $nameToStore=$name.'.'.$extension;
        $postPGA=new post_g();
        $postPGA->file=$path;

        $postPGA->groupe_id=$id;
        $postPGA->utilisateur_id=$idA;
        $postPGA->titre=$nameToStore;
        $postPGA->save();
        return['redirect' => 'http://util.web/groupe/'.$id];;
    }

    public function destroy($id){
        $post=post_g::find($id);
        $post2=PostAime_g::where('post_id',$id);
        $post3=PostCommentaire_g::where('post_id',$id);
         $post2->delete();
        $post3->delete();
        $post->delete();
        if($post){
            $postsPGA=post_g::orderBy('created_at','desc')->with('utilisateur')->get();
            // $posts=Post::orderBy('created_at','desc')->with(['utilisateuraimes','utilisateur'])->get();
            return $postsPGA;
        }}
    public function modfierContenu(Request $request,$id){
        $post=post_g::find($id);
        $groupeA=$post->groupe_id;
        $post->contenu=$request->contenuPG;
        $post->save();





        return ['redirect' => 'http://util.web/groupe/'.$groupeA];
    }

    public  function ss($id){
        $dl=post_g::find($id);
        return Storage::download($dl->file,$dl->titre);
    }
    /*************************************************************************************/
    public function indexAimer($id){
        $idAuth=Auth::user()->utilisateur->id;

        $posts2=PostAime_g::where('aime_user_id',$idAuth)->where('post_id',$id)->count();



        return  $posts2;
    }
    public function createAime($id){

        $ida=Auth::user()->utilisateur->id;
        $aime1=PostAime_g::where('aime_user_id',$ida)->where('post_id',$id)->first();
        if($aime1){
            PostAime_g::where('aime_user_id',$ida)->where('post_id',$id)->delete();
        }
        else{
            $aime=new PostAime_g();
            $aime->aime_user_id=$ida;
            $aime->post_id=$id;
            $aime->save();
        }
        $posts2=PostAime_g::where('aime_user_id',$ida)->where('post_id',$id)->count();



        return  $posts2;




    }
    /********************************************************************************/
    public function indexCommentaire($id){
        $commentaires=PostCommentaire_g::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
        return $commentaires ;

    }

    public function createCommentaire(Request $request,$id){
        $ida=Auth::user()->utilisateur->id;
        $contenu=$request->contenuC;
        $commentaire=new PostCommentaire_g();
        $commentaire->contenu=$contenu;
        $commentaire->comment_user_id=$ida;
        $commentaire->post_id=$id;
        $commentaire->save();
        if($commentaire){
            $commentaires=PostCommentaire_g::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
            return response()->json($commentaires);}
    }
    /***********************************************/
    public function showPhoto($id){
        $idA=Auth::user()->utilisateur->id;
        $images=post_g::where('groupe_id',$id)->where('image','!=',null)->orderBy('created_at','desc')->get();
        $user=Utilisateur::find($idA);
        $groupeAca=Groupe::find($id);
        return view('groupe.photo')->with('images',$images)->with('user',$user)->with('groupeAca',$groupeAca);
    }

    public function showMembre($id){
        $idA=Auth::user()->utilisateur->id;
        $membre=Groupe::find($id)->utilisateurs()->get();
        $user=Utilisateur::find($idA);
        $groupeAca=Groupe::find($id);

        return view('groupe.membre')->with('membre',$membre)->with('user',$user)->with('groupeAca',$groupeAca);

    }
    public function showFichier($id){
        $idA=Auth::user()->utilisateur->id;
        $files=post_g::where('groupe_id',$id)->where('file','!=',null)->orderBy('created_at','desc')->get();
        $user=Utilisateur::find($idA);
        $groupeAca=Groupe::find($id);
        return view('groupe.fichier')->with('files',$files)->with('user',$user)->with('groupeAca',$groupeAca);


    }

}
