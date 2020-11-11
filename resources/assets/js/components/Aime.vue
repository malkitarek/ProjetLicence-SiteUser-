<template>


<div>

          <div class="col-md-4 pull-left">


              <a   @click="ajouterAime" class="btn" style="color: #00A6EB" >
              <div v-if="aimes == 0" >
                  <div ><i class="far fa-heart" ></i> &nbsp;J'aime</div>
              </div>
              <div v-else>
                  <div ><i class="fa fa-heart" ></i> &nbsp;J'aime</div>
              </div>

              </a>

          </div>






</div>







</template>
<script>
    export default{
       data(){
         return{

             aimes:0,
             posts:[],

         }
       },
        props:['id','auth'],
        methods: {
           /* multiple: function (event) {
                this.ajouterAime2()
                this.ajouterAime()

            },*/
            ajouterAime () {

                axios.get('http://util.web/ajouterAime/' + this.id
                ).then(response => {

                    this.aimes = response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },
            /*ajouterAime2: function (event) {

                axios.get('http://util.web/ajouterAime2/' + this.id
                ).then(response => {

                    this.posts = response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },*/


        },
        created(){

            axios.get('http://util.web/indexAime/'+
                    this.id

            ).then(response => {

                this.aimes=response.data;


            }).catch(function (error) {
                console.log(error);
            });
            /*axios.get('http://util.web/indexAime2/'+
                this.id

            ).then(response => {

                this.posts=response.data;


            }).catch(function (error) {
                console.log(error);
            });*/

        },

    }

</script>