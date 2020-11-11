<?php

namespace App\Http\Controllers;

use App\Post;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id1=Auth::user()->utilisateur->id;
        $groupeA=Utilisateur::find($id1)-> groupe_académiques()->get();
        $groupes=Utilisateur::find($id1)-> groupes()->get();
        $id=Auth::user()->id;


        return view('home')->with('groupe',$groupeA)->with('groupes',$groupes);
    }
}
