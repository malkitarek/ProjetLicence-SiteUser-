/*
fetch('/api/user',{
    credentials:'same-origin',
    headers :{
        'X-Requested-With':'XMLHttpRequest',
        'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});*/
console.log('salut')
require('./bootstrap');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.Vue = require('vue');
window.io=require('socket.io-client')
import moment from 'moment'



moment.locale('fr')
import VueRouter from 'vue-router'

Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('Aime', require('./components/Aime.vue'));
Vue.component('Aime_ga', require('./components/Aime_ga.vue'));
Vue.component('Aime_g', require('./components/Aime_g.vue'));
Vue.component('commentaire', require('./components/commentaire.vue'));
Vue.component('commentaire_ga', require('./components/commentaire_ga.vue'));
Vue.component('commentaire_g', require('./components/commentaire_g.vue'));
Vue.component('Messagerie', require('./components/Messagerie.vue'));
import message from './components/message.vue'

import store from './store/store'

Vue.use(VueRouter);

let $app=document.querySelector('#app')
if($app){
    const routes=[{path:'/'},
        {path:'/:id',component:message,name:'user'}
    ]
    const router=new VueRouter({
        mode:'history',
        routes,
        base:$app.getAttribute('data-base')
    })
    const app = new Vue({

        el: '#app',
        store,
        router,

        /* props:['id'],*/
        data :{
            msg:'tarek',
            contenu:'',
            contenuPGA:'',
            contenuPG:'',
            contenuM:'',
            image:'',
            imagePGA:'',
            imagePG:'',
            imageP:'',
            imageF:{},
            test:'',
            posts:[],
            formData: {},
            formDataa: {},
            postsPGA:[],
            postsPG:[],
            commentBolean:false,
            postid:'h',
            aimes:0,
            query:'',
            attachment:'',
            attachmentt:'',
            resutl:[
                {me:'lklm'},
            ],
            resutls:[],
            items: [

            ]

        },

        ready:function () {
            this.created()
        },
        created(){
            axios.get('http://util.web/indexPost'
            ).then(response => {

                this.posts=response.data;

                Vue.filter('myOwnTime',function (value) {
                    return moment(value).fromNow();
                });
            }).catch(function (error) {
                console.log(error);
            });

            axios.get('http://util.web/indexPostPGA'
            ).then(response => {

                this.postsPGA=response.data;

                Vue.filter('myOwnTime',function (value) {
                    return moment(value).fromNow();
                });
            }).catch(function (error) {
                console.log(error);
            });
            axios.get('http://util.web/indexPostPG'
            ).then(response => {

                this.postsPG=response.data;

                Vue.filter('myOwnTime',function (value) {
                    return moment(value).fromNow();
                });
            }).catch(function (error) {
                console.log(error);
            });
            /*axios.get('http://util.web/indexAime/'+{
             id:this.id
             }
             ).then(response => {

             this.aimes=response.data;


             }).catch(function (error) {
             console.log(error);
             });*/
        },

        methods:{
            submitForm(id) {
                this.formData = new FormData();
                //this.formData.append('name', this.fileName);
                this.formData.append('file', this.attachment);

                axios.post('/upload/'+id,this.formData,{headers: {'Content-Type': 'multipart/form-data'},contenuPGA:this.contenuPGA})
                    .then(response => {
                        window.location = response.data.redirect;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            submitFormm(id) {
                this.formDataa = new FormData();
                //this.formData.append('name', this.fileName);
                this.formDataa.append('filee', this.attachmentt);

                axios.post('/uploadd/'+id,this.formDataa,{headers: {'Content-Type': 'multipart/form-data'},contenuPG:this.contenuPG})
                    .then(response => {
                        window.location = response.data.redirect;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            addFile() {
                this.attachment = this.$refs.file.files[0];
            },
            addFilee() {
                this.attachmentt = this.$refs.filee.files[0];
            },
            ajouterPost() {
                axios.post('http://util.web/ajouterPost', {
                    contenu:this.contenu
                }).then(function (response) {
                    window.location = response.data.redirect;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            ajouterPostPGA(id) {
                axios.post('http://util.web/ajouterPostPGA/'+id, {
                    contenuPGA:this.contenuPGA
                }).then(function (response) {
                    window.location = response.data.redirect;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            ajouterPostPG(id) {
                axios.post('http://util.web/ajouterPostPG/'+id, {
                    contenuPG:this.contenuPG
                }).then(function (response) {
                    window.location = response.data.redirect;
                }).catch(function (error) {
                    console.log(error);
                });
            },


            supprimerPost(id) {
                axios.get('http://util.web/supprimerPost/'+id
                ).then(response => {

                    this.posts=response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },
            supprimerPostPGA(id) {
                axios.get('http://util.web/supprimerPostPGA/'+id
                ).then(response => {

                    this.postsPGA=response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },
            supprimerPostPG(id) {
                axios.get('http://util.web/supprimerPostPG/'+id
                ).then(response => {

                    this.postsPG=response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },
            /* ajouterAime(id) {
             axios.get('http://util.web/ajouterAime/'+id
             ).then(response => {

             this.posts=response.data
             }).catch(function (error) {
             console.log(error);
             });
             },*/

            changerFile(e){

                var files = e.target.files || e.dataTransfer.files;
                this.createImg(files[0]);


            },
            createImg(file){

                var image = new Image;
                var reader = new FileReader;

                reader.onload = (e) =>{
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            uploadImg(){
                axios.post('http://util.web/saveImg', {
                    image: this.image,
                    contenu:this.contenu


                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            supprimerImg(){
                this.image=""
            },
            changerFilePGA(e){

                var files = e.target.files || e.dataTransfer.files;
                this.createImgPGA(files[0]);


            },
            createImgPGA(file){

                var imagePGA = new Image;
                var reader = new FileReader;

                reader.onload = (e) =>{
                    this.imagePGA = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            uploadImgPGA(id){
                axios.post('http://util.web/saveImgPGA/'+id, {
                    imagePGA: this.imagePGA,
                    contenuPGA:this.contenuPGA


                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            supprimerImgPGA(){
                this.imagePGA=""
            },
            supprimerImgP(){
                this.imageP=""
            },
            supprimerFilePGA(){
                this.attachment=""
            },
            changerFilePG(e){

                var files = e.target.files || e.dataTransfer.files;
                this.createImgPG(files[0]);


            },
            createImgPG(file){

                var imagePG = new Image;
                var reader = new FileReader;

                reader.onload = (e) =>{
                    this.imagePG = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            uploadImgPG(id){
                axios.post('http://util.web/saveImgPG/'+id, {
                    imagePG: this.imagePG,
                    contenuPG:this.contenuPG


                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            supprimerImgPG(){
                this.imagePG=""
            },

            supprimerFilePG(){
                this.attachmentt=""
            },
            changeProfile(e){

            var files = e.target.files || e.dataTransfer.files;


            this.createImgP(files[0]);


        },
            createImgP(file){

                var imageP = new Image;
                var reader = new FileReader;

                reader.onload = (e) =>{
                    this.imageP = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImgP(){
              /*const files = this.$refs.image.files;
                const data = new FormData();
                data.append('logo', files[0]);
                console.log(data)*/
                axios.post('http://util.web/imageProfile', {
                    imageP: this.imageP
                    //formData




                })
                    .then(function (response) {
                        window.location = response.data.redirect;
                        //console.log(response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            recherche(){

                axios.post('http://util.web/recherche',{
                    query: this.query}

                ).then((response )=> {

                    this.items=response.data;

                })



            },
            ModifierContenuPost(id){
                axios.post('http://util.web/modfierContenu/'+id, {
                    contenuM: this.contenuM,



                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            ModifierContenuPostPGA(id){
                axios.post('http://util.web/modfierContenuPGA/'+id, {
                    contenuPGA: this.contenuPGA,



                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            ModifierContenuPostPG(id){
                axios.post('http://util.web/modfierContenuPG/'+id, {
                    contenuPG: this.contenuPG,



                })
                    .then(function (response) {
                        window.location = response.data.redirect;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            bloqueCommentaire(id){
                axios.get('http://util.web/bloquerCommentaire/'+id
                ).then(response => {

                    this.posts=response.data
                }).catch(function (error) {
                    console.log(error);
                });

    },




        }

    });

}




