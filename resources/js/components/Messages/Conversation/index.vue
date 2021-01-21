<script>
import MessagesFeed from './MessagesFeed';
import MessageComposer from './MessageComponent';

export default {
    components: {
        MessagesFeed,
        MessageComposer
    },

    template: require('./Conversation.html')
}
</script>

<style lang="scss" scoped src="./Conversation.scss"></style>
