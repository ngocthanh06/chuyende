<template>
<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Thêm ca làm</h5>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
      <div class="container form">
        <el-form role="ruleForm" :filter-multiple=true :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
          <el-form-item label="Tên ca làm" prop="form_name" required>
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('form_name') }" v-model="ruleForm.form_name"></el-input>
            <has-error :form="ruleForm" field="form_name"></has-error>
          </el-form-item>
          <el-form-item label="Số giờ công" prop="form_work">
            <el-input-number v-model="ruleForm.form_work" controls-position="right" :min="1" :max="10"></el-input-number>
            <span>Giờ</span>
          </el-form-item>
          <el-form-item label="Giờ vào / ra" required>
            <el-col :span="11">
              <el-form-item prop="form_time_in" required>
                <el-time-picker value-format="HH:mm:ss" format="HH:mm:ss" :class="{ 'is-invalid':  ruleForm.errors.has('form_time_in') }" start="07:30" placeholder="Giờ vào" v-model="ruleForm.form_time_in" style="width: 100%;"></el-time-picker>
                <has-error :form="ruleForm" field="form_time_in"></has-error>
              </el-form-item>
            </el-col>
            <el-col class="line" style="text-align: center" :span="2">-</el-col>
            <el-col :span="11">
              <el-form-item prop="form_time_out" required>
                <el-time-picker value-format="HH:mm:ss" end="23:00" format="HH:mm:ss" :class="{ 'is-invalid':  ruleForm.errors.has('form_time_out') }" placeholder="Giờ ra" v-model="ruleForm.form_time_out" style="width: 100%;"></el-time-picker>
                <has-error :form="ruleForm" field="form_time_out"></has-error>
              </el-form-item>
            </el-col>
          </el-form-item>
          <el-form-item label="Ghi chú" prop="form_desc">
            <el-input type="textarea" placeholder="Nhập ghi chú của bạn tại đây" v-model="ruleForm.form_desc"></el-input>
          </el-form-item>
        </el-form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" @click="resetForm()" class="btn btn-secondary">Làm mới</button>
      <button type="submit" @click="submitForm()" class="btn btn-primary">Thêm</button>
    </div>
  </div>
</div>
</template>

<script>
export default {

  data() {
    return {
      ruleForm: new Form({
        form_name: '',
        form_work: '',
        form_time_in: '',
        form_time_out: '',
        form_desc: '',
      }),

      rules: {
        form_name: [{
          required: true,
          message: 'Tên ca làm không được để trống',
          trigger: 'blur'
        }],
        
        form_time_out: [{
          required: true,
          message: 'Giờ ra không được để trống',
          trigger: 'blur'
        }],

        form_time_in: [{
          required: true,
          message: 'Giờ vào không được để trống',
          trigger: 'blur'
        }]
      }
    };
  },
  methods: {
    //Xử lý submit
    submitForm() {
      this.loading = true;

      this.$refs['ruleForm'].validate((valid) => {
        if (valid) {
          this.ruleForm.post('/api/addCalam').then((res) => {
            if (res.data.code == 200) {
              this.$message({
                type: 'success',
                message: 'Thêm ca làm thành công'
              });

              this.$router.push({ name: 'showCalam' });
            } else {
              this.$message({
                type: 'warning',
                message: 'Lỗi'
              });
            }
          })
        }
      });
    },

    resetForm() {
      this.$refs.ruleForm.resetFields();
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
