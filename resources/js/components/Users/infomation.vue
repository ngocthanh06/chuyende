<template>
<div>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <!-- end title -->
          <div class="content">
            <el-tabs v-model="activeName" @tab-click="handleClick">
              <el-tab-pane label="Ca làm đã đăng ký" name="calamNhanvien">
                <calamNhanvien></calamNhanvien>
              </el-tab-pane>
              <el-tab-pane label="Công đã chấm" name="chamcong">
                <chamcong></chamcong>
              </el-tab-pane>
              <el-tab-pane label="Phép" name="attendance">
                <listPhepNV></listPhepNV>
              </el-tab-pane>
              <el-tab-pane label="Tạm ứng" name="tamung">
                <tamung ref="tamung"></tamung>
              </el-tab-pane>
              <el-tab-pane label="Danh sách tạm ứng" name="dsTamung">
                <dstamung ref="dstamung" ></dstamung>
              </el-tab-pane>
              <el-tab-pane label="Lương" name="fourth2">Phép2</el-tab-pane>
              <el-tab-pane label="Thông tin tài khoản" name="fourth3">Phép3</el-tab-pane>
            </el-tabs>
          </div>
        </div>
        <!-- end list view -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </section>
</div>
</template>

<script>
import dstamung from '../cong/danhsachtamung';
import listPhepNV from '../phep/listPhepNV';
import calamNhanvien from '../CaLam/calamNhanvien';
import chamcong from '../cong/congChamNv';
import tamung from '../cong/tamung';
export default {
  components: {
    calamNhanvien,
    chamcong,
    listPhepNV,
    tamung,
    dstamung
  },
  data() {
    return {
      activeName: 'first'
    };
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
      if (tab.name == 'tamung') {
        this.$refs.tamung.loadVal();
      }
      if(tab.name == 'dsTamung'){
        this.$refs.dstamung.loadVal();
      }
    },
  }
};
</script>
