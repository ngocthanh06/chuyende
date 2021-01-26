<script>
import { mapGetters } from 'vuex';
import fire from '../../../config/fire';

export default {

    data() {
        return {
            selected: 0,
            userIdFrom: 0
        }
    },

    computed: {
        ...mapGetters([
            'getContacts',
            'currentUser'
        ]) 
    },

    props: {
        noticeMessages: {
            type: Object,
            default: {}
        },

        changeNoticeMessage: {
            type: Boolean,
            default: true
        }
    },

    mounted() {
        this.$store.dispatch('contactsList');
    },

    methods: {
        selectContact(index, contact) {
            this.selected = index;
            this.$emit('selected', contact);

            this.destroyNotice();
        },

        destroyNotice() {
            this.$store.dispatch('destroyNoticeMessages', this.currentUser.user_id);
            this.userIdFrom = 0;
        }
    },

    watch: {
        noticeMessages(noticeMessages) {
            this.userIdFrom = noticeMessages.from;
        }
    },

    template: require('./ContactList.html')
}
</script>

<style lang="scss" scoped src="./ContactList.scss"></style>
