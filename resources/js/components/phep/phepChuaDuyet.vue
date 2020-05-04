<template>
<section id="listPhep" class="calendar">
  <div class="card">
    <div class="card-body">
      <div class="list-view">
        <div class="title">
          <div class="ttLeff">
            <h3>Danh sách phép chưa duyệt: </h3>
          </div>
          <!-- end left -->

        </div>
        <!-- end title -->
        <div class="content">
          <table class="table table-bordered" style="width: 100%; text-align: center" v-loading="loading" :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày</th>
                <th scope="col">Tên nhân viên</th>
                <th scope="col">Chi nhánh</th>
                <th scope="col">Nội dung</th> 
                <th scope="col">Trạng thái</th>
                <th scope="col">Sửa</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, key) in tableData" :key="key">
                <td scope="row">{{key+1}}</td>
                <td scope="row">{{formatDate(item.Att_time)}}</td>
                <td scope="row">{{item.workshifts.user.User_fullname}}</td>
                <td scope="row">{{item.workshifts.user.company.nameComp}}</td>
                <td scope="row">{{item.Att_desc}}</td> 
                <td scope="row">
                  <el-tag :model="changeStatus">
                    Chưa xác nhận
                  </el-tag>
                </td>
                <td>
                  <el-button @click="handlePhep( item.Att_id, item.Att_accept, item.Att_status )" href="#handlePhep" data-toggle="modal" data-target="#handlePhep" type="primary" size="mini">Sửa</el-button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end list view -->
    </div>
    <handlePhep ref="checkPhep" v-on:getAttendancelist="getAttendancelist" v-bind:handlePheps="handlePheps"></handlePhep>
    <!-- end card-body -->
  </div>
  <!-- end card -->
</section>
</template>

<script>
import handlePhep from './handlePhep';
import moment from 'moment';
export default {
  components: {
    handlePhep
  },
  data() {
    return {
      tableData: [],
      search: '',
      loading: true,
      handlePheps: {
        Att_id: '',
        Att_status: '',
        Att_accept: '',
      }
    }
  },
  mounted() {
    this.getAttendancelist()
  },
  methods: {
    /**
     * TODO input
     * @param date => date now
     * @reponse => tableData + loading
     */
    getAttendancelist() {
      let list = axios.get('/api/listchuaduyet')
        .then(res => {
          if (res.data != '') {
            this.tableData = res.data;
            this.loading = false;
          } else {
            this.tableData = [];
            this.loading = true;
          }
        });
    },
    /**
     * TODO output
     * @param date => date (year-month-day) 
     */
    formatDate(date) {
      return moment(date).format('Y-M-D');
    },
    /**
     * TODO output
     * @param id => Att_id
     * @param accept => Att_accept
     * @param status => Att_status
     */
    handlePhep(id, accept, status) {
      console.log(accept);
      this.handlePheps.Att_id = id;
      this.handlePheps.Att_accept = accept;
      this.handlePheps.Att_status = status;
      this.$refs.checkPhep.showValue();
    },
    /**
     * TODO output
     * @param id => id_Attendance
     */
    handleDelete(index, row) {
      console.log(index, row);
    }
  },
  computed: {},
  watch: {}
}
</script>

<style lang="css">
#listPhep .ttLeff {
  display: flex;
  width: 100%
}
</style>
