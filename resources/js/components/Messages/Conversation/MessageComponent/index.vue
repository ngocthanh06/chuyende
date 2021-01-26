<script>

export default {

    data() {
        return {
            message: '',
            data: {},
        }
    },

    props: {
        contact: {
            type: Object,
            default: {}
        }
    },

    methods: {
        send() {
            this.data = {
                'text': this.message,
                'to': this.contact.user_id
            };

            this.$store.dispatch('saveNewMessage', this.data);
            this.$store.dispatch('handleMessages', this.contact.user_id)
            this.message = '';
        }
    },

    watch: {
        message(message) {
            this.$emit('haveChangeNoticeMessage');
        }
    },

    template: require('./MessageComponent.html')
}
</script>

<style lang="scss" scoped src="./MessageComponent.scss"></style>
