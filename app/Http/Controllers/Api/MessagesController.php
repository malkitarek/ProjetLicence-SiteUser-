<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Message;
use App\Utilisateur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index(Request $request){
         $idU=$request->user()->utilisateur->id;
         $idAU=Auth::user()->utilisateur->id;
        $users=Utilisateur::where('id','!=',$idU)->with('user')->get();
        $unread=Message::where('to_id','=',$idU)->groupBy('from_id')->selectRaw('from_id,COUNT(id) as count')->whereRaw('read_at IS NULL')
            ->get()->pluck('count','from_id');
        foreach ($users as $user){
            if(isset($unread[$user->id])){
                $user->unread=$unread[$user->id];
            }else{
                $user->unread=0;
            }

        }

        return
            [
                'users'=>$users
            ]
        ;
    }
    public function show(Request $request,Utilisateur $id){
        $idAU=Auth::user()->utilisateur->id;
        $user=$request->user()->utilisateur->id;
        $messages=Message::whereRaw("((from_id=$id->id AND to_id=$user)OR(from_id=$user AND to_id=$id->id))")->with('from')->get();
        $messagess=Message::whereRaw("((from_id=$id->id AND to_id=$user)OR(from_id=$user AND to_id=$id->id))")->with('from');
        foreach ($messages as $message){
            if($message->read_at == NULL && $message->to_id==$user){
                Message::where('from_id',$message->from_id)->where('to_id',$message->to_id)->update(["read_at"=>(Carbon::now())]);
                //unset($unread[$user->id]);
                break;
            }

        }



        return

                [
                    'messages'=>$messagess->get(),
                    'count'=> $messages->count()
                ]
            ;

    }
   /* public function store(Request $request, $id){
        $this->validate($request,(['content'=>'required']));
        $user=$request->user()->utilisateur->id;
        $message=new Message();
        $message->content=$request->get('content');
        $message->from_id=$request->user()->utilisateur->id;
        $message->to_id=$id;
        $message->save();
       $id2 = DB::table('users')
            ->join('utilisateurs', 'users.utilisateur_id', '=', 'utilisateurs.id')
            ->join('messages', 'utilisateurs.id', '=', 'messages.to_id')
            ->where('messages.to_id',$message->to_id)

            ->value('users.id');
        //dd($id2);
        broadcast(new NewMessage($message,$id2));
        $messages=Message::whereRaw("((from_id=$id AND to_id=$user)OR(from_id=$user AND to_id=$id))")->with('from')->get();
        foreach ($messages as $message){
            if($message->read_at == NULL && $message->to_id==$user){
                Message::where('from_id',$message->from_id)->where('to_id',$message->to_id)->update(["read_at"=>(Carbon::now())]);
                //unset($unread[$user->id]);
                break;
            }

        }

        return

            [
                'messages'=>$messages,

            ]
            ;

    }*/
    public function store(Request $request, $id){
        $this->validate($request,(['content'=>'required']));
        $user=$request->user()->utilisateur->id;
        $message=new Message();
        $message->content=$request->get('content');
        $message->from_id=$request->user()->utilisateur->id;
        $message->to_id=$id;
        $message->save();
        $id2 = DB::table('users')
            ->join('utilisateurs', 'users.utilisateur_id', '=', 'utilisateurs.id')
            ->join('messages', 'utilisateurs.id', '=', 'messages.to_id')
            ->where('messages.to_id',$message->to_id)

            ->value('users.id');
        //dd($id2);
        broadcast(new NewMessage($message,$id2));
        $messages=Message::whereRaw("((from_id=$id AND to_id=$user)OR(from_id=$user AND to_id=$id))")->with('from')->get();
        foreach ($messages as $message){
            if($message->read_at == NULL && $message->to_id==$user){
                Message::where('from_id',$message->from_id)->where('to_id',$message->to_id)->update(["read_at"=>(Carbon::now())]);
                //unset($unread[$user->id]);
                break;
            }

        }

        return

            [
                'message'=>$message

            ]
            ;

    }
}
