@extends('layouts.app')
@section('sedibar')
    @include('menu.sidebar')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @if(count($amis)>0  )
                <div class="col-md-9"style="margin-left: 20%;margin-top: -4%">
                    <div class="card">
                        <div class="card-header" style="font-weight: bold"> La List Des Amis</div>

                        <div class="card-body">

                            <div class="col-sm-12 col-md-12">
                                @foreach($amis as $user)

                                    <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                        <div class="col-md-2 pull-left">
                                            <img style="border-style: solid;border-color: #00A6EB;width: 80px;height: 80px" src="/storage/images/{{$user->photo}}"  class="img-thumbnail"/>
                                        </div>

                                        <div class="col-md-7 pull-left">
                                            <?php
                                            $en=\Illuminate\Support\Facades\DB::table('enseignants')
                                                ->where('id',$user->utilisateurable_id)
                                                ->first();
                                            $et=\Illuminate\Support\Facades\DB::table('etudiants')
                                                ->where('id',$user->utilisateurable_id)
                                                ->first();
                                            ?>

                                            @if($user->utilisateurable_type =="enseignant")
                                                <h3 style="margin:0px;"><a href="#">{{ucwords($user->nom)}} {{ucwords($user->prenom)}}</a></h3>
                                                <p><i class="fas fa-briefcase"></i>{{$user->utilisateurable_type}}</p>
                                                <p>{{$en->grade}}</p>
                                            @elseif($user->utilisateurable_type =="etudiant")
                                                <h3 style="margin:0px;"><a href="#">{{ucwords($user->nom)}} {{ucwords($user->prenom)}}</a></h3>
                                                <p><i class="fas fa-briefcase"></i>{{$user->utilisateurable_type}}</p>
                                                <p>{{$et->niveau}}</p>
                                            @endif
                                        </div>

                                        <div class="col-md-3 pull-right">

                                            <p>

                                                <a href="#"  class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal2"> Retirer</a>
                                            <div class="modal fade" id="myModal2" >
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Suppression</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            voulez-vous vraiment retirer {{$user->nom}} de la list
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                            <a href="/supprimerAmi/{{$user->id}}"
                                                               class="btn btn-danger btn-sm">Confirmer</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            </p>



                                        </div>

                                    </div>
                                @endforeach

                            </div>




                        </div>
                    </div>
                </div>
                @else
                <h1>Aucun ami exist</h1>
                @endif
        </div>
    </div>
    @endsection