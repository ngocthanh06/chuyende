<template>
<div class="modal fade" id="createPhep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Đơn xin phép ca làm <span style="color:red"> {{ruleForm.form_name}}</span> ngày <span style="color:red">{{ruleForm.ws_date}}</span></h5>
        <button type="button" ref="closeForm" @click="handleClose('ruleForm')" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">

          <el-form-item label="Thời gian" required>
            <el-col :span="11">
              <el-form-item prop="ws_date">
                <el-date-picker type="date" placeholder="Pick a date" disabled v-model="ruleForm.ws_date" style="width: 100%;"></el-date-picker>
              </el-form-item>
            </el-col>
          </el-form-item>
          <el-form-item label="Nội dung lí do" prop="att_desc">
            <el-input type="textarea" v-model="ruleForm.att_desc"></el-input>
          </el-form-item>
        </el-form>
      </div>
      <div class="modal-footer">
        <button type="button" @click="accept('ruleForm')" class="btn btn-secondary">Gửi</button>
      </div>
    </div>

  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      ruleForm: {
        work_id: '',
        ws_date: '',
        form_name: '',
        att_desc: '',
      },
      rules: {
        att_desc: [{
          required: true,
          message: 'Lí do không được để trống',
          trigger: 'blur'
        }]
      }
    };
  },

  methods: {
    /**
     * ! Attendances
     * * value => call $refs createPheps
     */
    valuePhep(value) {
      this.ruleForm.work_id = value.work_id;
      this.ruleForm.ws_date = value.ws_date
      this.ruleForm.form_name = value.formm.form_name;
    },
    /**
     * ! Attendances
     * * CLose form
     */
    handleClose(formName) {
      this.$refs[formName].resetFields();
    },

    accept(formName) {
      this.$refs[formName].validate(async (valid) => {
        if (valid) {
          let val = await axios.post('/api/createPhep', {
            form: this.ruleForm
          });
          if (val.data.code === 200) {
            this.$message({
              showClose: true,
              message: 'Đơn xin phép đã được gửi thành công.',
              type: 'success'
            });
            this.$refs[formName].resetFields();
            this.$refs.closeForm.click();
            } else {
              this.$message({
                showClose: true,
                message: 'Đơn xin phép đã tồn tại trong ngày',
                type: 'error'
              });
              this.$refs[formName].resetFields();
            this.$refs.closeForm.click();
              return false;
            }
          }
      });
    },
  },
  computed: {

  }
}
</script>
