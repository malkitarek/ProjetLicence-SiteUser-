<template>
    <div class="card">
        <div class="card-header">
       {{nom.nom}}
        </div>
        <div class="card-body messagerie__body" >

            <div v-for="message in messages">
            <div class="offset-md-2 text-right"  v-if="message.from_id === user">
                <strong >Moi &nbsp;&nbsp;<span class="text-muted">{{ go(message.created_at)}}</span></strong>
            <p>{{message.content}}</p>
            </div>
            <div v-else>
                <strong>{{message.from.nom}}&nbsp;&nbsp;<span class="text-muted">{{ go(message.created_at)}}</span></strong>
                <p>{{message.content}}</p>
            </div>
            </div>
            <form action="" method="post" class="messagerie__form">
                <div class="form-group">
                        <textarea name="content" v-model="content" placeholder="message envoyer" class="form-control" @keypress.enter="envoyerMessage"></textarea>



                </div>
               <div v-if="loading" class="messagerie__loading">
                   <div class="loader">

                   </div>
               </div>
            </form>


        </div>

    </div>


</template>
<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'
    moment.locale('fr')
    export default{

             data(){
               return{
                   content:'',
                   loading:false,
                   errors:{},
                   message:''

               }
             },


            computed:{


               nom:function () {
                   return this.$store.getters.conversation(this.$route.params.id)
               },

                ...mapGetters(['user']),
               messages:function () {
                   return this.$store.getters.messages(this.$route.params.id)

               },
                lastMessages:function () {
                   return this.messages[this.messages.length -1]

                }
            },
     mounted(){

   this.loadMessagesConversation()

   //this.$message.addEventListener('scroll',this.onScroll)

    },
        /*destroy(){
            this.$message.removeEventListener('scroll',this.onScroll)
        },*/
        watch:{
         '$route.params.id':function () {
           this.loadMessagesConversation()
         },
            lastMessages: function () {
             this.scrollBot()
         }
        },
        methods:{

            go(value){
                return moment(value).fromNow()
            },
         scrollBot(){
             let $message =this.$el.querySelector('.messagerie__body')
                this.$nextTick(()=>{
                 $message.scrollTop=$message.scrollHeight
                })
            },

           async loadMessagesConversation(){
              let response= await this.$store.dispatch('loadMessagesConversation',this.$route.params.id)
             //  this.scrollBot()
            },
            async envoyerMessage(e){
            try {
                if(e.shiftKey === false){
                    this.loading=true
                    await this.$store.dispatch('envoyerMessage',{
                        content: this.content,
                        userId:this.$route.params.id,


                    })
                    this.content=''
                    //this.scrollBot()


                }
            }catch(e){
                this.errors=e.errors
            }

                    this.loading=false


            },
        }

    }

</script>