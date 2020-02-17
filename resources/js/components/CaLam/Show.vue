<template>
  <div>
   <div class="pb-3">
      <router-link to="/Add-Calam" class="btn btn-sm btn-outline-secondary">
      <span class="oi oi-plus"></span>
      Thêm ca làm</router-link>
   </div>
   <div class="row">
      <div class="col">
         <div class="card mb-grid">
            <div class="table-responsive-md">
               <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                  <el-table resizable="true" v-loading="loading" :data="tableData" stripe  style="width: 100%">
                     <el-table-column type="index"  width="50"> </el-table-column>
                     <el-table-column prop="FormM_name" sortable label="Tên ca làm"> </el-table-column>
                     <el-table-column prop="FormM_Work" sortable label="Số giờ công"> </el-table-column>
                     <el-table-column prop="FormM_TimeIn" sortable label="Giờ vào"> </el-table-column>
                     <el-table-column prop="FormM_TimeOut" sortable label="Giờ ra"> </el-table-column>
                     <el-table-column height="" prop="FormM_desc" label="Ghi chú"> </el-table-column>
                     <el-table-column prop="date" label="Tùy chọn">
                        <router-link size="mini" class="el-button el-button--primary el-button--mini" :to="`/edit-Employer/`">Edit</router-link>
                        <el-button size="mini" type="danger">Delete</el-button>
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
        loading: false, 
        total: 1,
        currentPage: 1,
        pagiSize: 10
      }
    },
    created(){
        this.getCaLam();
    },
    mounted(){

    },
    methods:{
        changePage(page){
          this.currentPage = page;
          this.getCaLam();
      },
        getCaLam(){
            this.loading = true;
            let uri = `/api/CaLam/${this.pagiSize}?page=${this.currentPage}`;
            axios.get(uri).then((res)=>{
                try{
                    if(res.status === 200) {
                        this.tableData = res.data.data;
                        this.total = res.data.total;
                        // console.log(res.data);
                    }
                    this.loading = false;
                }
                catch{(e)=>{
                }}
            }).catch((e)=>{});
        }
    }
  }
</script>
<style lang="scss">
    .el-table__row {
        .cell{
            white-space: nowrap;
            overflow: hidden;
            width: 180px;
            height: 30px;
            text-overflow: ellipsis; 
        }
    }
</style>