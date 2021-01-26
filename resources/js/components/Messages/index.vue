<script>
import ContactList from './ContactList';
import Conversation from './Conversation';
import { mapGetters } from 'vuex';
import fire from '../../config/fire';

export default {
    
    components: {
        ContactList,
        Conversation
    },

    data() {
        return {
            selectedContact: null,
            noticeMessages: {},
            changeNoticeMessage: true
        }
    },

    computed: {
        ...mapGetters([
            'getMessages',
            'currentUser'
        ])
    },

    created() {
        this.receivedMessages();
    },

    mounted() {
        this.$store.dispatch('destroyNoticeMessages', this.currentUser.user_id);
    },

    methods: {
        startConversationWith(contact) {
            this.$store.dispatch('handleMessages', contact.user_id);
            this.selectedContact = contact;
        },

        haveChangeNoticeMessage() {
            this.changeNoticeMessage = false;
        },

        receivedMessages() {
            fire.database()
                .ref(`chat/to_user_${this.currentUser.user_id}/chat/content`)
                .orderByKey()
                .limitToLast(1)
                .on('value', (snapshot) => {
                    const data = snapshot.val();

                    if (data) {
                        const value = Object.values(data)[0]
                        this.noticeMessages = value; 

                        if (this.selectedContact && this.selectedContact.user_id == value.from) {
                            this.$store.dispatch('handleMessages', value.from)
                        }
                    }
                });
        },
    },

    template: require('./Messages.html')
}
</script>

<style lang="scss" scoped src="./Messages.scss"></style>
