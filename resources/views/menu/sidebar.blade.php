<nav class="col-md-3 d-none d-md-block sidebar position-fixed" style="width:280px;  margin-top: 5%;background-color: white">
    <div class="sidebar-sticky ">

        <ul class="nav flex-column">
            <li class="nav-item" >
                <a class="nav-link " href="#">
                    <img class="rounded-circle"  src="/storage/images/{{Auth::user()->utilisateur->photo}}" style="height: 25px;width: 25px ">
                    {{ucwords(Auth::user()->utilisateur->nom)}}&nbsp;{{ucwords(Auth::user()->utilisateur->prenom)}} <span class="caret"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa fa-home"></i>
                    Accueill <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-envelope"></i>
                    Messages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/amis">
                    <i class="fa fa-address-card"></i>
                    List Amis
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Groupes Académiques</span>

            </h6>
            @foreach($groupe as $grA)
            <li class="nav-item">
                <a class="nav-link" href="/groupeAcademique/{{$grA->id}}">
                    <i class="fa fa-users"></i>
                  {{$grA->designation}}
                </a>
            </li>
            @endforeach
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Groupes </span>

            </h6>
            @foreach($groupes as $gr)
                <li class="nav-item">
                    <a class="nav-link" href="/groupe/{{$gr->id}}">
                        <i class="fa fa-users"></i>
                        {{$gr->designation}}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</nav>