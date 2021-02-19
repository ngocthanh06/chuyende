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
            <el-form-item label="Tên chức vụ" prop="role_name" required>
              <el-input placeholder="Nhập tên chức vụ" :class="{ 'is-invalid': ruleForm.errors.has('role_name') }" v-model="ruleForm.role_name"></el-input>
              <has-error :form="ruleForm" field="role_name"></has-error>
            </el-form-item>
            <el-form-item label="Hệ số lương" prop="coefficient" required>
              <el-input-number v-model="ruleForm.coefficient" :step="0.1" controls-position="right" :min="1" :max="10"></el-input-number>
            </el-form-item>
            <el-form-item label="Giá mỗi ca" prop="price" required>
              <el-input v-model="ruleForm.price" type="number" controls-position="right" :min="1" :max="10"></el-input>
            </el-form-item>
            <el-form-item label="Ghi chú" prop="role_desc">
              <el-input placeholder="Nhập ghi chú" v-model="ruleForm.role_desc"></el-input>
            </el-form-item>
          </el-form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" @click="resetForm()" class="btn btn-secondary">Làm mới</button>
        <button type="submit" id="btn" @click="submitForm()" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  data() {
    return {

      ruleForm: new Form({
        role_name: '',
        role_desc: '',
        coefficient: '',
        price: '',
      }),

      rules: {
        role_name: [{
          required: true,
          message: 'Tên ca làm không được để trống',
          trigger: 'blur'
        }]
      }
    };
  },

  methods: {

    //Xử lý submit
    submitForm() {
      this.loading = true;
      this.$refs.ruleForm.validate((valid) => {
        if (valid) {
          this.ruleForm.post('/api/chucvu').then((res) => {
            this.$message({
              type: 'success',
              message: 'Thêm chức vụ thành công'
            });
            this.resetForm();

            this.$router.push('/listChucvu');
          })
        }
      });
    },

    resetForm() {
      this.$refs.ruleForm.resetFields();
    },
  }
}
</script>
