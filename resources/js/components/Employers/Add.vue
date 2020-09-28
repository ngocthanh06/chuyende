<template>
<div>
  <div class="pb-3">
    <h1>Thêm Nhân viên</h1>
    <router-link class="btn btn-danger" to="/employers">Trở lại</router-link>
  </div>
  <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
    <el-form-item label="Họ Và Tên" prop="user_fullname">
      <el-input v-model="ruleForm.user_fullname"></el-input>
    </el-form-item>
    <el-form-item label="Email" prop="email">
      <el-input v-model="ruleForm.email"></el-input>
    </el-form-item>
    <el-form-item label="Tên Tài Khoản" prop="username" required>
      <el-input :class="{ 'is-invalid': ruleForm.errors.has('username') }" v-model="ruleForm.username"></el-input>
      <has-error :form="ruleForm" field="username"></has-error>
    </el-form-item>
    <el-form-item required label="Mật Khẩu" prop="Password">
      <el-input type="password" v-model="ruleForm.Password" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item label="Chức vụ" prop="role_id" required>
      <el-col :span="5">
        <el-form-item>
          <el-select v-model="ruleForm.role_id" placeholder="Chọn chức vụ cho nhân viên">
            <el-option v-for="(item, key) in getRole" :key="key" :label="item.role_name" :value="item.role_id"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Ngày Sinh" required prop="birthday">
          <el-date-picker :picker-options="pickerOptions" type="date" placeholder="Ngày Sinh" format="yyyy-MM-dd" value-format='yyyy-MM-dd' v-model="ruleForm.birthday" style="width: 100%;"></el-date-picker>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Ngày làm việc" required prop="date_start">
          <el-date-picker :picker-options="pickerOptions" type="date" placeholder="Ngày bắt đầu làm việc" format="yyyy-MM-dd" value-format='yyyy-MM-dd' v-model="ruleForm.date_start" style="width: 100%;"></el-date-picker>
        </el-form-item>
      </el-col>
    </el-form-item>

    <el-form-item label="Giới Tính" prop="sex">
      <el-col :span="5">
        <el-form-item>
          <el-radio-group v-model="ruleForm.sex">
            <el-radio label="Nam"></el-radio>
            <el-radio label="Nữ"></el-radio>
          </el-radio-group>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Chi nhánh( Nếu có)" prop="idComp" required="">
          <el-select v-model="ruleForm.idComp" placeholder="Chọn chi nhánh làm việc cho nhân viên">
            <el-option label="Chọn chi nhánh" :disabled="true" value=""></el-option>
            <el-option v-for="(item, key) in getCompanies" :key="key" :label="item.nameComp" :value="item.idComp"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
       <el-col :span="8">
        <el-form-item label=" ">
          <el-checkbox v-model="ruleForm.checked">Hợp đồng</el-checkbox>
        </el-form-item>
      </el-col>
    </el-form-item>

    <el-form-item label="Địa Chỉ" prop="user_add">
      <el-input v-model="ruleForm.user_add"></el-input>
    </el-form-item>
    <el-form-item label="Di Động" prop="user_phone">
      <el-input v-model="ruleForm.user_phone"></el-input>
    </el-form-item>
    <el-form-item label="TK Ngân Hàng" prop="user_bank">
      <el-input v-model="ruleForm.user_bank"></el-input>
    </el-form-item>
    <!-- <el-form-item label="Chọn ảnh" prop="user_image">
      <input @change="changephoto" type="file" style="display: none" name="user_image" id="pic_shop">
      <label for="pic_shop" class="btn btn-warning">Chọn ảnh</label>
      <div id="upload">
        <a><img v-bind:src="ruleForm.user_image" alt=""></a>
      </div>
    </el-form-item> -->
    <el-form-item>
      <el-button type="success" @click="submitForm('ruleForm',ruleForm)">Tạo mới</el-button>
      <el-button @click="resetForm('ruleForm')">Reset</el-button>
    </el-form-item>
  </el-form>
</div>
</template>

