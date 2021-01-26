<script>

export default {
    
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
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        },
    },

    watch: {
        contact(contact) {
            this.scrollToBottom();
        },
        messages(messages) {
            this.scrollToBottom();
        }
    },
    
    template: require('./MessagesFeed.html')
}
</script>

<style lang="scss" scoped src="./MessagesFeed.scss"></style>
