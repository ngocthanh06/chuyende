<template>
    <div class="Conversation">
        <h1>{{contact ? contact.User_fullname : 'Select a Contact'}}</h1>
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>
</template>

<script>
import MessageComposer from './MessageComposer';
import MessagesFeed from './MessagesFeed';
    export default {
       props: {
           contact : {
               type : Object,
               default: null
           },
           messages: {
               type: Array,
               default: []
           }
       },
       methods: {
           sendMessage(text){
               if(!this.contact){
                   return ;
               }
               axios.post('/api/conversation/send', {
                   contact_id: this.contact.User_id,
                   text: text
               }).then( res => {
                   this.$emit('new', res.data);
               })
           }
       },
       components: {
           MessagesFeed, MessageComposer
       }
    }
</script>
<style lang="scss">
    .Conversation{
        flex: 5;    
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1{
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }

</style>