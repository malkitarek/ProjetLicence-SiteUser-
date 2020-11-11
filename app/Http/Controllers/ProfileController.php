<?php

namespace App\Http\Controllers;

use App\Amie;
use App\Post;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index(){
        $id=Auth::user()->utilisateur->id;
        $id2=Auth::user()->id;
        $utilisateur=Utilisateur::where('id',$id)->first();
        $amis=Amie::where('utilisateur_id',$id2)->count();
        $post=Post::where('user_id',$id)->count();
        return view('profile.show')->with('utilisateur',$utilisateur)->with('amis',$amis)->with('post',$post);
    }
    public function update(Request $request){

            $img = $request->get('imageP');

            $id=Auth::user()->utilisateur->id;

            $exploded = explode(",",$img);

            if(str_contains($exploded[0], 'gif')){
                $ext = 'gif';
            }else if(str_contains($exploded[0], 'png')){
                $ext = 'png';
            }else if(str_contains($exploded[0], 'jpg')){
                $ext = 'jpg';
            }
            else{
                $ext = 'jpeg';
            }

            $decode = base64_decode($exploded[1]);
            $filename = str_random() . "." . $ext;
        $destinationPath="C:/xampp/htdocs/page_admin/public/storage/images";
       // $fullname=$request->get('image')->getClientOriginalName();
     // $request->file('logo')->move( $destinationPath,$filename);
            $path = public_path().'/storage/images/'.$filename;
            file_put_contents($path,$decode);


        /*$name =  $request->file('image')->getClientOriginalName();
        $request->file('image')->move($destinationPath, $name);*/
            // echo "file uploaded" . $filename;


            $utilisateur=Utilisateur::find($id);
            $utilisateur->photo=$filename;
            $utilisateur->save();





            return ['redirect' => route('profile')];


        }
        public function test(Request $request){

            $extension=$request->file('imageFile')->getClientOriginalExtension();
            $filename= str_random().'.'.$extension;

            $destinationPath="C:/xampp/htdocs/page_admin/public/storage/images";
            $request->file('imageFile')->move( $destinationPath,$filename);
            return redirect("profile");
        }
}
