<script>
import { mapGetters } from 'vuex';
import fire from "../../fire";

export default {
  
  name: 'ChatApp',
  template: require('./ChatApp.html'),
  
  data() {
    return {
      users: [],
      message: '',
      messages: [],
      to: '',
    }
  },

  computed: {
    ...mapGetters({
      user: 'currentUser',
    }),
  },

  created() {
    this.getUsers();
  },

  mounted() {
    this.chooseUser(this.to);
  },

  methods: {
    getUsers() {
      axios.get('api/listUser').then(response => {
        this.users = response.data;
      })
    },

    sendMessage() {
      axios.post('api/send-message', { 
        message: this.message, 
        to: this.to,
        from: this.user.user_id,
      });
      this.message = '';
    },

    chooseUser(userId) {
      let idUserTo = this.user.user_id;
      this.to = userId;
      const message = fire.database().ref('message');
      let mess = [];
      message.on("child_added", function(snapshot) {
        if (snapshot.val().from === userId && snapshot.val().to === idUserTo || snapshot.val().from === idUserTo && snapshot.val().to === userId ) {
          mess.push(snapshot.val());
        }
      });

      this.messages = mess;
    }
  },

}
</script>

<style lang="scss" scoped src='./ChatApp.scss'></style>
