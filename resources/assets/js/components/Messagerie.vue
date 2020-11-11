<template>
    <div class="row">
    <div class="col-md-3">
        <div class="list-group" v-for="user in users">
            <router-link :to="{name:'user',params:{id:user.id}}" class="list-group-item d-flex justify-content-between align-items-center">
             {{user.nom}}
                <span class="badge badge-pill  badge-primary" v-if="user.unread">{{user.unread}}</span>
            </router-link>

        </div>

    </div>
    <div class="col-md-9">
        <router-view></router-view>
    </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Echo from 'laravel-echo'
    export default{

     props:{
         user:Number,
         user1:Number,
         user2:Number

     },
        computed:{
            ...mapGetters(['users'])
        },
      mounted(){

      /* new Echo({
              broadcaster:'socket.io',
              host:window.location.hostname + ':6001'
       //}).private(`App.User.9`).listen('NewMessage',function (e) {
          }).private(`App.User.${this.user1}`).listen('NewMessage',function (e) {
           console.log('tarek')
          })*/


         this.$store.dispatch('loadMessages')
          this.$store.commit('setUser',this.user)
          this.$store.dispatch('setUser1',this.user1)

      }
    }


</script>