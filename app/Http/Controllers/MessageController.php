<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        $id=Auth::user()->utilisateur->id;
        $unread=Message::where('to_id','=',$id)->groupBy('from_id')->selectRaw('from_id,COUNT(id) as count')->whereRaw('read_at IS NULL')
        ->get()->pluck('count','from_id');
        return view('messages.message');
    }
    public function show(Utilisateur $user){

        $id=Auth::user()->utilisateur->id;
        $users=Utilisateur::where('id','!=',$id)->get();
        $messages=Message::whereRaw("((from_id=$id AND to_id=$user->id)OR(from_id=$user->id AND to_id=$id))")->get();
        return view('messages.messageShow')->with('users',$users)->with('user',$user)->with('messages',$messages);
    }
    public function store(Request $request,Utilisateur $user){
        $this->validate($request,(['content'=>'required']));
     $message=new Message();
     $message->content=$request->input('content');
     $message->from_id=Auth::user()->utilisateur->id;
     $message->to_id=$user->id;
     $message->save();
     return back();


    }
}
