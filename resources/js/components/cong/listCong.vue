<template>
   <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <!-- end title -->
          <div class="content">
            <el-tabs v-model="activeName" @tab-click="handleClick">
              <el-tab-pane label="Thống kê công" name="calamNhanvien">
                <thongke></thongke>
              </el-tab-pane>
              <el-tab-pane label="Lương" name="luong">
                luong
              </el-tab-pane> 
            </el-tabs>
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
import thongke from './thongke';
export default {
  components:{
    thongke
  },
  data(){
    return {
      activeName: 'first'
    }
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    }
  }
}
</script>