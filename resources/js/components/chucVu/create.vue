<template>
<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Thêm chức vụ</h5>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
      <div class="container form">
        <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
          <el-form-item label="Tên chức vụ" prop="Role_name" required>
            <el-input placeholder="Nhập tên chức vụ" :class="{ 'is-invalid':  ruleForm.errors.has('Role_name') }" v-model.number="ruleForm.Role_name"></el-input>
            <has-error :form="ruleForm" field="Role_name"></has-error>
          </el-form-item> 
          <el-form-item label="Ghi chú" prop="desc">
            <el-input type="textarea" placeholder="Nhập ghi chú" v-model="ruleForm.Role_desc"></el-input>
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
  data() {
    return {
      ruleForm: new Form({
        Role_name: '',
        Role_desc: '',
      }),
      rules: {
        Role_name: [{
          required: true,
          message: 'Tên ca làm không được để trống',
          trigger: 'blur'
        }, ],

      }
    };
  },
  methods: {
    //Xử lý submit
    submitForm(formName, value) {
      this.loading = true;
      this.$refs[formName].validate((valid) => {
        if (valid) {
            this.ruleForm.post('/api/chucvu').then((res) => {
                this.$message({
                  type: 'success',
                  message: 'Thêm chức vụ thành công'
                });
                this.resetForm('ruleForm');
                this.$router.push('/listChucvu');
            }) 
        }
      });
    },
    resetForm(formName) {
      this.ruleForm.Role_name = '';
      this.ruleForm.Role_desc = '';
    },

  },
}
</script>

