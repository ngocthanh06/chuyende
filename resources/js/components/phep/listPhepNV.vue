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
        <td scope="row">{{item.att_time}}</td>
        <td scope="row">{{item.workshifts.formm.form_name}}</td>
        <td scope="row">{{item.workshifts.formm.form_time_in}}</td>
        <td scope="row">{{item.workshifts.formm.form_time_out}}</td>
        <td scope="row">{{item.att_desc}}</td>
        <td scope="row" v-if="item.att_status == 0" style="color:#0D5CF0">Đã gửi</td>
        <td scope="row" v-if="item.att_status == 2" style="color:#F01E0D">Không chấp thuận</td>
        <td scope="row" v-if="item.att_status == 1">Chấp thuận</td>
        <td scope="row" v-if="item.user">{{item.user.user_fullname}}</td>
        <td scope="row">{{item.att_accept}}</td>
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
     * @param route id => this.currentUser.user_id 
     * @param month => month, Year
     * *Response tableData|valueTable
     */
    async getMonth() {
      let route_id = this.$route.params.id;
      let user_id = this.currentUser.user_id;
      if (route_id) {
        this.getValues(route_id);
      } else {
        this.getValues(user_id);
      }
    },
    /**
     * TODO get API list workshilfts employers
     * @param user => user_id 
     * *Response array value
     */
    async getValues(user) {
      let arr = [];
      var val = await axios.post('/api/getsPhepNV', {
        user_id: user,
        month: this.month
      });
      if (val.data != '') {
        arr = val.data.filter((res) => {
          return res.workshifts != null
        });
        this.valueTable = arr;
        this.tableData = arr;
        this.loading = false;
      } else {
        this.valueTable = [];
        this.tableData = [];
        this.loading = true;
      }
    },
    /**
     * TODO change tableData when change radio button 
     */
    changeRadio1() {
      if (this.valueTable != '') {
        this.tableData = this.valueTable;
        if (this.radio != 3) {
          let val = this.tableData.filter((res) => {
            return res.att_status == this.radio
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
