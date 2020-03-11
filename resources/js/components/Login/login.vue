<template>
  <section id="login">
    <div class="adminx-container d-flex justify-content-center align-items-center">
      <div class="page-login">
        <div class="text-center">
          <a class="navbar-brand mb-4 h1" href="login.html">
            <img src="/resource/AdminX-master/demo/img/logo.png" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
            Đăng nhập
          </a>
        </div> 
        <div class="card mb-0">
          <div class="card-body"> 
            <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
              <el-form-item label="Tên đăng nhập" prop="username">
                <el-input v-model="ruleForm.username"></el-input>
              </el-form-item>
              <el-form-item label="Mật khẩu" prop="password">
                <el-input type="password" v-model="ruleForm.password" autocomplete="off"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click="authenticate()">Đăng nhập</el-button>
                <el-button @click="resetForm('ruleForm')">Hủy</el-button>
              </el-form-item>
            </el-form> 
          </div>
          <div class="card-footer text-center">
            <a href="#"><small>Quên mật khẩu?</small></a>
          </div>
        </div>
      </div>
    </div> 
  </section>
</template>
<script>
// import {login} from '../../helper/auth';
  export default {
    data() { 
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Mật khẩu không được để trống'));
        } else {
          if (this.ruleForm.checkPass !== '') {
            this.$refs.ruleForm.validateField('checkPass');
          }
          callback();
        }
      }; 
      return {
        ruleForm: {
          password: '',
          username: '',
        },
        rules: {
          password: [
            { validator: validatePass, trigger: 'blur' },
            {required: true, message: 'Mật Khẩu không được để trống', trigger: 'blur'},
            { min: 4, message: 'Phải từ 4 ký tự trở lên', trigger: 'blur' }
          ], 
          username: [
            { required: true, message: 'Tên đăng nhập không được để trống', trigger: 'blur' },
            { min: 4, message: 'Phải từ 4 ký tự trở lên', trigger: 'blur' }
          ],
        }
      };
    },
    methods: {
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      authenticate() {
        this.$store.dispatch('login');

        axios.post('/api/auth/login', this.ruleForm)
          .then((response)=>{ 
            
            if(response && response.data) {
              var res = response.data;

              this.$store.commit("loginSuccess", res); 
              if(this.$store.getters.currentUser.Role_id == 1){
                this.$router.push({name: 'adCalendar'});
              } else {
                this.$router.push({name: 'SetCalendar'});
              }
                
              this.$message({
                type: 'success',
                message: 'Đăng nhập thành công'
              });
            }
          })
          .catch((err) => {
            this.$message({
              type: 'warning',
              message: err.response.error
            });
              // return rej('Sai tên đăng nhập hoặc mật khẩu');
          })

        // login(this.ruleForm)
        //     .then((res) => {
        //         this.$store.commit("loginSuccess", res); 
        //         if(this.$store.getters.currentUser.Role_id == 1){
        //             this.$router.push({name: 'adCalendar'});
        //         }
        //         else {
        //             this.$router.push({name: 'SetCalendar'});
        //         }
                  
        //         this.$message({
        //         type: 'success',
        //         message: 'Đăng nhập thành công'
        //         }); 
        //     })
        //     .catch((error) => { 
        //           this.$message({
        //           type: 'warning',
        //           message: error
        //           }); 
        //     });
      }
    }
  }
</script>
<style lang="scss">
    #login {
      margin-top: -3.5rem;
      .el-form-item__label{width: 100% !important; text-align: left;};
      .el-form-item__content{margin: 0!important; text-align: right };
    };
    
</style>