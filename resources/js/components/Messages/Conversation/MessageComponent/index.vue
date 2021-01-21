<script>
export default {

    data() {
        return {
            message: '',
        }
    },

    methods: {
        send() {
            console.log(this.message);
        }
    },

    template: require('./MessageComponent.html')
}
</script>

<style lang="scss" scoped src="./MessageComponent.scss"></style>
