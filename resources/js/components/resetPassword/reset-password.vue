<template>
  <div class="container">
    <div class="alert alert-primary">
      <form action="" v-on:submit.prevent = 'sendToken'>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" v-bind:class="{'is-invalid':errorEmail, 'is-valid' : infoEmail}"
          placeholder="Email...."
          v-model="email"
          >
          <div class="invalid-feedback">{{errorEmail}}</div>
          <div class="valid-feedback">{{infoEmail}}</div>
        </div>
        <button class="btn btn-primary">Gửi token với địa chỉ Email</button>
      </form>
    </div>

    <div class="alert-secondary alert">
      <form action="" v-on:submit.prevent="validateToken">
        <div class="form-group">
          <label for="">Token</label>
          <input type="text" class="form-control" v-bind:class="{'is-invalid':errorToken, 'is-valid' : infoToken}" placeholder="Token..." v-model="token" />
          <div class="invalid-feedback">
            {{errorToken}}
          </div>
          <div class="valid-feedback">
            {{infoToken}}
          </div>
        </div>

        <button class="btn btn-secondary" type="submit">Hiệu lực token</button>
      </form>
    </div>

    <div class="alert-sucess alert" v-if="tokenValid">
      <form action="" v-on:submit.prevent="changePassword">
        <div class="form-group">
          <label for="">New Password</label>
          <input type="text" class="form-control" v-bind:class="{'is-invalid':errorNewPassword}" placeholder="New password..." v-model="newPassword" />
          <div class="invalid-feedback">
            {{errorNewPassword}}
          </div>
        </div>

        <div class="form-group">
          <label for="">Password Again</label>
          <input type="text" class="form-control" v-bind:class="{'is-invalid':errorPasswordAgain}" placeholder="Password again..." v-model="passwordAgain" />
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
  data(){
    return {
      email: '',
      infoEmail: null,
      errorEmail: null,
      token: '',
      infoToken: null,
      errorToken: null,
      newPassword: '',
      errorNewPassword: null,
      passwordAgain: '',
      errorPasswordAgain: null,
      tokenValid: false,
      user: null
    };
  },
  methods:{
    sendToken(){
        this.errorEmail = null;
        if(!this.email){
          this.errorEmail = 'Email không được để trống';
        }
        if(!this.errorEmail){
          const data = {
            email : this.email
          }

          axios.post('/sendToken', data).then(()=>{
            this.infoEmail = 'Đã gửi email';
          }).catch(error => {
            this.errorEmail = error.response.data.error;
          })
        }
    },
    validateToken(){
        this.errorToken = null;
        if(!this.token){
          this.errorToken = 'Token is required';
        }
        if(!this.errorToken){
          const data = {
            token: this.token
          }
          
          axios.post('validateToken', data).then(response=> {
              if(response.data.User_id){
                this.tokenValid = true;
                this.infoToken = 'Token có hiệu lực';
                this.user = response.data;
              }
          }).catch(error => {
            this.errorEmail = error.response.data.error;
          })
        }
    },
    changePassword(){
        this.errorNewPassword = null;
        this.errorPasswordAgain = null;
        if(!this.newPassword){
          this.errorNewPassword = 'New password is required';
        }
        if(!this.passwordAgain){
          this.errorPasswordAgain = 'Password confimation is required';
        }

        if(this.newPassword != this.passwordAgain){
          this.errorPasswordAgain = 'Password do not match';
        }
        if(!this.errorNewPassword && !this.errorPasswordAgain){
          const data = {
            password : this.newPassword,
            user_id : this.user.User_id
          }

          axios.post('resetPassword', data).then(()=>{
            this.$router.push('/login');
          })
        }
    }
  }
}
</script>