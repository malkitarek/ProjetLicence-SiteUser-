@extends('groupeA.postGA')
@section('stylee')
@section('css')
    <style>
        .new-post-box {
            -webkit-box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            -moz-box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            box-shadow: 0px 0px 20px 2px rgba(0,0,0,0.15);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .new-post-box textarea {
            outline: none;
            -webkit-appearance: none;
            resize: none;
            border: none;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            width: 100%;
            font-size: 18px;
            color: #333;
            height: 30px;
            margin-top: 10px;
            padding: 0;
        }

        .new-post-box textarea::-webkit-input-placeholder {
            font-size: 13px;
            color: #9d9d9d;
            font-style: italic;
        }

        .new-post-box hr {
            margin: 10px 0;
        }



        .new-post-box .btn-add-image {
            background: #ececec;
            border-color: #d9d9d9
        }

        .new-post-box .btn-add-image:hover {
            background: #d9d9d9;
            border-color: #c8c8c8
        }

        .new-post-box .btn-submit {
            background: #488ec9;
            border-color: #3c76a7;
            padding-left: 20px;
            padding-right: 20px;
            color: #fff
        }

        .new-post-box .btn-submit:hover {
            background: #3c76a7;
            border-color: #2e5679;
        }

        .new-post-box .loading-post {
            display: none;
        }

        .new-post-box .loading-post img {
            width: 25px;
            height: 25px;
        }

        .new-post-box .image-area {
            text-align: center;
            display: none;
        }

        .new-post-box .image-area img{
            max-width: 100%;
        }

        .new-post-box .image-remove-button {
            background: rgba(255,255,255,0.5);
            position: absolute;
            display: block;
            font-size: 23px;
            padding: 0 10px;
            color: #333;
        }

        .new-post-box .image-remove-button:hover {
            color: #000;
        }
        .user-card {
            background: #fff;
        }

        .user-card .cover {
            width: 100%;
            height: 100px;
            background-color: #334d63;
            background-size: cover;
            background-position: center center;
        }

        .user-card .cover.no-cover {
            height: 50px;
        }

        .user-card .detail {
            border: 1px solid #dedede;
            border-top: none;
            -webkit-border-radius: 0 0 2px 2px;
            -moz-border-radius:  0 0 2px 2px;
            border-radius: 0 0 2px 2px;
            padding: 3px 5px;
            height: 60px;
            box-sizing: border-box;
        }

        .user-card .detail .image {
            display: block;
            float: left;
            margin-top: -25px;
        }

        .user-card .detail .image img {
            width: 70px;
            height: 70px;
            border: 3px solid #c8d6f7;
        }

        .user-card .detail .image img.female {
            border-color: #f7c8eb
        }


        .user-card .detail .info {
            margin-left: 5px;
            display: block;
            float: left;
        }

        .user-card .detail .info .name{
            display: block;
            color: #373737;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, serif;
        }

        .user-card .detail .info .username{
            display: block;
            color: #373737;
            font-size: 13px;
        }


    </style>

@endsection

@section('contenu')
@if(count($membre)>0  )

        <div class="card">
            <div class="card-header" style="font-weight: bold"> La list des membres</div>

            <div class="card-body">

                <div class="col-sm-12 col-md-12">
                    @foreach($membre as $user1)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img style="border-style: solid;border-color: #00A6EB;width: 80px;height: 80px" src="/storage/images/{{$user1->photo}}"  class="img-thumbnail"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <?php
                                $en=\Illuminate\Support\Facades\DB::table('enseignants')
                                    ->where('id',$user1->utilisateurable_id)
                                    ->first();
                                $et=\Illuminate\Support\Facades\DB::table('etudiants')
                                    ->where('id',$user1->utilisateurable_id)
                                    ->first();
                                ?>

                                @if($user1->utilisateurable_type =="enseignant")
                                    <h3 style="margin:0px;"><a href="">{{ucwords($user1->nom)}} {{ucwords($user1->prenom)}}</a></h3>
                                    <p><i class="fas fa-briefcase"></i>{{$user1->utilisateurable_type}}</p>
                                    <p>{{$en->grade}}</p>
                                @elseif($user1->utilisateurable_type =="etudiant")
                                    <h3 style="margin:0px;"><a href="">{{ucwords($user1->nom)}} {{ucwords($user1->prenom)}}</a></h3>
                                    <p><i class="fas fa-briefcase"></i>{{$user1->utilisateurable_type}}</p>
                                    <p>{{$et->niveau}}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                         @else
                             <h1>Aucun membre exist</h1>
                             @endif
                </div>
            </div>
        </div>

@endsection