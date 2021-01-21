<script>
import { mapGetters } from 'vuex';

export default {

    data() {
        return {
            selected: 0,
        }
    },

    computed: {
        ...mapGetters([
            'getContacts'
        ]) 
    },

    created() {
        this.$store.dispatch('contactsList');
    },

    methods: {
        selectContact(index, contact) {
            this.selected = index;
            this.$emit('selected', contact);
        }
    },

    template: require('./ContactList.html')
}
</script>

<style lang="scss" scoped src="./ContactList.scss"></style>
