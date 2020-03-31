<template>
<div>
  <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
    <h3>Tháng</h3>
    <div class="block">
      <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
      </el-date-picker>
    </div>
    <el-radio-group @change="changeRadio1" v-model="radio">
      <el-radio :label="1">Chấp thuận</el-radio>
      <el-radio :label="2">Không chấp thuận</el-radio>
      <el-radio :label="0">Đã gửi</el-radio>
      <el-radio :label="3">Tất cả</el-radio>
    </el-radio-group>
  </div>

  <table v-loading="loading" class="table ">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ngày</th>
        <th scope="col">Ca làm</th>
        <th scope="col">Giờ vào</th>
        <th scope="col">Giờ ra</th>
        <th scope="col">Lí do</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Người duyệt</th>
        <th scope="col">Nội dung duyệt</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, key) in tableData" :key="key">
        <td scope="row">{{key+1}}</td>
        <td scope="row">{{item.Att_time}}</td>
        <td scope="row">{{item.workshifts.form_m.FormM_name}}</td>
        <td scope="row">{{item.workshifts.form_m.FormM_TimeIn}}</td>
        <td scope="row">{{item.workshifts.form_m.FormM_TimeOut}}</td>
        <td scope="row">{{item.Att_desc}}</td>
        <td scope="row" v-if="item.Att_status == 0" style="color:#0D5CF0">Đã gửi</td>
        <td scope="row" v-if="item.Att_status == 2" style="color:#F01E0D">Không chấp thuận</td>
        <td scope="row" v-if="item.Att_status == 1">Chấp thuận</td>
        <td scope="row">{{item.user.User_fullname}}</td>
        <td scope="row">{{item.Att_accept}}</td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
import moment from 'moment';
export default {
  data() {
    return {
      tableData: [],
      month: '',
      loading: true,
      radio: '',
      valueTable: []
    }
  },
  methods: {
    handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    },
    /**
     * TODO get workshilfts employers
     * @param user_id => user_id 
     * @param route id => this.currentUser.User_id 
     * @param month => month, Year
     * *Response tableData|valueTable
     */
    async getMonth() {
      let arr = [];
      let route_id = this.$route.params.id;
      let User_id = this.currentUser.User_id;
      if (route_id) {
        var val = await axios.post('/api/getsPhepNV', {
          User_id: route_id,
          month: this.month
        });
      } else {
        var val = await axios.post('/api/getsPhepNV', {
          User_id: User_id,
          month: this.month
        });
      }
      if (val.data != '') {
        arr = val.data.filter((res) => {
          return res.workshifts != null
        });
        this.valueTable = arr;
        this.tableData = arr;
        this.loading = false;
      } else this.loading = true;
    },
    /**
     * TODO change tableData when change radio button 
     */
    changeRadio1() {
      if (this.valueTable != '') {
        this.tableData = this.valueTable;
        if (this.radio != 3) {
          let val = this.tableData.filter((res) => {
            return res.Att_status == this.radio
          });
          this.tableData = val;
        }
      } else {
        this.$message({
          message: 'Bạn chưa chọn tháng làm việc',
          type: 'warning',
          center: true
        });
      }
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  },
}
</script>
