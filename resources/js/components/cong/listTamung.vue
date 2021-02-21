<template>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
            <h3>Tháng</h3>
            <div class="block">
              <el-date-picker 
                @change="getMonth()" 
                v-model="month" 
                value-format="MM - yyyy" 
                format="MM - yyyy" 
                type="month" 
                style="margin: 0 10px" 
                placeholder="Chọn tháng phù hợp"
              >
              </el-date-picker>
            </div>
          </div>
          <!-- end title -->
          <div class="content">
            <table v-loading ="loading" class="table">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Tên nhân viên</th>
                  <th>Chức vụ</th>
                  <th>Thời gian tạm ứng</th>
                  <th>Số công</th>
                  <th>Số tiền tương ứng</th>
                  <th>Nội dung</th>
                  <th>Xác nhận</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(items, key) in dataTable" :key="key">
                  <td> {{ key + 1 }} </td>
                  <td> 
                    <router-link :to="`/infoUser/${items.user.user_id}`">
                      {{ items.user.user_fullname }}
                    </router-link> 
                  </td>
                  <td> {{ items.user.role.role_name }} </td>
                  <td> {{ items.per_time }} </td>
                  <td> {{ items.qtycong }} </td>
                  <td> {{ items.per_total }} </td>
                  <td> {{ items.per_desc }} </td>
                  <td v-if="items.status == 0" style="color: red">
                    <el-button size="mini" v-if="currentUser.role_id == 1" disabled type="danger" icon="el-icon-error" circle></el-button>
                    <el-button size="mini" v-else type="danger" icon="el-icon-error" @click="changeStatus(items.pre_id)" circle></el-button>
                  </td>
                  <td v-else>
                    <el-button size="mini" disabled type="success" icon="el-icon-check" circle></el-button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end list view -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </section>
</template>

<script>
import moment from 'moment';
import { requestStatus } from '../../config/constant';

export default {
  data() {
    return {
      month: '',
      dataTable: [],
      loading: true
    }
  },

  methods: {
    loadVal() {
      this.month = this.getTimeNow;
      this.loadData();
    },

    getMonth() {
      if (this.month) {
        this.loadData();
      } else {
        this.$message({
          showClose: true,
          message: 'Thông báo, Tháng không được để trống.!',
          type: 'error'
        });
      } 
    },

    async changeStatus(id) {
      let val = await axios.get(`/api/editStatus/${id}`);
      
      if (val.data.code == requestStatus.success) {
        this.getMonth();
        this.loading = false;

        this.$message({
          showClose: true,
          message: 'Thông báo, xét duyệt thành công.!',
          type: 'success'
        });
      }
    },

    async loadData() {
      let val = await axios.post('/api/listAll', {
        time: this.month
      });

      if (val.data == '') {
        this.$message({
          showClose: true,
          message: 'Thông báo, không có tạm ứng trong tháng này.',
          type: 'error'
        });
        
        this.loading=true;
      } else{
        this.dataTable = val.data;
        this.loading = false;
      }
    },
  },

  computed: {
    /**
     * Todo infomation user login
     * ! can't remove
     */
    currentUser() {
      return this.$store.getters.currentUser;
    },

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
  }
}
</script>
