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


            }
        },
        props:['id','auth'],
        methods: {

            ajouterAime () {

                axios.get('http://util.web/ajouterAimePG/' + this.id
                ).then(response => {

                    this.aimes = response.data
                }).catch(function (error) {
                    console.log(error);
                });
            },


        },
        created(){

            axios.get('http://util.web/indexAimePG/'+
                this.id

            ).then(response => {

                this.aimes=response.data;


            }).catch(function (error) {
                console.log(error);
            });


        },

    }

</script>