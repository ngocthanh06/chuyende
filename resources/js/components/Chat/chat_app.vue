<template>
<div class="chat-app">
  <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessages"></Conversation>
  <ContactList :contacts="contacts" @selected="startConversationWith"></ContactList>
</div>
</template>

<script>
import Conversation from './Conversation';
import ContactList from './ContactList';
export default {
  props: {
    // user: {
    //     type: Object,
    //     required: true
    // }
  },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: []
    }
  },
  mounted() {
    var channel = Echo.channel('message');
channel.listen('MessagesNew', function(data) {
  alert(JSON.stringify(data));
});
    axios.get('/api/contacts').then((response) => {
      this.contacts = response.data;
    })
  },
  methods: {
    startConversationWith(contact) {
      axios.get(`/api/conversation/${contact.User_id}`).then((res) => {
        this.messages = res.data;
        this.selectedContact = contact
      })
    },
    saveNewMessages(text) {
      this.messages.push(text)
    },
    hanleIncoming(message){
      console.log(message);
        if(this.selectedContact && message.from == this.selectedContact.id){
            this.saveNewMessages(message)
        }
        alert(message.text);
    }

  },
  components: {
    ContactList,
    Conversation,
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
}
</script>

<style lang="scss">
.chat-app {
  display: flex;
  margin: -20px;
}
</style>
