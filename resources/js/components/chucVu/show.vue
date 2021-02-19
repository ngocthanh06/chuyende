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
              <el-table-column prop="role_name" sortable label="Tên chức vụ"> </el-table-column>
              <el-table-column :formatter="number" prop="price" sortable label="Giá mỗi ca"> </el-table-column>
              <el-table-column prop="coefficient" sortable label="Hệ số"> </el-table-column>
              <el-table-column height="" prop="role_desc" label="Nội dung"> </el-table-column>
              <el-table-column prop="date" label="Tùy chọn">
                <template slot-scope="scope">
                  <router-link size="mini" class="el-button el-button--primary el-button--mini" :to="`/editChucvu/${scope.row.role_id}`">Sửa</router-link>
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
    this.getCaLam();
  },

  methods: {
    changePage(page) {
      this.currentPage = page;
      this.getCaLam();
    },

    getCaLam() {
      this.loading = true;
      let url = `/api/listChucVu/${this.pagiSize}?page=${this.currentPage}`;

      axios.get(url).then((res) => {
        this.tableData = res.data.data;
        this.total = res.data.total;
        this.loading = false;
      })
    },
    
    number(row, column, cellValue, index) {
      return cellValue.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    }
  },
}
</script>
