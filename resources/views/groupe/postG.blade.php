
@extends('layouts.app')
@yield('stylee')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 " >
                @include('groupeA.card_profile')
                <br>
                <div class="list-group">
                    <a href="/groupe/{{$groupeAca->id}}" style="color: black;" ><div class="list-group-item">
                            <h5> <i class="fa fa-home"> </i>&nbsp;&nbsp;&nbsp;&nbsp;Groupe</h5>
                        </div></a>

                    <a href="/groupePhoto/{{$groupeAca->id}}" style="color: black;" ><div class="list-group-item">
                            <h5><i class="fa fa-image"> </i>&nbsp;&nbsp;&nbsp;&nbsp;Photo</h5>
                        </div></a>
                    <a href="/groupeFichier/{{$groupeAca->id}}" style="color: black;" >
                        <div class="list-group-item">
                            <h5><i class="fa fa-file"> </i>&nbsp;&nbsp;&nbsp;&nbsp;Fichier</h5>
                        </div>
                    </a>
                    <a href="/groupeMembre/{{$groupeAca->id}}" style="color: black;" >
                        <div class="list-group-item">
                            <h5><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;Membre</h5>
                        </div>
                    </a>

                </div>
            </div>

            <div class="col-md-8 " >
                <div class="card">
                    <img class="card-img-top"  src="/storage/images/{{$groupeAca->image}}" height="300px"   alt="Card image cap">
                    <div class="card-body">
                        <h3 style="font-weight: bold" class="card-text">{{$groupeAca->designation}}</h3>
                    </div>
                </div>
                <br>

                @yield('contenu')

            </div>

        </div>
    </div>
@endsection