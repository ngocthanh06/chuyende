<template>
<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Thêm chi nhánh</h5>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
      <div class="container form">
        <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
          <el-form-item label="Tên chi nhánh" prop="nameComp" required>
            <el-input placeholder="Nhập tên chi nhánh" :class="{ 'is-invalid':  ruleForm.errors.has('nameComp') }" v-model.number="ruleForm.nameComp"></el-input>
            <has-error :form="ruleForm" field="nameComp"></has-error>
          </el-form-item>
          <el-form-item label="Địa chỉ" prop="AddComp" required>
            <el-input placeholder="Nhập địa chỉ" :class="{ 'is-invalid':  ruleForm.errors.has('AddComp') }" v-model.number="ruleForm.AddComp"></el-input>
            <has-error :form="ruleForm" field="AddComp"></has-error>
          </el-form-item>
          <el-form-item label="Fax" prop="faxComp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('faxComp') }" v-model.number="ruleForm.faxComp"></el-input>
            <has-error :form="ruleForm" field="faxComp"></has-error>
          </el-form-item>
          <el-form-item label="Số điện thoại" prop="phoneComp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('phoneComp') }" v-model.number="ruleForm.phoneComp"></el-input>
            <has-error :form="ruleForm" field="phoneComp"></has-error>
          </el-form-item>
          <el-form-item label="Email" prop="emailComp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('emailComp') }" v-model.number="ruleForm.emailComp"></el-input>
            <has-error :form="ruleForm" field="emailComp"></has-error>
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
</template>

<script>
export default {
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany
    },

  },
  data() {
    return {

      ruleForm: new Form({
        nameComp: '',
        AddComp: '',
        faxComp: '',
        phoneComp: '',
        emailComp: '',
      }),
      rules: {
        nameComp: [{
          required: true,
          message: 'Tên chi nhánh không được để trống',
          trigger: 'blur'
        }, ],
        AddComp: [{
          required: true,
          message: 'Địa chỉ không được để trống',
          trigger: 'blur'
        }, ],

      }
    };
  },
  methods: {
    //Xử lý submit
    submitForm(formName, value) {
      // $('#AddEmp_Modal').modal('hide');
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          try {
            this.ruleForm.post('/api/company').then((res) => {
              if (res.data.code == 200) {
                this.$message({
                  type: 'success',
                  message: 'Thêm ca làm thành công'
                });
                this.resetForm('ruleForm');
                this.$router.push('/getChinhanh');
              }
            })
          } catch (e) {
            this.$message({
              type: 'warning',
              message: 'Lỗi'
            });
          }
        } else {
          console.log('error submit!!');
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
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
