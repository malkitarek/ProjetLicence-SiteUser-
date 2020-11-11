@extends('layouts.app')
@section('css')
    <link href="css/profilee.css" rel="stylesheet">
    <style>
        .avatar {
            width: 100px;
            height: 100px;
            left: 45%;


            position: absolute;


        }
        .avatar .change-image {
            width: 100%;
            height: 100%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            position: absolute;
            background: rgba(0,0,0,0.60);
            display: none;
        }
        .avatar:hover .change-image {
            display: block;
        }
        .avatar .change-image .input-file{
            opacity: 0 ;
            position:absolute ;
            left: 0;
            top: 0
        }

        .avatar .change-image .upload-button {
            color: #fff;
            position: relative;
            text-shadow: 1px 1px #000;
            text-align: center;
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-top: 35%;

        }

        .avatar .change-image .upload-button i{
            display: block;
            font-size: 30px;
        }
        .avatar .change-image .upload-button:hover {
            text-decoration: none;
        }
        #imageProfile{
            border-radius: 20%;
            border: solid 5px;
            border-color: #00A6EB;
            margin-bottom: 5%;
            width: 100px;
            height: 150px;
        }


    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">


            <div class="card t hovercard" style="height: 444px " >


                <div class="cardheader">

                </div>

                <div class="avatar" >

                        <div class="change-image" >
                           <a class="upload-button" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-upload "></i>Upload Photo

                            </a>
                        </div>
                            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">


                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Changer Photo De Profile</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <img v-if="!imageP" id="imageProfile" alt="" src="/storage/images/{{$utilisateur->photo}}">
                                            <img v-if="imageP"id="imageProfile" :src="imageP" >
                                            <a v-if="imageP" class="btn" @click="supprimerImgP" style="margin-top: -20%;margin-left: -2%"><i class="fa fa-times-circle"  ></i></a>

                                            <div class="form-group row">

                                                <label for="designation" class="col-sm-2 col-form-label">Image:</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">


                                                        <input type="file" class="custom-file-input"  id="fileInput" ref = "image" @change="changeProfile">

                                                        <label class="custom-file-label" for="image">Choisier fichier</label>
                                                    </div>
                                                </div>
                                            </div>






                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button v-if="imageP" @click="uploadImgP"  class="btn btn-primary"  >Modifier</button>

                                        </div>

                                    </div>
                                </div>
                            </div>






                    <img alt="" src="/storage/images/{{$utilisateur->photo}}">
                </div>
                <div class="info" style=" background-color: white;">
                    <div class="title">
                        <a style="color: black" href="">{{ucwords($utilisateur->nom)}} {{ucwords($utilisateur->prenom)}}</a>
                    </div>
                    <br>
                    <h5><i class="fa fa-address-book"></i>&nbsp;&nbsp;{{$utilisateur->utilisateurable_type}}({{$utilisateur->sexe}})</h5>
                    <br>
                    <h5><i class="fa fa-at"></i>&nbsp;&nbsp;{{$utilisateur->user->email}}</h5>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="card text-center" >
                <div class="card-header" style="background-color: rgba(200, 200, 200, 200);">
                 <i class="fa fa-archive"></i>&nbsp;<b>Publications</b>
                </div>
                <div class="card-body">
                    <h2 class="card-title" style="color: #00A6EB;">{{$post}}</h2>

                </div>

            </div>
            <br><br>
            <div class="card text-center">
                <div class="card-header" style="background-color: rgba(200, 200, 200, 200);">

                    <i class="fa fa-user-friends"></i><b> Amis</b>
                </div>
                <div class="card-body">
                    <h2 class="card-title"style="color: #00A6EB;">{{$amis}}</h2>

                </div>

            </div>
            <br><br>
            <div class="card text-center">
                <div class="card-header" style="background-color: rgba(200, 200, 200, 200);">
                    <i class="fa fa-users"></i> <b>Groupes</b>
                </div>
                <div class="card-body">
                    <h2 class="card-title"style="color: #00A6EB;">120</h2>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection