<script>
import MessagesFeed from './MessagesFeed';
import MessageComposer from './MessageComponent';

export default {
    components: {
        MessagesFeed,
        MessageComposer
    },

    props: {
        messages: {
            type: Array,
            default: [],
        }, 

        contact: {
            type: Object,
            default: {}
        }
    },

    methods: {
        haveChangeNoticeMessage() {
            this.$emit('haveChangeNoticeMessage');
        },
    },

    template: require('./Conversation.html')
}
</script>

<style lang="scss" scoped src="./Conversation.scss"></style>
