<template>
<div class="modal fade" id="handlePhep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Xét duyệt giấy phép nhân viên</h5>
        <button type="button" @click="handleClose()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <el-form ref="form" :model="handlePheps" label-width="120px">
          <el-form-item label="Nội dung">
            <el-input type="textarea" placeholder="Nhập nội dung duyệt phép cho nhân viên" v-model="handlePheps.att_accept"></el-input>
          </el-form-item>
          <el-form-item label="Trạng thái">
            <el-radio-group style="line-height:48px" v-model="handlePheps.att_status">
              <el-radio :label="0" :disabled="disable.attendance">Chưa duyệt</el-radio>
              <el-radio :label="1" :disabled="disable.attendance1">Đã duyệt</el-radio>
              <el-radio :label="2" :disabled="disable.attendance2">Không được duyệt</el-radio>
            </el-radio-group>
          </el-form-item>
        </el-form>
      </div>
      <div class="modal-footer">
        <button type="button" @click="accept()" data-dismiss="modal" class="btn btn-secondary">Lưu</button>
      </div>
    </div>

  </div>
</div>
</template>

<script>
export default {
  props: {
    handlePheps: {
      type: Object,
      default: []
    }
  },
  data() {
    return {
      disable: {
        attendance: false,
        attendance1: false,
        attendance2: false
      },
    }
  },

  methods: {
    /**
     * ! Attendances
     * * call => listPhep $refs
     */
    showValue() {
      if (this.handlePheps.att_status === 1) {
        this.disable.attendance = true;
        this.disable.attendance2 = true;
      }
      if (this.handlePheps.att_status === 2) {
        this.disable.attendance = true;
        this.disable.attendance1 = true;
      }
    },
    handleClose() {
      this.disable.attendance = false;
      this.disable.attendance1 = false;
      this.disable.attendance2 = false
    },

    /**
     * ! Attendances
     * * $emit => getAttendance 
     * * @param  this.handlePheps.date = date choose
     */
    accept() {
      let id = this.handlePheps.att_id;
      let status = this.handlePheps.att_status;
      let disable = this.disable.attendance;
      let disable1 = this.disable.attendance1;
      let disable2 = this.disable.attendance2;
      let user_accept = JSON.parse(localStorage.getItem('user'));
      let att_accept = this.handlePheps.att_accept;

      if (disable == true || disable1 == true || disable2 == true) {
        this.$confirm('<b>Không thể thay đổi <i style="color:red">Trạng Thái Chấm Công</i> Chỉ được phép thay đổi nội dung !  </br> Bạn muốn tiếp tục ? </b>', 'Thông báo!', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          dangerouslyUseHTMLString: true,
          type: 'warning',
          center: true
        }).then(() => {
          if (status != 0) {
            let val = axios.post('/api/checkPhep', {
                id: id,
                user_id: user_accept.user_id,
                att_accept: att_accept
              })
              .then(res => {
                if (res.data.code === 200) 
                this.$message({
                  type: 'success',
                  message: 'Thành công'
                });
                this.$emit('getAttendance', this.handlePheps.date);
              })
          }
        })
      } else {
        let val = axios.post('/api/checkPhep', {
            status: status,
            id: id,
            user_id: user_accept.user_id,
            att_accept: att_accept
          })
          .then(res => {
            if (res.data.code === 200) this.$message({
              type: 'success',
              message: 'Thành công'
            });
          }).catch(()=>{})
      }
      this.handleClose();
      this.$emit('getAttendance', this.handlePheps.date);
    },
  },
  computed: {

  }
}
</script>
