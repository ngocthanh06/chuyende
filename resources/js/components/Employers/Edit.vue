<template>
<div>
  <div class="pb-3">
    <h1>Chỉnh sửa nhân viên</h1>
    <router-link class="btn btn-danger" to="/employers">Trở lại</router-link>
  </div>
  <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
    <el-form-item label="Họ Và Tên" prop="User_fullname">
      <el-input v-model="ruleForm.User_fullname"></el-input>
    </el-form-item>
    <el-form-item label="Tên Tài Khoản" prop="username" required>
      <el-input :class="{ 'is-invalid': ruleForm.errors.has('username') }" disabled v-model="ruleForm.username"></el-input>
      <has-error :form="ruleForm" field="username"></has-error>
    </el-form-item>
    <el-form-item required label="Mật Khẩu" prop="password">
      <el-input type="password" v-model="ruleForm.password" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item label="Chức vụ" v-if="this.currentUser.Role_id == 2" prop="Role_id" required>
      <el-col :span="5">
        <el-form-item>
          <el-select v-model="ruleForm.Role_id" placeholder="Chọn chức vụ cho nhân viên">
            <el-option v-for="(item, key) in getRole" :key="key" :label="item.Role_name" :value="item.Role_id"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Ngày Sinh" required prop="Birthday">
          <el-date-picker :picker-options="pickerOptions" type="date" placeholder="Ngày Sinh" format="yyyy-MM-dd" value-format='yyyy-MM-dd' v-model="ruleForm.Birthday" style="width: 100%;"></el-date-picker>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item v-if="this.currentUser.Role_id == 2" label="Ngày làm việc" required prop="Date_start">
          <el-date-picker :picker-options="pickerOptions" type="date" placeholder="Ngày bắt đầu làm việc" format="yyyy-MM-dd" value-format='yyyy-MM-dd' v-model="ruleForm.Date_start" style="width: 100%;"></el-date-picker>
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
        <el-form-item v-if="this.currentUser.Role_id == 2" label="Chi nhánh( Nếu có)" prop="idComp" required="">
          <el-select v-model="ruleForm.idComp" placeholder="Chọn chi nhánh làm việc cho nhân viên">
            <el-option label="Chọn chi nhánh" :disabled="true" value=""></el-option>
            <el-option v-for="item in getCompanies" :key="item.idComp" :label="item.nameComp" :value="item.idComp"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
    </el-form-item>
    <el-form-item label="Địa Chỉ" prop="User_add">
      <el-input v-model="ruleForm.User_add"></el-input>
    </el-form-item>
    <el-form-item label="Di Động" prop="User_phone">
      <el-input v-model="ruleForm.User_phone"></el-input>
    </el-form-item>
    <el-form-item label="TK Ngân Hàng" prop="User_bank">
      <el-input v-model="ruleForm.User_bank"></el-input>
    </el-form-item>
    <el-form-item label="Chọn ảnh" prop="User_image">
      <input @change="changephoto" type="file" style="display: none" name="User_image" id="pic_shop">
      <label for="pic_shop" class="btn btn-warning">Chọn ảnh</label>
      <div id="upload">
        <a><img v-bind:src="changeImage()" alt=""></a>
      </div>
    </el-form-item>
    <el-form-item>
      <el-button type="success" @click="submitForm('ruleForm',ruleForm)">Lưu</el-button>
      <el-button @click="resetForm('ruleForm')">Reset</el-button>
    </el-form-item>
  </el-form>
</div>
</template>

<script>
export default {

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
        Role_id: '',
        User_fullname: '',
        username: '',
        Birthday: '',
        sex: '',
        password: '',
        User_image: '',
        User_add: '',
        User_phone: '',
        idComp: '',
        Date_start: '',
        User_bank: '',
      }),
      rules: {
        User_fullname: [{
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
        Role_id: [{
          required: true,
          message: 'Bạn chưa chọn chức vụ',
          trigger: 'change'
        }],
        username: [{
            required: true,
            disabled: true,
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
        password: [{
            required: true,
            message: 'Mật khẩu không được để trống',
            trigger: 'blur'
          },
          {
            validator: validatePass,
            trigger: 'blur'
          }
        ],
        User_add: [{
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
        User_phone: [{
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
        Birthday: [{
          type: 'string',
          required: true,
          message: 'Bạn chưa chọn ngày sinh',
          trigger: 'blur'
        }],
        Date_start: [{
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
      if(!this.$route.params.id) var user_id = this.currentUser.User_id;
      else var user_id = this.$route.params.id;
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
            this.ruleForm.post(`/api/editEmployer/${user_id}`).then((res) => {
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
        this.ruleForm.User_image = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    //Lấy thông tin người dùng 
    async getUser() {
      if(!this.$route.params.id) var user_id = this.currentUser.User_id;
      else var user_id = this.$route.params.id;
      let json = await axios.get(`/api/getEmployer/${user_id}`);
      json.data.sex == 1 ? json.data.sex = 'Nam' : json.data.sex = 'Nữ';
      this.ruleForm.fill(json.data);
    },
    //Hiển thị ảnh
    changeImage() {
      let img = this.ruleForm.User_image;
      if (img === "") {
        return this.ruleForm.User_image = 'noneUser.png';
      }
      if (img === null) {
        return this.ruleForm.User_image = 'noneUser.png';
      }
      if (img.length > 100) {
        return this.ruleForm.User_image;
      } else {
        return `/upload/${this.ruleForm.User_image}`;
      }
    }
  },
  mounted() {
    this.$store.dispatch("allRole");
    this.$store.dispatch("allCompany");
    this.getUser();
  },
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany
    },
    getRole() {
      return this.$store.getters.getRole;
    },
    currentUser(){
      return this.$store.getters.currentUser;
    }

  },
}
</script>

<style lang="scss">
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
