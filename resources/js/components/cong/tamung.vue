<template>
<div>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
            <h3>Tháng</h3>
            <div class="block">
              <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
              </el-date-picker>
            </div>
          </div>
          <!-- end title -->
          <div class="content" style="width: 80%; margin: 30px auto; border: 1px solid #e9ecef; padding: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
            <el-form ref="ruleForm" :filter-multiple=true role="ruleForm" v-loading="loading" label-position="top" :model="ruleForm" label-width="120px" class="demo-ruleForm">
              <el-form-item label="Tên nhân viên" prop="user_fullname">
                <el-input disabled v-model="user_fullname"></el-input>
              </el-form-item>
              <el-form-item label="Chức vụ" prop="role_name">
                <el-input disabled v-model="role_name"></el-input>
              </el-form-item>
              <el-form-item label="Tổng công trong tháng" prop="congThang">
                <el-input type="number" disabled="" v-model="congThang"></el-input>
              </el-form-item>
              <el-form-item label="Số tiền tương ứng" prop="tienThang">
                <el-input type="text" disabled="" v-model="tienThang"></el-input>
              </el-form-item>
              <el-form-item>
                <el-col :span="8">
                  <el-form-item class="tamung" label="Số công tạm ứng" prop="qtycong" style="padding-right:30px">
                    <el-input type="number" :min="0" :max="congThang" @change="qtyCong()" v-model="ruleForm.qtycong"></el-input>Công
                  </el-form-item>
                </el-col>
                <el-col :span="11">
                  <el-form-item label="Số tiền tương ứng" prop="per_total">
                    <el-input type="text" disabled v-model="per_total"></el-input>
                  </el-form-item>
                </el-col>
              </el-form-item>
              <el-form-item label="Ngày ứng" prop="per_time">
                <el-date-picker type="date" value-format="yyyy-MM-dd" format="yyyy-MM-dd" placeholder="Chọn ngày tháng" v-model="ruleForm.per_time" style="width: 100%;"></el-date-picker>
              </el-form-item>
              <el-form-item label="Nội dung" prop="per_desc">
                <el-input type="textarea" v-model="ruleForm.per_desc"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click="submitForm('ruleForm')">Lưu</el-button>
                <el-button @click="resetForm()">Reset</el-button>
              </el-form-item>
            </el-form>
          </div>
        </div>

        <!-- end list view -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </section>
</div>
</template>

