<template>
<div>
  <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
    <h3>Tháng</h3>
    <div class="block">
      <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
      </el-date-picker>
    </div>
    <el-radio-group @change="changeRadio" v-model="radio">
      <el-radio :label="1">Nghỉ làm</el-radio>
      <el-radio :label="2">Đi làm</el-radio>
      <el-radio :label="0">Chưa điểm danh</el-radio>
      <el-radio :label="3">Tất cả</el-radio>
    </el-radio-group>
  </div>

  <table v-loading="loading" class="table ">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ngày</th>
        <th scope="col">Ca làm</th>
        <th scope="col">Vào làm</th>
        <th scope="col">Kết thúc</th>
        <th scope="col">Điểm danh</th>
        <th scope="col">Nội dung điểm danh</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, key) in tableData" :key="key" :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))">
        <td scope="row">{{key+1}}</td>
        <td scope="row">{{item.WS_date}}</td>
        <td scope="row">{{item.formm.FormM_name}}</td>
        <td scope="row">{{item.WS_time_in}}</td>
        <td scope="row">{{item.WS_time_out}}</td>
        <td scope="row" v-if="item.status == 0" style="color:#0D5CF0">Chưa điểm danh</td>
        <td scope="row" v-if="item.status == 1" style="color:#F01E0D">Nghỉ làm</td>
        <td scope="row" v-if="item.status == 2">Đi làm</td>
        <td scope="row">{{item.Work_desc}}</td>
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
      search: '',
      month: '',
      loading: true,
      radio: '',
      valueTable: [],
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
      let route_id = this.$route.params.id;
      let User_id = this.currentUser.User_id;
      if (route_id) {
        this.getValues(route_id);
      } else {
        this.getValues(User_id);
      }
    },
    /**
     * TODO get API list workshilfts employers
     * @param user => user_id 
     * *Response array value
     */
    async getValues(user) {
      let arr = [];
      var val = await axios.post('/api/getsWorkshilftsNV', {
        User_id: user,
        month: this.month
      });
      if (val.data != '') {
        this.valueTable = val.data;
        this.tableData = val.data;
        this.loading = false;
      } else {
        this.tableData = [];
        this.valueTable = [];
        this.loading = true;
      }
    },
    /**
     * TODO change tableData when change radio button 
     */
    changeRadio() {
      if (this.valueTable != '') {
        this.tableData = this.valueTable;
        if (this.radio != 3) {
          let val = this.tableData.filter((res) => {
            return res.status == this.radio
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
