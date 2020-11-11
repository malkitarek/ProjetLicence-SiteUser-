@section('css')
    <style>

        #commentBox{

            padding:10px;
            width:99%; margin:0 auto;
            background-color:#ddd;
            padding:10px;
            margin-bottom:10px
        }
        #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
        .commet_form{  }
        .commentHand{color:blue}
        .commentHand:hover{cursor:pointer}
        .upload_wrap{
            position:relative;
            display:inline-block;
            width:100%
        }
    </style>

@endsection


<div class="col-md-8" style="margin-left: 20%;margin-top: 1%" v-for="post in posts"
     xmlns:v-on="http://www.w3.org/1999/xhtml">



    <div class="card">

        <div class="card-header bg-transparent">

                <div class="row">
                    <div class="col-md-1 pull-left">
                        <img style="border-style: solid;border-color: #00A6EB;" :src="'{{Config::get('app.url')}}/storage/images/' + post.utilisateur.photo" width="50px" height="50px" class="rounded-circle"/>
                    </div>
                    <div class="col-md-10 pull-left">

                        <h6 style="margin:0px; font-weight: bold">@{{ post.utilisateur.nom}} &nbsp; @{{ post.utilisateur.prenom}}  </h6>


                        <small><i class="fas fa-briefcase"></i>&nbsp; @{{ post.utilisateur.utilisateurable_type }}</small>
                        <br>
                        <small>@{{ post.created_at | myOwnTime }}</small>
                    </div>
                    <div class="col-md-1 pull-left">

                        <a href="#" data-toggle="dropdown" aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> </a>
                        <div class="dropdown-menu" v-if="post.user_id == {{\Illuminate\Support\Facades\Auth::user()->utilisateur->id}}">


                            <a  class="btn dropdown-item" data-toggle="modal" :data-target="'#myModal2'+ post.id"  ><i class="fa fa-trash"></i> &nbsp;Supprimer</a>

                            <a  class="btn dropdown-item"  data-toggle="modal" :data-target="'#exampleModal'+ post.id"><i class="fa fa-edit"></i>Modifier</a>
                            <a class="btn dropdown-item"  @click="bloqueCommentaire(post.id)"><i class="fa fa-lock"></i> Bloquer les commentaires</a>
                        </div>
                        <!------------------------Modal supprimer------------------------------------------------->
                        <div class="modal fade" :id="'myModal2'+ post.id" >
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
                                        voulez-vous vraimment supprimer
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button class="btn btn-danger"  @click="supprimerPost(post.id)" data-dismiss="modal"> Confirmer</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <!----------------Modal Modifier----------------------------------------->
                            <div class="modal fade" :id="'exampleModal'+ post.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifier le contenu de publication</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">

                                                <label for="designation" class="col-sm-3 col-form-label">Contenu:</label>
                                                <div class="col-sm-9">


                                                        <textarea v-model="contenuM" class="form-control"  ></textarea>


                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button v-if="contenuM" class="btn btn-primary" @click="ModifierContenuPost(post.id)" > Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                    </div>

                </div>
            </div>



        <div class="card-body">
            @{{ post.contenu}}

            <br>
            <img v-if="post.image != NULL" :src="'{{Config::get('app.url')}}/images/' + post.image" style="width: 100%;height: 100%">

        </div>
        <div class="col-md-11" style="padding: 10px;margin-left: 25px;border-top: 1px solid #ddd">


            <div class="row">
                <Aime :id="post.id"
                      :auth="{{\Illuminate\Support\Facades\Auth::user()->utilisateur->id}}"
                      @clicked="onClickChild">


                </Aime>
                <!--<Aime :id="post.utilisateuraimes"
                      :auth="{\Illuminate\Support\Facades\Auth::user()->utilisateur->id}}"
                      >


                </Aime>-->
                <div class="col-md-4 pull-left">
                    <a  class="btn" style="color: #00A6EB" ><i class="far fa-comment" ></i> &nbsp;commentaire</a>
                </div>


        </div>

    </div>


    </div>
    <div id="commentBox" v-if="post.status==0">
        <commentaire :id="post.id"
         :authh="{{\Illuminate\Support\Facades\Auth::user()->utilisateur}}"
        :commentb="commentBolean"
              :id_user="post.user_id"
        >

        </commentaire>

    </div>

</div>