<script>
import moment from 'moment';
export default {
  data() {
    return {
      loading: true,
      month: '',
      congThang: '',
      tienThang: '',
      user_fullname: '',
      role_name: '',
      min: 0,
      price: 0,
      coefficient: 1,
      per_total: 0,
      ruleForm: new Form({
        qtycong: 0,
        per_total: 0,
        per_time: '',
        user_id: '',
        per_desc: '',
        status: 0,
      }),
    }
  },
  methods: {
    /**
     * Todo call value when open tab 
     * *$refs -> infomation 
     * ! can't remove
     */
    loadVal() {
      this.month = this.getTimeNow;
      this.ruleForm.per_time = moment().format("YYYY-MM-DD");
      this.checkIssetPermission();
    },
    /**
     * Todo check isset permission ? 
     * @param time: this.cur-month
     * @param user_id : id user
     * * call func getPrepay + getUser
     * *
     * ! can't remove
     */
    async checkIssetPermission() {
      let val = await axios.post('/api/checkIssetPermission', {
        time: this.month,
        user_id: this.setId
      })
      if (val.data == '') {
        console.log(val);
        this.getPrepay();
        this.getUser();
      } else {
        this.$message({
          showClose: true,
          message: 'Thông báo, ca làm đã được thanh toán vì vậy không thể tạm ứng vào tháng này.',
          type: 'error'
        });
        this.loading = true;
      }
    },
    /**
     * Todo when click month
     * * call checkIssetPermission
     * ! can't remove
     */
    getMonth() {
      this.checkIssetPermission();
    },
    /**
     * Todo get infomation user callback input form
     * 
     * ! can't remove
     */
    async getUser() {
      let val = await axios.post(`/api/userPerMiss/`, {
        id: this.setId,
        date: this.month
      });
      if (val.data) {
        this.loading = false;
        this.currentUser.role_id == 2 ? this.ruleForm.status = 1 : this.ruleForm.status;
        this.user_fullname = val.data.user_fullname;
        this.role_name = val.data.role.role_name;
        this.congThang = val.data.workshifts.reduce((weight, val, index, column) => {
          return val.formm.form_work > 4 ? weight += 2 : weight += 1;
        }, 0) - this.min;
        this.price = val.data.role.price;
        this.coefficient = val.data.role.coefficient;
        this.tienThang = this.tienTong;
        this.ruleForm.user_id = this.setId;
        this.per_total = this.tienUng.toLocaleString('it-IT', {
          style: 'currency',
          currency: 'VND'
        });
        this.ruleForm.per_total = this.tienUng;
      }
    },
    /**
     * Todo submit form 
     * * phase 1: check count cong > 0
     * * phase 2: check isset prepayment 
     * * phase 3: submit form
     * ! can't remove
     */
    submitForm(formName, value) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          if (this.ruleForm.qtycong > 0) {
            this.ruleForm.post('/api/prepayment').then((res) => {
              if (res.data.code == '200') {
                this.$message({
                  showClose: true,
                  message: 'Thông báo, tạm ứng thành công.!',
                  type: 'success'
                });
                this.checkIssetPermission();
                this.resetForm();
              } else if (this.currentUser.role_id == 1) {
                this.$message({
                  showClose: true,
                  message: 'Thông báo, bạn đã gửi đơn tạm ứng trong ngày xin vui lòng chờ quản lý xác nhận.',
                  type: 'warning'
                });
              } else {
                this.$message({
                  showClose: true,
                  message: 'Thông báo, nhân viên đã gửi đơn. Xin vui lòng xác nhận.',
                  type: 'warning'
                });
              }
            })
          } else {
            this.$message({
              showClose: true,
              message: 'Thông báo, công ứng không được nhỏ hơn 0.',
              type: 'error'
            });
          }
        }
      });
    },
    resetForm() {
      this.ruleForm.qtycong = 0;
      this.ruleForm.per_desc = '';
    },
    /**
     * Todo change cong when number <> tongcong
     * ! can't remove
     */
    qtyCong() {
      this.congMax;
      this.congMin;
      this.per_total = this.tienUng.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
      });
      this.ruleForm.per_total = this.tienUng;
    },
    /**
     * Todo get number qtycong isset
     * ! can't remove
     */
    async getPrepay() {
      let val = await axios.post('/api/checkPrepay', {
        user_id: this.setId,
        time: this.month
      });
      this.min = val.data.reduce((weight, res, index, animals) => {
        return weight += res.qtycong;
      }, 0);
    },
  },
  computed: {
    /**
     * Todo id user 
     * ! can't remove
     */
    setId() {
      if (!this.$route.params.id) {
        return this.currentUser.user_id;
      }
      return this.$route.params.id;
    },
    getTimeNow() {
      return moment().format("MM - YYYY");
    },
    congMax() {
      return this.ruleForm.qtycong > this.congThang ? this.ruleForm.qtycong = this.congThang : this.ruleForm.qtycong;
    },
    congMin() {
      return this.ruleForm.qtycong <= 0 ? this.ruleForm.qtycong = 0 : this.ruleForm.qtycong;
    },
    tienUng() {
      return this.ruleForm.qtycong * this.coefficient * this.price;
    },
    tienTong() {
      return (this.price * this.coefficient * this.congThang).toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
      });
    },
    /**
     * Todo infomation user login
     * ! can't remove
     */
    currentUser() {
      return this.$store.getters.currentUser;
    }

  }
}
</script>

<style lang="scss">
.tamung {
  .el-input {
    width: 80px;
    padding-right: 10px;

    input {
      text-align: center;
    }
  }
}
</style>
