<template>
<section id="listPhep" class="calendar">
  <el-alert v-if="loading" style="margin-bottom: 15px;" title="Thông báo !" type="error" description="Không có đơn xin phép trong ngày" show-icon>
  </el-alert>
  <div class="card">
    <div class="card-body">
      <div class="list-view">
        <div class="title">
          <div class="ttLeff">
            <h3>Danh sách phép ngày: </h3>
            <div class="form-group flatpickr">
              <input id="datepicker" class="form-control mb-2 date-default flatpickr-input active" type="text" placeholder="Chọn ngày" />
            </div>
            <router-link to="/listphepchuaduyet" class="btn btn-primary" >Phép chưa duyệt</router-link>


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
                <th scope="col">Người duyệt</th>
                <th scope="col">Nội dung người duyệt</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Sửa</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, key) in tableData" :key="key">
                <td scope="row">{{key+1}}</td>
                <td scope="row">{{formatDate(item.att_time)}}</td>
                <td scope="row">{{item.workshifts.user.user_fullname}}</td>
                <td scope="row">{{item.workshifts.user.company.nameComp}}</td>
                <td scope="row">{{item.att_desc}}</td>
                <td scope="row" v-if="item.user != null">{{item.user.user_fullname}}</td>
                <td scope="row" v-else></td>
                <td scope="row">{{item.att_accept}}</td>
                <td scope="row">
                  <el-tag v-if="item.att_status === 0" type="info">
                    Chưa xác nhận
                  </el-tag>
                  <el-tag v-else-if="item.att_status === 2" type="danger">
                    Không được chấp nhận
                  </el-tag>
                  <el-tag v-else-if="item.att_status === 1" type="success">
                    Đã xác nhận
                  </el-tag>
                </td>
                <td>
                  <el-button @click="handlePhep( item.att_id, item.att_accept, item.att_status )" href="#handlePhep" data-toggle="modal" data-target="#handlePhep" type="primary" size="mini">Sửa</el-button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end list view -->
    </div>
    <handlePhep ref="checkPhep" v-on:getAttendance="getAttendance" v-bind:handlePheps="handlePheps"></handlePhep>
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
        att_id: '',
        att_status: '',
        att_accept: '',
        date: ''
      }
    }
  },
  mounted() {
    // Todo calendar
    flatpickr("#datepicker", {
      locate: "vi",
      weekNumbers: true,
      language: "vi",
      dateFormat: "Y-m-d",
      defaultDate: "today",
      onChange: [
        /**
         * TODO output
         * @param dataObj => GMT+700
         * @param data => date
         * @param instance => arr[] 
         */
        (dataObj, data, instance) => {
          this.getAttendance(data);
          this.handlePheps.date = data;
        }
      ]
    });
  },
  methods: {
    /**
     * TODO input
     * @param date => date now
     * @reponse => tableData + loading
     */
    getAttendance(date) {
      let list = axios.post('/api/listAttendance', {
          date: date
        })
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
     * @param id => att_id
     * @param accept => att_accept
     * @param status => att_status
     */
    handlePhep(id, accept, status) {
      console.log(accept);
      this.handlePheps.att_id = id;
      this.handlePheps.att_accept = accept;
      this.handlePheps.att_status = status;
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
