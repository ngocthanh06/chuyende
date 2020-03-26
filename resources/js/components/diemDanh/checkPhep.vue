<template>
<div class="modal fade" id="checkPhep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Kiểm tra phép nhân viên <span v-if="check" style="color:red">Không tồn tại</span> </h5>
        <button type="button" @click="handleClose()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ant-modal-body">
        <div class="row m-0 timekeeping-list-date-cell-container">

          <table v-loading="loading" class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày</th>
                <th scope="col">Lí do</th>
                <th scope="col">Người duyệt</th>
                <th scope="col">Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, key) in tableData" :key="key">
                <th scope="row">{{key}}</th>
                <td scope="row">{{item.Att_time}}</td>
                <td scope="row">{{item.Att_desc}}</td>
                <td v-if="item.user!=null" scope="row">{{item.user.User_fullname}}</td>
                <td v-else scope="row">{{item.User_accept}}</td>
                <td>
                  <el-button v-if="item.Att_status === 0" type="Warning" size="mini" @click="handleEdit(item.Att_id, item.Att_status)">Chưa xác nhận</el-button>
                  <el-button v-else-if="item.Att_status === 2" size="mini" type="danger" disabled>Không chấp nhận</el-button>
                  <el-button v-else-if="item.Att_status === 1" size="mini" type="warning" disabled>đã xác nhận</el-button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-default" @click="handleClose()" data-dismiss="modal" aria-hidden="true">Đóng</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      tableData: [],
      check: false,
      loading: true,
      work: '',
      time: ''
    }
  },
  methods: {
    async handleEdit(id, status) {
      let user_id = JSON.parse(localStorage.getItem('user')).User_id;
      let val = await axios.post('/api/updateAttendance', {
        Att_id: id,
        Att_status: status,
        Att_accept: '',
        User_accept: user_id
      });
      this.$emit('openPhep', this.work, this.time);
    },
    handleClose() {
      this.loading = true;
      this.tableData = [];
      this.check = true;
      this.work = '',
        this.time = ''
    },
    async getAttendance(work_id, time) {
      this.work = work_id;
      this.time = time;
      let val = await axios.post('/api/getsWorkAttendance', {
        Workshifts_id: work_id,
        Att_time: time
      });
      if (val.data != '') {
        this.tableData = val.data;
        this.loading = false;
        this.check = false;
      } else this.check = true
    }
  },
}
</script>
