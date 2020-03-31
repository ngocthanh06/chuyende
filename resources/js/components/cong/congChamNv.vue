<template>
<div>
  <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
    <h3>Tháng</h3>
    <div class="block">
      <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
      </el-date-picker>
    </div>
  </div>

  <table v-loading="loading" class="table ">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ngày</th>
        <th scope="col">Tên nhân viên</th>
        <th scope="col">Ca làm</th>
        <th scope="col">Giờ vào</th>
        <th scope="col">Giờ ra</th> 
        <th scope="col">Trạng thái</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, key) in tableData" :key="key">
        <td scope="row">{{key+1}}</td>
        <td scope="row">{{item.WS_date}}</td>
        <td scope="row">{{item.user.User_fullname}}</td>
        <td scope="row">{{item.formm.FormM_name}}</td>
        <td scope="row">{{item.WS_time_in}}</td>
        <td scope="row">{{item.WS_time_out}}</td>
        <td scope="row" v-if="item.status == 2" style="color:#0D5CF0">Đi làm</td>
        <td scope="row" v-else ></td>
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
    getMonth() {
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
    async getValues(user){
      let arr = [];
      let val = await axios.post('/api/getsWorkshilftsNV', {
          User_id: user,
          month: this.month
        });
        if (val.data != '') {
          arr = val.data.filter((res)=>{
            return res.status == 2;
          })
        this.tableData = arr;
        arr != '' ? this.loading = false : this.loading = true;
      } else this.loading = true;
    }
   
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  },
}
</script>
