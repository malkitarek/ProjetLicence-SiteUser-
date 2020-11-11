import Vue from 'vue'
import Vuex from 'vuex'
import Echo from 'laravel-echo'
Vue.use(Vuex)

const get=async function (url,options={}) {
   let response=await  fetch(url,{
        credentials:'same-origin',
        headers :{
            'X-Requested-With':'XMLHttpRequest',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json'
        },
       ...options
    }
    );
   if(response.ok){
      return response.json()
   }
   else {

       throw await response.json()
   }

}


export default new Vuex.Store({
    strict:true,
    state:{
        user:null,
      users:{},
        messages:{},
        openedConverssations:[]

    },
    getters:{
       user: function(state){
          return state.user
       },
      users:function (state) {
          return state.users
      },
        messages:function (state) {
            return function (id) {
                let conversation= state.users[id]
                if(conversation && conversation.messages){
                return conversation.messages}
                else {return []}
            }

        },
        conversation:function (state) {
            return function (id) {
                return state.users[id] ||{}
            }
        },
    },
    mutations:{
       setUser:function (state,userId) {
         state.user=userId

       },

        MarkAsRead:function (state,id) {
         state.users[id].unread=0
        },

     addMessages: function(state,{users}){

         users.forEach(function (user) {
             let conversation= state.users[user.id] ||{messages:[]}
             conversation={...conversation,...user}
             state.users={...state.users,...{[user.id]:conversation}}
         })

     },
        addMessagesConversation: function(state,{messages,id}){
            let conversation= state.users[id] ||{message:[]}

            conversation.messages=messages

            conversation.loaded=true
            state.users={...state.users,...{[id]:conversation}}
        },

        addMessage: function(state,{message,id}){
              state.users[id].messages.push(message)



    },
        openConversation: function(state,id){
    state.openedConverssations=[id]

        },

        incrementUnread: function(state,id){
            let conversation =state.users[id]
            if(conversation){
                conversation.unread++
            }
        }

    },

    actions:{

     loadMessages:async function (context){
        let response=await get('/api/conversation')
        context.commit('addMessages',{users:response.users})
     },
        loadMessagesConversation: async function (context,userId){
         context.commit('openConversation',userId)
         if(!context.getters.conversation(userId).loaded){
             let response=await get('/api/conversation/'+userId)
             context.commit('addMessagesConversation',{messages:response.messages,id:userId})
             context.commit('MarkAsRead',userId)

         }

        },
       /* envoyerMessage: async function(context,{content,userId}){
            let response= await get('/api/conversation/'+userId,{
                 method:'POST',
                 body:JSON.stringify({
                     content:content

                 })
             })
            context.commit('addMessagesConversation',{messages:response.messages,id:userId})


        },*/
        envoyerMessage: async function(context,{content,userId}){
            let response= await get('/api/conversation/'+userId,{
                method:'POST',
                body:JSON.stringify({
                    content:content

                })
            })
            context.commit('addMessage',{message:response.message,id:userId})


        },
     setUser1:function (context,userId) {
         context.commit('setUser1',userId)
         new Echo({
             broadcaster:'socket.io',
             host:window.location.hostname + ':6001'
             //}).private(`App.User.9`).listen('NewMessage',function (e) {
         }).private(`App.User.${userId}`).listen('NewMessage',function (e) {
             context.commit('addMessage',{message:e.message,id:e.message.from_id})

             if(!context.state.openedConverssations.includes(e.message.from_id)){

                 context.commit('incrementUnread',e.message.from_id)

             }
         })

     }


    }
})

