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
          <el-form-item label="Địa chỉ" prop="add_comp" required>
            <el-input placeholder="Nhập địa chỉ" :class="{ 'is-invalid':  ruleForm.errors.has('add_comp') }" v-model.number="ruleForm.add_comp"></el-input>
            <has-error :form="ruleForm" field="add_comp"></has-error>
          </el-form-item>
          <el-form-item label="Fax" prop="fax_comp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('fax_comp') }" v-model.number="ruleForm.fax_comp"></el-input>
            <has-error :form="ruleForm" field="fax_comp"></has-error>
          </el-form-item>
          <el-form-item label="Số điện thoại" prop="phone_comp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('phone_comp') }" v-model.number="ruleForm.phone_comp"></el-input>
            <has-error :form="ruleForm" field="phone_comp"></has-error>
          </el-form-item>
          <el-form-item label="Email" prop="email_comp">
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('email_comp') }" v-model.number="ruleForm.email_comp"></el-input>
            <has-error :form="ruleForm" field="email_comp"></has-error>
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
        add_comp: '',
        fax_comp: '',
        phone_comp: '',
        email_comp: '',
      }),
      rules: {
        nameComp: [{
          required: true,
          message: 'Tên chi nhánh không được để trống',
          trigger: 'blur'
        }, ],
        add_comp: [{
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
      this.ruleForm.add_comp = '';
      this.ruleForm.fax_comp = '';
      this.ruleForm.phone_comp = '';
      this.ruleForm.email_comp = '';
    },

  },
}
</script>


