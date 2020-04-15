<template>
<div class="container">
  <div class="alert alert-primary col-sm-10" v-if="password_reset" style="margin: 0 auto" v-loading="loading">
    <form action="" v-on:submit.prevent='sendToken'>
      <div class="form-group">
        <h2>Lấy lại mật khẩu</h2>
        <label for="">Nhập địa chỉ Email của bạn</label>
        <input type="email" class="form-control" placeholder="Nhập địa chỉ email...." required v-model="email">
        <label for="">Nhập địa chỉ email của bạn đã sử dụng để đăng ký mật khẩu.</label>
      </div>
      <router-link class="btn btn-danger" to='/login'>Quay lại đăng nhập</router-link>
      <button class="btn btn-primary">Gửi Email</button>
    </form>
  </div>

  <div class="alert-warning alert col-sm-10" style="margin: 0 auto" v-if="password_validate">
      <div class="form-group" style="text-align:center; margin-top: 20px; color: #428C48">
        <h2><i class="el-icon-circle-check"></i> Yêu cầu lấy lại mật khẩu thành công !</h2>
        <p>Vui lòng kiểm tra hộp thư địa chỉ email của bạn.</p>
        <router-link class="btn btn-danger" to='/login'>Quay lại đăng nhập</router-link>
      </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'password-reset',
  props: ['app'],
  data() {
    return {
      password_validate: false,
      password_reset: true,
      email: '',
      loading: false,
    };
  },
  methods: {
    sendToken() {
      this.loading = true;
      const data = {
        email: this.email
      }
      axios.post('/sendToken', data).then((res) => {
        if (!res.data.error) {
          this.$notify({
            title: 'Success',
            message: 'Email đã được gửi, vui lòng kiểm tra nội dung email',
            type: 'success'
          });
          this.password_validate = true;
          this.password_reset = false;
        } else {
          this.$notify.error({
            title: 'Error',
            message: res.data.error,
          });
        }
          this.loading = false;
      })
    },
  }
}
</script>
