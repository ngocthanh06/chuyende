<script>
import { mapGetters } from 'vuex';

export default {
  name: 'ChatApp',
  template: require('./ChatApp.html'),
  
  data() {
    return {
      users: [],
    }
  },

  created() {
      this.getUsers();
  },

  methods: {
    getUsers() {
        axios.get('api/listUser').then(response => {
            this.users = response.data;
            console.log(response);
        })
    }
  },









}
</script>

<style lang="scss" scoped src='./ChatApp.scss'></style>
