<?php
namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use App\Message;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller{


    public function index(Request $request){
        $users=Utilisateur::where('id','!=',$request->user()->utilisateur->id)->get();
        return response()->json(
            [
               'users'=>$users
            ]
        );
    }
}