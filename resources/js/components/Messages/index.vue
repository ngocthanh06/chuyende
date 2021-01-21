<script>
import ContactList from './ContactList';
import Conversation from './Conversation';
import { mapGetters } from 'vuex';

export default {
    
    components: {
        ContactList,
        Conversation
    },

    data() {
        return {
            selectedContact: null,
            // contacts: []
        }
    },

    computed: {
        ...mapGetters([
            'getMessages'
        ])
    },

    methods: {
        startConversationWith(contact) {
            this.$store.dispatch('handleMessages', contact.user_id);
            this.selectedContact = contact;
        },

        saveNewMessage(message) {
            console.log('aa', message);
            // this.$store.dispatch('saveNewMessage', message);
        }
    },

    template: require('./Messages.html')
}
</script>

<style lang="scss" scoped src="./Messages.scss"></style>
