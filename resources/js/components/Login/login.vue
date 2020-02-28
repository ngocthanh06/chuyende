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
              <el-form-item label="Tên đăng nhập" prop="Username">
                <el-input v-model="ruleForm.Username"></el-input>
              </el-form-item>
              <el-form-item label="Mật khẩu" prop="Password">
                <el-input type="password" v-model="ruleForm.Password" autocomplete="off"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click="submitForm('ruleForm')">Đăng nhập</el-button>
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
          Password: '',
          Username: '',
        },
        rules: {
          Password: [
            { validator: validatePass, trigger: 'blur' },
            {required: true, message: 'Mật Khẩu không được để trống', trigger: 'blur'},
            { min: 4, message: 'Phải từ 4 ký tự trở lên', trigger: 'blur' }
          ], 
          Username: [
            { required: true, message: 'Tên đăng nhập không được để trống', trigger: 'blur' },
            { min: 4, message: 'Phải từ 4 ký tự trở lên', trigger: 'blur' }
          ],
        }
      };
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
              try{ 
                    axios.post('/api/login', this.ruleForm).then((res)=>{ 
                      console.log(res.data)
                      // if(res.data.code == 200)
                      // {
                      //   // this.$router.push('/employers');
                      //   this.$message({
                      //   type: 'success',
                      //   message: 'Thêm nhân viên thành công'
                      //   }); 
                      // }
                      // else{
                      //     this.$message({
                      //     type: 'warning',
                      //     message: 'Lỗi'
                      //     }); 
                      // }
                    })             
                }catch(e){
                  console.log(e)
                } 
          } else {
            console.log('error submit!!');
            return false;
            }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
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