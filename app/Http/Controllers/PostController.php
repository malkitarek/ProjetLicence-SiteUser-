<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostAime;
use App\PostCommentaire;
use App\PostCommentaire_ga;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   public function index(){
       $posts=Post::orderBy('created_at','desc')->with(['postaimes','utilisateur','postcommentaires'])->get();

       return $posts;

   }
    public function create(Request $request){
        $this->validate($request,(['contenu'=>'alpha']));
          $id=Auth::user()->utilisateur->id;
         $contenu=$request->contenu;
        $post=new Post();
        $post->contenu=$contenu;
        $post->user_id=$id;
        $post->save();
       return ['redirect' => route('home')];


    }

    public function destroy($id){
        $post=Post::find($id);
        $post2=PostAime::where('post_id',$id);
        $post3=PostCommentaire::where('post_id',$id);
        $post2->delete();
        $post3->delete();
        $post->delete();
        if($post){
            $posts=Post::orderBy('created_at','desc')->with(['utilisateur','postaimes'])->get();
           // $posts=Post::orderBy('created_at','desc')->with(['utilisateuraimes','utilisateur'])->get();
            return $posts;
        }}
/*******************************************************************************************************************************/
     public function createAime($id){

         $ida=Auth::user()->utilisateur->id;
         $aime1=PostAime::where('aime_user_id',$ida)->where('post_id',$id)->first();
         if($aime1){
             PostAime::where('aime_user_id',$ida)->where('post_id',$id)->delete();
         }
         else{
             $aime=new PostAime();
             $aime->aime_user_id=$ida;
             $aime->post_id=$id;
             $aime->save();
         }
         $posts2=PostAime::where('aime_user_id',$ida)->where('post_id',$id)->count();



         return  $posts2;




     }
   /* public function createAime2($id){

        $posts2=PostAime::where('post_id',$id)->get();



        return  $posts2;

    }


    /*public function indexAimer2($id){

        $posts2=PostAime::where('post_id',$id)->get();



        return  $posts2;
    }*/





    public function indexAimer($id){
         $idAuth=Auth::user()->utilisateur->id;

         $posts2=PostAime::where('aime_user_id',$idAuth)->where('post_id',$id)->count();



         return  $posts2;
     }
 /***************************************************************************************************************************************/
public function indexCommentaire($id){
    $commentaires=PostCommentaire::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
    return $commentaires ;

}

public function createCommentaire(Request $request,$id){
    $ida=Auth::user()->utilisateur->id;
    $contenu=$request->contenuC;
    $commentaire=new PostCommentaire();
    $commentaire->contenu=$contenu;
    $commentaire->comment_user_id=$ida;
    $commentaire->post_id=$id;
    $commentaire->save();
    if($commentaire){
    $commentaires=PostCommentaire::where('post_id',$id)->with('utilisateur')->orderBy('created_at','desc')->paginate(2);
    return response()->json($commentaires);}
}
    public function saveImg(Request $request){
        $img = $request->get('image');

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


            $post=new Post();
            $post->contenu=$request->contenu;
            $post->image=$filename;

            $post->user_id=$id;
            $post->save();




        return ['redirect' => route('home')];


    }
/****************************************************************************************************************************/
    public function recherche(Request $request){

        $query= $request->get('query');
        $utilisateur=Utilisateur::where('nom','like',$query.'%')->get();
         return $utilisateur->toArray();


    }

    public function modfierContenu(Request $request,$id){
        $post=Post::find($id);
        $post->contenu=$request->contenuM;
        $post->save();





        return ['redirect' => route('home')];
    }
    public function bloquer($id){
        $post=Post::find($id);
        $post->status=1;
        $post->save();
        if($post){
            $posts=Post::orderBy('created_at','desc')->with(['utilisateur','postaimes'])->get();
            // $posts=Post::orderBy('created_at','desc')->with(['utilisateuraimes','utilisateur'])->get();
            return $posts;
        }
    }
    public function suppCommentaire($id){
        $post=PostCommentaire::find($id);

        $post->delete();

        return ['redirect' => route('home')];
    }


}
