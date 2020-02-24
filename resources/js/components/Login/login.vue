<template>
    <section id="login">
        <div class="adminx-container d-flex justify-content-center align-items-center">
      <div class="page-login">
        <div class="text-center">
          <a class="navbar-brand mb-4 h1" href="login.html">
            <img src="resource/AdminX-master/demo/img/logo.png" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
            Đăng nhập
          </a>
        </div>

        <div class="card mb-0">
          <div class="card-body">
               
            <!-- <form method="POST" >
              <div class="form-group">
                <label for="User_username" class="form-label">Tên đăng nhập</label>
                <input type="text" name="User_username" class="form-control" id="User_username" placeholder="Nhập tên đăng nhập">
              </div>
              <div class="form-group">
                <label for="User_password" class="form-label">Mật khẩu</label>
                <input type="password" name="User_password" class="form-control" id="User_password" placeholder="Nhập mật khẩu">
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Ghi nhớ mật khẩu</label>
                </div>
              </div>
              <button type="submit" class="btn btn-sm btn-block btn-primary">Đăng nhập</button>
            </form> -->
          <!-- </div> -->
            <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
                <el-form-item label="Password" prop="pass">
                    <el-input type="password" v-model="ruleForm.pass" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
                </el-form-item>
            </el-form>
          </div>

          <div class="card-footer text-center">
            <a href="#"><small>Quên mật khẩu</small></a>
            <div class="card-seperator">
              <span>hoặc</span>
            </div>
            <a href="/register"><small>Đăng ký</small></a>
          </div>
        </div>
      </div>
    </div>
    </section>
</template>
<script>
  export default {
    data() {
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password'));
        } else {
          if (this.ruleForm.checkPass !== '') {
            this.$refs.ruleForm.validateField('checkPass');
          }
          callback();
        }
      };
      return {
        ruleForm: {
          pass: '',
          checkPass: '',
          age: ''
        },
        rules: {
          pass: [
            { validator: validatePass, trigger: 'blur' }
          ],
        }
      };
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('submit!');
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
    }
  }
</script>
<style lang="scss">
    
</style>