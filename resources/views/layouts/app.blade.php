<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

   <!-- <script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fixed.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar_left.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css">

<!--<link href="{{ asset('css/post.css') }}" rel="stylesheet">-->
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        a:link, a:visited{
            text-decoration:none;
        }
       </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#cc").mouseover(function(){
                $("#cc").css("background-color", "black");
            });
            $("#cc").mouseout(function(){
                $("#cc").css("background-color", "#00A6EB");
            });


        });
    </script>
    <script>
        $(document).ready(function(){
            $("#cr").mouseover(function(){
                $("#cr").css("background-color", "black");
            });
            $("#cr").mouseout(function(){
                $("#cr").css("background-color", "#00A6EB");
            });


        });
    </script>

    @yield('css')
</head>
<body>



<div id="app" data-base="/conversation">
    @auth
   @yield('sedibar')
    @endauth

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top"  style="background-color: #00A6EB;"  >
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
               @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown"  >

                            <input class="form-control mr-sm-5" type="search" placeholder="Search" aria-label="Search" v-model="query" v-on:Keyup="recherche"
                                  data-toggle="dropdown" >
                           <!-- <button class="btn btn-outline-success my-2 my-sm-0 "  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Search</button>

                         -->

                        <div  class="dropdown-menu " aria-labelledby="navbarDropdown"   >




                              <a class="dropdown-item" v-for="item in items" v-if="query"  >
                                <img style="border-style: solid;border-color: #00A6EB;"width="50px" height="50px" class="rounded-circle" :src="'{{Config::get('app.url')}}/storage/images/' + item.photo" >
                                &nbsp;@{{ item.nom }}&nbsp;
                                @{{ item.prenom }}
                            </a>
                        </div>



                    </li>
                </ul>

                @endauth

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    @guest
                    <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}">Register</a></li>
                    @else


                        <li class="nav-item" id="cc" ><a class="nav-link" href="/home" style="font-weight: bold;font-size: large ;color: white">Acceuil</a> </li>
                        &nbsp;&nbsp;
                        <li class="nav-item" id="cr" ><a class="nav-link" href="/retrouverAmies" style="font-weight: bold;font-size: large ;color: white">Retrouver Amis</a> </li>



                                <?php
                        $ac= \App\Utilisateur::rightJoin('users','utilisateurs.id','=','users.utilisateur_id')->rightJoin('amies','users.id','=','amies.from_id')
                            ->where('amies.utilisateur_id',\Illuminate\Support\Facades\Auth::user()->id)->where('amies.accepter',1)->count();
                        $acc= \App\Utilisateur::rightJoin('users','utilisateurs.id','=','users.utilisateur_id')->rightJoin('amies','users.id','=','amies.from_id')
                                   ->where('amies.utilisateur_id',\Illuminate\Support\Facades\Auth::user()->id)->where('amies.accepter',1)
                                   ->orderBy('amies.created_at','desc')->get();

                                ?>
                    &nbsp;&nbsp;
                    <li class="nav-item dropdown">
                        <a  class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-bell fa-2x"></i>
                        </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 350px">
                                    @foreach($acc as $user)
                                        <a href="">
                                            @if($user->accepter==0)
                                                <li style="background:#E4E9F2; padding:10px">
                                            @else
                                                <li style="padding:10px">
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="/storage/images/{{$user->photo}}"
                                                                 style="width:50px; padding:5px; background:#fff; border:1px solid #00A6EB" class="rounded-circle">
                                                        </div>

                                                        <div class="col-md-10">

                                                            <b style="color:black; font-size:90%">{{ucwords($user->nom)}}</b>
                                                            <span style="color:#000; font-size:90%">a été accepté votre invitation</span>
                                                            <br/>
                                                            <small style="color:#90949C"> <i aria-hidden="true" class="fa fa-users"></i>
                                                                {{date('F j, Y', strtotime($user->created_at))}}
                                                                at {{date('H: i', strtotime($user->created_at))}}</small>
                                                        </div>

                                                    </div>
                                                </li></a><div class="dropdown-divider"></div>
                                    @endforeach
                                </ul>
                    </li>
                        &nbsp;&nbsp;&nbsp;
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-envelope fa-2x"></i></a></li>

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="nav-item dropdown">
                                <a style="font-weight: bold;color: white;" id="navbarDropdown " class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    <img class="rounded-circle"  src="/storage/images/{{Auth::user()->utilisateur->photo}}" style="height: 30px;width: 30px ">
                                     {{ucwords(Auth::user()->utilisateur->nom)}} <span class="caret"></span>

                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile">
                                        <i class="fa fa-user-circle"></i> Mon Profile
                                    </a>
                                   <a class="dropdown-item" href="" data-toggle="modal" data-target="#gr2" >
                                        <i class="fa fa-users"></i> Créer groupe
                                    </a>
                                    <!-- Button trigger modal -->






                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
                    @if(session('success'))
                        <div class="container">
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="container">
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        </div>
                    @endif
                        @yield('content')
                        @auth
                           <?php
                        $id1=\Illuminate\Support\Facades\Auth::user()->utilisateur->id;
                        $groupeA=\App\Utilisateur::find($id1)-> groupe_académiques()->get();
                        $groupes=\App\Utilisateur::find($id1)-> groupes()->get();
                        $id=\Illuminate\Support\Facades\Auth::user()->id;
                        $ami1=\Illuminate\Support\Facades\DB::table('amies')->leftJoin('users','users.id','amies.from_id')->leftJoin('utilisateurs','utilisateurs.id','users.utilisateur_id')->where('amies.accepter',true)->where('amies.utilisateur_id',$id)->get();
                        $ami2=\Illuminate\Support\Facades\DB::table('amies')->leftJoin('users','users.id','amies.utilisateur_id')->leftJoin('utilisateurs','utilisateurs.id','users.utilisateur_id')->where('amies.accepter',true)->where('amies.from_id',$id)->get();
                        $amis=array_merge($ami1->toArray(),$ami2->toArray());
                        ?>

                     @include('groupe.modal')
              @endauth


        </main>
    </div>

<script src="{{ mix('js/app.js') }}" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
</body>
</html>
