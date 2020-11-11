<template>


    <div style="  width:99%; margin:0 auto;
            background-color:#ddd;
            padding:10px;
            margin-bottom:10px">
        <div class="row"   style="margin-bottom: 1%">
            <img style="border-style: solid;border-color: #00A6EB; margin-left:2%" :src="'/storage/images/'+authe" width="40px" height="40px" class="rounded-circle"/>
            <textarea  v-model="contenuC" class="form-control" style=" height: 40px;width: 70%;margin-left:4%;margin-right:2%"></textarea>
            <button class="btn btn-light" @click="ajouterCommentaire" > submit</button>

        </div>
        <a class="btn" v-if="pagination.current_page>1" @click="fetchPaginateCommentaire(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"  style="color: black; margin-left: 33%; text-decoration:underline;"><i style="margin-right: 3%" class="fas fa-align-justify"></i>Commentaires Suivants</a>


        <ul v-for="comm in commentaires">

            <li class="row">

                <img style="border-style: solid;border-color: #00A6EB; " :src="'/storage/images/'+comm .utilisateur.photo" width="40px" height="40px" class="rounded-circle"/>

                <div class="col-md-10" >
                    <div class="card" >
                        <div class="card-header bg-transparent" >
                            <div class="row">
                                <h6 style="margin-left:3%;color: #00A6EB"><b>{{comm.utilisateur.nom}}</b> &nbsp;<b>{{comm.utilisateur.prenom}}</b></h6> &nbsp; &nbsp; <small><b>{{ comm.created_at | myOwnTime }}</b></small>

                            </div>
                            {{comm.contenu}}
                        </div>
                    </div>
                </div>
            </li>
        </ul>




        <a class="btn" v-if="pagination.current_page<pagination.last_page" @click="fetchPaginateCommentaire(pagination.next_page_url)" :disabled="!pagination.next_page_url"  style="color: black; margin-left: 33%; text-decoration:underline;"><i style="margin-right: 3%" class="fas fa-align-justify"></i>Commentaires Précédants</a>

    </div>

</template>
<script>
    import moment from 'moment'
    moment.locale('fr')
    export default{
        mounted(){
            this.getCommentaire()
        },
        data(){
            return{

                contenuC:'',
                commentaires:[],
                authe:this.auth,
                commentVoir:this.commentb,
                url:'http://util.web/indexCommentairePGA/'+this.id+'/',

                pagination:[],


            }


        },
        props:['id','auth','commentb'],


        methods: {
            getCommentaire(){
                let $this = this
                axios.get(this.url

                ).then(response => {

                    this.commentaires=response.data.data
                    this.makePagination(response.data)
                    Vue.filter('myOwnTime',function (value) {
                        return moment(value).fromNow();})

                }).catch(function (error) {
                    console.log(error);
                });

            },

            ajouterCommentaire()  {
                let $this = this
                axios.post('http://util.web/ajouterCommentairePGA/'+this.id, {
                    contenuC:this.contenuC
                }).then(response => {
                    this.contenuC=''

                    this.commentaires=response.data.data
                    this. makePagination(response.data)
                })

                    .catch(function (error) {
                        console.log(error);
                    });
            },
            makePagination(data){
                let pagination={
                    current_page:data.current_page,
                    last_page:data.last_page,
                    next_page_url:data.next_page_url,
                    prev_page_url:data.prev_page_url
                }
                this.pagination=pagination
            },
            fetchPaginateCommentaire(url){
                this.url=url
                this.getCommentaire()
            }

        },






    }

</script>