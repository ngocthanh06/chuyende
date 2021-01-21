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
    
    template: require('./MessagesFeed.html')
}
</script>

<style lang="scss" scoped src="./MessagesFeed.scss"></style>
