<template>
<!-- Modal -->
<div class="modal fade" id="AddEmp_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên mới</h5>
        <button @click="resetForm('ruleForm')" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <span class="font-size-12">
              Thêm nhân viên ở đây đồng nghĩa với việc nhân viên đã dược thêm vào danh sách nhân viên trong công
              ty của bạn.
            </span>
          </div>
        </div>
        <div class="container form">
          <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
            <el-form-item label="Họ Và Tên" prop="User_fullname">
              <el-input placeholder="Nhập họ và tên nhân viên" v-model="ruleForm.User_fullname"></el-input>
            </el-form-item>
            <el-form-item label="Số điện thoại" prop="User_phone" required>
              <el-input v-on:change="ChangePassAndUser()" placeholder="Nhập số điện thoại" :class="{ 'is-invalid':  ruleForm.errors.has('User_phone') }" v-model.number="ruleForm.User_phone"></el-input>
              <has-error :form="ruleForm" field="User_phone"></has-error>
              <el-input style="display:none" :class="{ 'is-invalid':  ruleForm.errors.has('username') }"></el-input>
              <has-error :form="ruleForm" field="username"></has-error>
            </el-form-item>
            <el-form-item label="Email" prop="email">
              <el-input v-model="ruleForm.email" :class="{ 'is-invalid':  ruleForm.errors.has('email') }"></el-input>
              <has-error :form="ruleForm" field="email"></has-error>
            </el-form-item>
            <el-form-item label="Chức vụ" prop="Role_id" required>
              <el-select v-model="ruleForm.Role_id" placeholder="Chọn chức vụ cho nhân viên">
                <el-option v-for="(item, key) in getRole" :key="key" :label="item.Role_name" :value="item.Role_id"></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="Chi nhánh( Nếu có)" prop="idComp" required="">
              <el-select v-model="ruleForm.idComp" placeholder="Chọn chi nhánh làm việc cho nhân viên">
                <el-option label="Chọn chi nhánh" value=""></el-option>
                <el-option v-for="item in getCompanies" :key="item.idComp" :label="item.nameComp" :value="item.idComp"></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="Giới Tính" x prop="sex">
              <el-radio-group v-model="ruleForm.sex">
                <el-radio label="Nam"></el-radio>
                <el-radio label="Nữ"></el-radio>
              </el-radio-group>
            </el-form-item>
          </el-form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" @click="resetForm('ruleForm')" class="btn btn-secondary">Làm mới</button>
        <button type="submit" id="btn" @click="submitForm('ruleForm',ruleForm)" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  mounted() {
    this.$nextTick(function () {
      console.log(this.$refs.AddEmp_Modal)
    })
    this.$store.dispatch("allCompany");
    this.$store.dispatch("allRole");
  },
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany
    },
    getRole() {
      return this.$store.getters.getRole;
    }

  },
  data() {
    var checkUser_Phone = (rule, value, callback) => {
      setTimeout(() => {
        if (!Number.isInteger(value)) {
          callback(new Error('Ký tự phải là số'));
        } else {
          callback();
        }
      }, 100);
    };
    return {
      show: true,
      ruleForm: new Form({
        Role_id: '',
        User_fullname: '',
        User_phone: '',
        email: '',
        sex: '',
        idComp: '',
        Password: '',
        username: '',
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
        email: [{
          required: true,
          message: 'Email không được để trống',
          trigger: 'blur'
        }],
        Role_id: [{
          required: true,
          message: 'Bạn chưa chọn chức vụ',
          trigger: 'change'
        }],
        User_phone: [{
            required: true,
            message: 'Số điện thoại không được để trống',
            trigger: 'blur'
          },
          {
            validator: checkUser_Phone,
            trigger: 'blur'
          },
        ],
        sex: [{
          required: true,
          message: 'Giới tính chưa được chọn',
          trigger: 'change'
        }],
        idComp: [{
          required: true,
          message: 'Bạn chưa chọn chi nhánh',
          trigger: 'change'
        }]

      }
    };
  },
  methods: {
    hideModal() {
      $('#AddEmp_Modal').attr("aria-hidden", "true");
      $('#AddEmp_Modal').css("display", "none");
      $('#AddEmp_Modal').removeClass("show");
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    },
    //Xử lý submit
    submitForm(formName, value) {
      // $('#AddEmp_Modal').modal('hide');
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          try {
            this.ruleForm.post('/api/addEmployersSpead').then((res) => {
              if (res.data.code == 200) {
                this.$message({
                  type: 'success',
                  message: 'Thêm nhân viên thành công'
                });
                this.resetForm('ruleForm');
                this.hideModal();
              } else {
                console.log(res);
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
      return this.$refs[formName].resetFields();
    },
    ChangePassAndUser() {
      this.ruleForm.Password = this.ruleForm.User_phone;
      this.ruleForm.username = this.ruleForm.User_phone;
    },

  },
}
</script>

<style lang="scss">
#AddEmp_Modal {
  .form {
    padding: 15px 20px
  }

  .el-form-item__label {
    text-align: left
  }

  .font-size-12 {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    color: rgba(0, 0, 0, .65);
    font-size: 13px;
    font-variant: tabular-nums;
    line-height: 1.5;
    list-style: none;
    font-feature-settings: "tnum";
  }
}
</style>
