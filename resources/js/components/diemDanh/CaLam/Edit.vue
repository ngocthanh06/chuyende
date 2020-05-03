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
          <el-form-item label="Tên ca làm" prop="FormM_name" required>
            <el-input placeholder="Nhập tên ca làm" :class="{ 'is-invalid':  ruleForm.errors.has('FormM_name') }" v-model.number="ruleForm.FormM_name"></el-input>
            <has-error :form="ruleForm" field="FormM_name"></has-error>
          </el-form-item>
          <el-form-item label="Số giờ công" prop="region">
            <el-input-number v-model="ruleForm.FormM_Work" controls-position="right" :min="1" :max="10"></el-input-number>
            <span>Giờ</span>
          </el-form-item>
          <el-form-item label="Giờ vào / ra" required>
            <el-col :span="11">
              <el-time-picker value-format="HH:mm:ss" format="HH:mm:ss" start="07:30" placeholder="Giờ vào" v-model="ruleForm.FormM_TimeIn" style="width: 100%;"></el-time-picker>
            </el-col>
            <el-col class="line" style="text-align: center" :span="2">-</el-col>
            <el-col :span="11">
              <el-time-picker value-format="HH:mm:ss" end="23:00" format="HH:mm:ss" placeholder="Giờ ra" v-model="ruleForm.FormM_TimeOut" style="width: 100%;"></el-time-picker>
            </el-col>
          </el-form-item>
          <el-form-item label="Ghi chú" prop="desc">
            <el-input type="textarea" placeholder="Nhập ghi chú của bạn tại đây" v-model="ruleForm.FormM_desc"></el-input>
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
        FormM_name: '',
        FormM_Work: '',
        FormM_TimeIn: '',
        FormM_TimeOut: '',
        FormM_desc: '',
      }),
      rules: {
        FormM_name: [{
          required: true,
          message: 'Tên ca làm không được để trống',
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
            this.ruleForm.post(`/api/editCalam/${this.$route.params.id}`).then((res) => {
              if (res.data.code == 200) {
                this.$message({
                  type: 'success',
                  message: res.data.messages
                });
                this.resetForm('ruleForm');
                this.$router.push('/Show-Calam');
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
      this.ruleForm.FormM_name = '';
      this.ruleForm.FormM_Work = '';
      this.ruleForm.time_in = '';
      this.ruleForm.time_out = '';
      this.ruleForm.FormM_desc = '';
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
