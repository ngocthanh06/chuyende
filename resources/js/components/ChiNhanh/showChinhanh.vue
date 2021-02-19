<template>
  <div>
    <div class="pb-3">
      <router-link to="/addChinhanh" class="btn btn-sm btn-outline-secondary">
        <span class="oi oi-plus"></span>
        Thêm chi nhánh công ty</router-link>
    </div>
    <div class="row">
      <div class="col">
        <div class="card mb-grid">
          <div class="table-responsive-md">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
              <el-table resizable="true" v-loading="loading" :data="tableData" stripe style="width: 100%">
                <el-table-column type="index" label="Stt" width="50"> </el-table-column>
                <el-table-column prop="nameComp" sortable label="Tên chi nhánh"> </el-table-column>
                <el-table-column prop="add_comp" sortable label="Địa chỉ"> </el-table-column>
                <el-table-column prop="fax_comp" sortable label="Fax"> </el-table-column>
                <el-table-column prop="phone_comp" sortable label="Số điện thoại"> </el-table-column>
                <el-table-column prop="email_comp" sortable label="Email"> </el-table-column>
                <el-table-column prop="count_comp" sortable label="Số lượng nhân viên"> </el-table-column>
                <el-table-column prop="date" label="Tùy chọn">
                  <template slot-scope="scope">
                    <router-link size="mini" class="el-button el-button--primary el-button--mini" :to="`/editChiNhanh/${scope.row.idComp}`">Edit</router-link>
                    <el-button @click="handleDelete(scope.row.idComp)" size="mini" type="danger">Delete</el-button>
                  </template>
                </el-table-column>
              </el-table>
            </div>
          </div>
        </div>
        <el-pagination 
          background 
          @current-change="changePage" 
          :page-size="pagiSize" 
          :current-page="currentPage" 
          layout="prev, pager, next" 
          :total="total" 
          style="text-align:center"
        > 
        </el-pagination>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableData: [],
      loading: false,
      total: 1,
      currentPage: 1,
      pagiSize: 10
    }
  },

  created() {
    this.getCompany();
  },

  methods: {
    changePage(page) {
      this.currentPage = page;
      this.getCompany();
    },

    getCompany() {
      this.loading = true;
      let uri = `/api/getCompany/${this.pagiSize}?page=${this.currentPage}`;
      axios.get(uri)
        .then((res) => {
          this.tableData = res.data.data;
          this.total = res.data.total;
          this.loading = false;
        })
        .catch((e) => {});
    },

    handleDelete(id) {
      axios.delete(`/api/company/${id}`)
        .then(res => {
          if (res.data == false) {
            this.$message({
              showClose: true,
              message: 'Lỗi, Chi nhánh đã tồn tại nhân viên nên không thể xóa.',
              type: 'error'
            });
          } else {
            this.$message({
              showClose: true,
              message: 'Thành công, Chi nhánh đã được xóa.',
              type: 'success'
            });

            this.changePage();
          }
      })
    }
  }
}
</script>

<style lang="scss">
.el-table__row {
  .cell {
    white-space: nowrap;
    overflow: hidden;
    width: 180px;
    height: 30px;
    text-overflow: ellipsis;
  }
}
</style>
