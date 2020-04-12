<template>
<section class="calendar">
  <div class="card">
    <div class="card-body">
      <div class="list-view">
        <!-- end title -->
        <div class="content">
          <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="Thống kê công" name="thongke">
              <thongke ref="thongke"></thongke>
            </el-tab-pane>
            <el-tab-pane label="Danh sách nhân viên tạm ứng" name="listTamung">
              <listTamung ref="listTamung"></listTamung>
            </el-tab-pane>
            <el-tab-pane label="Lương" name="luong">
              <luong ref="luong"></luong>
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
import luong from '../luong/listLuongNV';
import listTamung from './listTamung';
import thongke from './thongke';
export default {
  components: {
    thongke,
    listTamung,
    luong
  },
  data() {
    return {
      activeName: 'first'
    }
  },
  methods: {
    handleClick(tab, event) {
      if(tab.name == 'thongke'){
        this.$refs.thongke.loadVal();
      }
      if (tab.name == 'listTamung') {
        this.$refs.listTamung.loadVal();
      }
      if(tab.name =='luong'){
        this.$refs.luong.allCompanies;
        this.$refs.luong.changeEmpComp();
        this.$refs.luong.handleValExel();
      }
    }
  }
}
</script>
