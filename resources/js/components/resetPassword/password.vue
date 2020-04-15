<template>
<div class="container">
    <div class="alert-sucess alert col-sm-10" style="margin: 0 auto">
      <form action="" v-on:submit.prevent="changePassword">
        <div class="form-group">
          <label for="">Mật khẩu mới</label>
          <input type="password" class="form-control" v-bind:class="{'is-invalid':errorNewPassword}" placeholder="Nhập mật khẩu mới..." v-model="newPassword" />
          <div class="invalid-feedback">
            {{errorNewPassword}}
          </div>
        </div>

        <div class="form-group">
          <label for="">Nhập lại mật khẩu</label>
          <input type="password" class="form-control" v-bind:class="{'is-invalid':errorPasswordAgain}" placeholder="Nhập lại mật khẩu..." v-model="passwordAgain" />
          <div class="invalid-feedback">
            {{errorPasswordAgain}}
          </div>
        </div>

        <button class="btn btn-success" type="submit">Thay đổi mật khẩu</button>
      </form>
    </div>
    </div> 
</template>
<script>
export default {
  name: 'password-reset',
  props: ['app'],
  data() {
    return {
      loading: false,
      newPassword: '',
      errorNewPassword: null,
      passwordAgain: '',
      errorPasswordAgain: null,
      user: null
    };
  },
  created(){
    this.validateToken();
  },
  methods: {
    validateToken() {
        const data = {
          token: this.$route.params.id
        }
        axios.post('/validateToken', data).then(response => {
          if (response.data.User_id) {
            this.user = response.data;
          }
          else {
            this.user = null
            this.$router.push('/login');
          }
        }).catch(error => {})
    },
    changePassword() {
      this.errorNewPassword = null;
      this.errorPasswordAgain = null;
      if (!this.newPassword) {
        this.errorNewPassword = 'New password is required';
      }
      if (!this.passwordAgain) {
        this.errorPasswordAgain = 'Password confimation is required';
      }

      if (this.newPassword != this.passwordAgain) {
        this.errorPasswordAgain = 'Password do not match';
      }
      if (!this.errorNewPassword && !this.errorPasswordAgain) {
        const data = {
          password: this.newPassword,
          user_id: this.user.User_id
        }

        axios.post('/resetPassword', data).then(() => {
          this.$router.push('/login');
        })
      }
    }
  }
}
</script>