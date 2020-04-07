<template>
<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Sửa chi nhánh</h5>
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
  mounted() {

  },
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
  mounted() {
    this.getCalam();
  },
  methods: {
    async getCalam() {
      let json = await axios.get(`/api/CalamID/${this.$route.params.id}`);
      this.ruleForm.fill(json.data);
    },
    //Xử lý submit
    submitForm(formName, value) {
      // $('#AddEmp_Modal').modal('hide');
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          try {
            axios.post(`/api/postEditCompany`, {id: this.$route.params.id, value: this.ruleForm }).then((res) => {
              if (res.data.code == 200) {
                this.$message({
                  type: 'success',
                  message: res.data.messages
                });
                this.resetForm('ruleForm');
                this.$router.push('/getChinhanh');
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
        }
      });
    },
    resetForm(formName) {
      // return this.$refs[ruleForm].resetFields(); 
      this.ruleForm.nameComp = '';
      this.ruleForm.AddComp = '';
      this.ruleForm.faxComp = '';
      this.ruleForm.phoneComp = '';
      this.ruleForm.emailComp = '';
    },

  },
}
</script>


