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
                'from': this.contact.user_id
            };

            this.$store.dispatch('saveNewMessage', this.data);
            this.message = '';
            console.log(this.$store.getters.getMessages)
        }
    },

    template: require('./MessageComponent.html')
}
</script>

<style lang="scss" scoped src="./MessageComponent.scss"></style>