<script>
export default {
  created() {
    this.$store.dispatch("allCompany");
    this.$store.dispatch("allRole");
  },
  data() {
    var validatePass = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('Bạn chưa nhập mật khẩu'));
      } else {
        if (this.ruleForm.checkPass !== '') {
          this.$refs.ruleForm.validateField('checkPass');
        }
        callback();
      }
    };
    return {
      checkImg: false,
      ruleForm: new Form({
        checked: false,
        role_id: '',
        user_fullname: '',
        username: '',
        birthday: '',
        sex: '',
        Password: '',
        email: '',
        // user_image: '',
        user_add: '',
        user_phone: '',
        date_start: '',
        user_bank: '',
      }),
      rules: {
        user_fullname: [{
            required: true,
            message: 'Họ tên không được để trống',
            trigger: 'blur'
          },
          {
            min: 3,
            max: 100,
            message: 'Ký tự phải từ 3 và không vượt quá 100',
            trigger: 'blur'
          }
        ],
        email: [{
          required: true,
          message: 'Email không được để trống',
          trigger: 'blur'
        }],
        role_id: [{
          required: true,
          message: 'Bạn chưa chọn chức vụ',
          trigger: 'change'
        }],
        username: [{
            required: true,
            message: 'Tên tài khoản không được để trống',
            trigger: 'blur'
          },
          {
            min: 3,
            max: 100,
            message: 'Ký tự phải từ 3 và không vượt quá 100',
            trigger: 'blur'
          }
        ],
        Password: [{
            required: true,
            message: 'Mật khẩu không được để trống',
            trigger: 'blur'
          },
          {
            validator: validatePass,
            trigger: 'blur'
          }
        ],
        user_add: [{
            required: true,
            message: 'Địa chỉ không được để trống',
            trigger: 'blur'
          },
          {
            min: 3,
            max: 100,
            message: 'Ký tự phải từ 3 và không vượt quá 100',
            trigger: 'blur'
          }
        ],
        user_phone: [{
            required: true,
            message: 'Số điện thoại không được để trống',
            trigger: 'blur'
          },
          {
            min: 3,
            max: 100,
            message: 'Ký tự phải từ 3 và không vượt quá 100',
            trigger: 'blur'
          }
        ],
        sex: [{
          required: true,
          message: 'Giới tính chưa được chọn',
          trigger: 'change'
        }],
        birthday: [{
          type: 'string',
          required: true,
          message: 'Bạn chưa chọn ngày sinh',
          trigger: 'blur'
        }],
        date_start: [{
          type: 'string',
          required: true,
          message: 'Bạn chưa chọn ngày bắt đầu làm việc cho nhân viên',
          trigger: 'blur'
        }],

      }
    };
  },
  methods: {
    //Xử lý submit
    submitForm(formName, value) {
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          try {
            this.ruleForm.post('/api/addEmployer').then((res) => {
              if (res.data.code == 200) {
                this.$router.push('/employers');
                this.$message({
                  type: 'success',
                  message: 'Thêm nhân viên thành công'
                });
              } else {
                this.$message({
                  type: 'warning',
                  message: 'Lỗi'
                });
              }
            })
          } catch (e) {
            console.log(e);
          }
        } else {
          console.log('error submit!!');
          return false;
        }
      });

    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    //Xử lý lỗi đăng quá số lượng ảnh
    handleExceed(files, fileList) {
      this.$message.warning(`Bạn chỉ được phép đăng 1 ảnh`);
    },
    //Xử lý giới hạn số lượng ảnh
    beforeRemove(file, fileList) {
      this.checkImg = false
    },
    //Format thời gian
    pickerOptions(time) {
      return time.getTime()
    },
    //Upload ảnh
    changephoto(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.ruleForm.user_image = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  },
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany;
    },
    getRole() {
      return this.$store.getters.getRole;
    }

  },
}
</script>

<style lang="scss">
.el-select {
  width: 100%
}

#upload {
  background: #ffffff;
  border-radius: 10px;

  a {
    width: 100px;
    display: inline-block;

    img {
      width: 100%;
    }
  }
}
</style>
