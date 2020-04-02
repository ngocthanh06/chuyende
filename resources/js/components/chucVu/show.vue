<template>
<div>
  <div class="pb-3">
    <router-link to="/addChucvu" class="btn btn-sm btn-outline-secondary">
      <span class="oi oi-plus"></span>
      Thêm chức vụ</router-link>
  </div>
  <div class="row">
    <div class="col">
      <div class="card mb-grid">
        <div class="table-responsive-md">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <el-table resizable="true" v-loading="loading" :data="tableData" stripe style="width: 100%">
              <el-table-column label="STT" type="index" width="50"> </el-table-column>
              <el-table-column prop="Role_name" sortable label="Tên chức vụ"> </el-table-column>
              <el-table-column height="" prop="Role_desc" label="Nội dung"> </el-table-column>
              <el-table-column prop="date" label="Tùy chọn">
                <template slot-scope="scope">
                  <router-link size="mini" class="el-button el-button--primary el-button--mini" :to="`/editChucvu/${scope.row.Role_id}`">Sửa</router-link>
                  <!-- <el-button size="mini" type="danger">Delete</el-button> -->
                </template>
              </el-table-column>
            </el-table>
          </div>
        </div>
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
      loading: false,
    }
  },
  created() {
    this.getCaLam();
  },
  methods: {
    getCaLam() { 
      axios.get(`/api/chucvu`).then((res) => {
          if (res.status === 200) {
            this.tableData = res.data;
          }
          this.loading = false;
      })
    }
  }
}
</script>
