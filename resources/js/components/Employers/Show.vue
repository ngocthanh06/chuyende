<template>
<div>
  <div class="pb-3">
                  <router-link to="/addEmployer" class="btn btn-success">Thêm nhân viên</router-link>
              </div>
<div class="row">
            
              <div class="col">
                <div class="card mb-grid">
                  <div class="table-responsive-md">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                         <el-table v-loading="loading" :data="tableData.filter(data => !search || data.User_fullname.toLowerCase().includes(search.toLowerCase()))" style="width: 100%; text-align: center">
                            <el-table-column label="STT" type="index" width="50"> </el-table-column>
                            <el-table-column label="Họ Và Tên" prop="User_fullname"> </el-table-column>
                            <el-table-column label="Chức vụ" prop="Role_id"> </el-table-column>
                            <el-table-column label="Tên Tài Khoản" prop="username"> </el-table-column>
                            <el-table-column label="Giới Tính" :formatter="ChangeSex" prop='sex'> </el-table-column>
                            <el-table-column label="Di Động" prop="User_phone"> </el-table-column>
                            <el-table-column label="TK Ngân Hàng" prop="User_bank"> </el-table-column>
                            
                            <el-table-column label="Tùy chọn" align="right">
                            <template slot="header" slot-scope="scope">
                                <el-input v-model="search" size="mini" placeholder="Type to search"/>
                            </template>
                            <template slot-scope="scope">
                                <router-link size="mini" class="el-button el-button--primary el-button--mini" :to="`/edit-Employer/${scope.row.User_id}`">Sửa</router-link>
                                <el-button size="mini" type="danger" @click="handleDelete(scope.row.User_id, scope.row)">Khóa</el-button>
                            </template>
                            </el-table-column>
                        </el-table>      
                                      
                    </div>
                    
                  </div>
                  
                </div>
                <el-pagination background @current-change = "changePage" :page-size="pagiSize"  :current-page="currentPage" layout="prev, pager, next" :total="total" style="text-align:center" > </el-pagination>
              </div>
            </div>
            
 


</div>
</template>

<script>
  export default {
    data() {
      return {
        tableData: [],
        search: '',
        loading: false,
        total : 1,
        currentPage: 1,
        pagiSize: 10,
      }
    },
    created(){
        this.getEmployer();
    },
    methods: {
      formatter(row, column) {
        return row.address;
      },
      changePage(page){
          this.currentPage = page;
          this.getEmployer();
      },
      ChangeSex(val){
         return val.sex == 1 ? 'Nam' : 'Nữ'
      },
      getEmployer(){
            this.loading =true;
            let uri = `/api/allemployers/${this.pagiSize}?page=${this.currentPage}`;
            axios.get(uri).then((res)=>{
                try{
                    if(res.status === 200) {
                        this.tableData = res.data.data;
                        this.total = res.data.total;
                    }
                    this.loading = false;
                }
                catch{(e)=>{
                  alert('Không thể hiện thị nhân viên');
                }}
            })
      },
      handleDelete(event){
          this.$confirm('Bạn có chắc xóa dữ liệu này không?', 'Cảnh báo', {
          confirmButtonText: 'Đồng ý',
          cancelButtonText: 'Hủy',
          type: 'warning',
          center: true
        }).then(() => {
          axios.get(`/api/deleteEmployer/${event}`).then((res) => {
              if(res.status === 200){
                this.$message({
                type: 'success',
                message: 'Xóa thành công'
                });       
                this.getEmployer();
              }
          });
        }).catch(() => {
          this.$message({
            type: 'info',
            message: 'Hủy thành công'
          });
        });
      }
    }
  }
</script>
