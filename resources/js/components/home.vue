<template>
<div class="container-fluid">

  <div class="pb-3">
    <h1>Thống kê chi tiết</h1>
  </div>

  <div class="row">
    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-users" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87" />
              <path d="M 16 3.13 a 4 4 0 0 1 0 7.75" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Tổng số nhân viên</div>
            <h3 class="card-title mb-0">
              {{totalNV}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-success text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-user" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 20 21 v -2 a 4 4 0 0 0 -4 -4 H 8 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="12" cy="7" r="4" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Số nhân viên đang làm</div>
            <h3 class="card-title mb-0">
              {{nvDanglam}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-danger text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-user-x" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 16 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="8.5" cy="7" r="4" />
              <line x1="18" y1="8" x2="23" y2="13" />
              <line x1="23" y1="8" x2="18" y2="13" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Nhân viên đã khóa</div>
            <h3 class="card-title mb-0">
              {{nvDakhoa}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-secondary text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-users" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87" />
              <path d="M 16 3.13 a 4 4 0 0 1 0 7.75" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Chi nhánh</div>
            <h3 class="card-title mb-0">
              {{chiNhanh}}
            </h3>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-users" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87" />
              <path d="M 16 3.13 a 4 4 0 0 1 0 7.75" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Số phép đã duyệt</div>
            <h3 class="card-title mb-0">
              {{phepDuyet}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-success text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-user" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 20 21 v -2 a 4 4 0 0 0 -4 -4 H 8 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="12" cy="7" r="4" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Phép chưa duyệt</div>
            <h3 class="card-title mb-0">
              {{phepChua}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-danger text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-user-x" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 16 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="8.5" cy="7" r="4" />
              <line x1="18" y1="8" x2="23" y2="13" />
              <line x1="23" y1="8" x2="18" y2="13" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Phép từ chối</div>
            <h3 class="card-title mb-0">
              {{phepTuchoi}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-secondary text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-users" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87" />
              <path d="M 16 3.13 a 4 4 0 0 1 0 7.75" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Tổng số phép</div>
            <h3 class="card-title mb-0">
              {{soPhep}}
            </h3>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card mb-grid w-100">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">
              Tổng công tháng {{month}}
            </h5>

            <div class="card-title-sub">
              {{tongcong}} Công
            </div>
          </div>

          <div class="progress mt-auto">
            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">3/4</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card mb-grid w-100">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">
              Tổng lương thanh toán tháng {{month}}
            </h5>

            <div class="card-title-sub">
              <p style="color: red; font-weight: bold; ">
                {{tongluong.toLocaleString('it-IT',{style: 'currency', currency: 'VND'})}}

              </p>
            </div>
          </div>

          <div class="progress mt-auto">
            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-shopping-cart" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <circle cx="8" cy="21" r="2" />
              <circle cx="20" cy="21" r="2" />
              <path d="M 5.67 6 H 23 l -1.68 8.39 a 2 2 0 0 1 -2 1.61 H 8.75 a 2 2 0 0 1 -2 -1.74 L 5.23 2.74 A 2 2 0 0 0 3.25 1 H 1" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Số nhân viên tạm ứng tháng {{month}}</div>
            <h3 class="card-title mb-0">
              {{nhanvientamung}}
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 d-flex">
      <div class="card border-0 bg-success text-white text-center mb-grid w-100">
        <div class="d-flex flex-row align-items-center h-100">
          <div class="card-icon d-flex align-items-center h-100 justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-users" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
              <path d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87" />
              <path d="M 16 3.13 a 4 4 0 0 1 0 7.75" /></svg>
          </div>
          <div class="card-body">
            <div class="card-info-title">Nhân viên hoạt động</div>
            <h3 class="card-title mb-0">
              1,258
            </h3>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="card-header-title">Danh sách nhân viên tạm ứng</div>

          <nav class="card-header-actions">
            <a class="card-header-action" aria-expanded="false" aria-controls="card1" href="#card1" data-toggle="collapse">
              <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-minus-circle" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
                <circle cx="12" cy="12" r="10" />
                <line x1="8" y1="12" x2="16" y2="12" /></svg>
            </a>

            <div class="dropdown">
              <a class="card-header-action" id="card1Settings" role="button" aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-settings" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
                  <circle cx="12" cy="12" r="3" />
                  <path d="M 19.4 15 a 1.65 1.65 0 0 0 0.33 1.82 l 0.06 0.06 a 2 2 0 0 1 0 2.83 a 2 2 0 0 1 -2.83 0 l -0.06 -0.06 a 1.65 1.65 0 0 0 -1.82 -0.33 a 1.65 1.65 0 0 0 -1 1.51 V 21 a 2 2 0 0 1 -2 2 a 2 2 0 0 1 -2 -2 v -0.09 A 1.65 1.65 0 0 0 9 19.4 a 1.65 1.65 0 0 0 -1.82 0.33 l -0.06 0.06 a 2 2 0 0 1 -2.83 0 a 2 2 0 0 1 0 -2.83 l 0.06 -0.06 a 1.65 1.65 0 0 0 0.33 -1.82 a 1.65 1.65 0 0 0 -1.51 -1 H 3 a 2 2 0 0 1 -2 -2 a 2 2 0 0 1 2 -2 h 0.09 A 1.65 1.65 0 0 0 4.6 9 a 1.65 1.65 0 0 0 -0.33 -1.82 l -0.06 -0.06 a 2 2 0 0 1 0 -2.83 a 2 2 0 0 1 2.83 0 l 0.06 0.06 a 1.65 1.65 0 0 0 1.82 0.33 H 9 a 1.65 1.65 0 0 0 1 -1.51 V 3 a 2 2 0 0 1 2 -2 a 2 2 0 0 1 2 2 v 0.09 a 1.65 1.65 0 0 0 1 1.51 a 1.65 1.65 0 0 0 1.82 -0.33 l 0.06 -0.06 a 2 2 0 0 1 2.83 0 a 2 2 0 0 1 0 2.83 l -0.06 0.06 a 1.65 1.65 0 0 0 -0.33 1.82 V 9 a 1.65 1.65 0 0 0 1.51 1 H 21 a 2 2 0 0 1 2 2 a 2 2 0 0 1 -2 2 h -0.09 a 1.65 1.65 0 0 0 -1.51 1 Z" /></svg>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="card1Settings">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>

            <a class="card-header-action" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-x-circle" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24">
                <circle cx="12" cy="12" r="10" />
                <line x1="15" y1="9" x2="9" y2="15" />
                <line x1="9" y1="9" x2="15" y2="15" /></svg>
            </a>
          </nav>
        </div>
        <div class="card-body collapse show" id="card1">
          <table class="table table-bordered mb-0">
            <thead>
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
                <td>{{key + 1}}</td>
                <td>
                  <router-link :to="`/infoUser/${items.user.user_id}`">{{items.user.user_fullname}}</router-link>
                </td>
                <td>{{items.user.role.role_name}}</td>
                <td>{{items.per_time}}</td>
                <td>{{items.qtycong}}</td>
                <td>{{items.per_total}}</td>
                <td>{{items.per_desc}}</td>
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
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a class="btn btn-primary" href="#">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>

  <!-- char -->
  <div class="row" style="margin-top: 30px">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="card-header-title">Đồ thị</div>

        </div>
        <div class="card-body collapse show" id="card1">
          <!-- <char :month="month"></char> -->

          <div id="app">
            <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource"></fusioncharts>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a class="btn btn-primary" href="#">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import char from './char';
import moment from 'moment';
export default {

  components: {
    moment,
    char,
  },
  mounted() {
    this.loadThongke();
  },
  data() {
    var dataSource = {
      "chart": {
        "caption": `Đồ thị lương hàng tháng của năm ${moment().format('YYYY')}`,
        "subCaption": `Tháng ${moment().format('MM')}`,
        "xAxisName": "Đồ thị lương hàng tháng",
        "yAxisName": "Chỉ số",
        "numberSuffix": "",
        "theme": "fusion"
      },
      "data": []
    };
    return {
      width: '100%',
      height: '400',
      type: 'column2d',
      dataFormat: 'json',
      dataSource: dataSource,

      totalNV: 0,
      nvDanglam: 0,
      nvDakhoa: 0,
      chiNhanh: 0,
      soPhep: 0,
      phepDuyet: 0,
      phepChua: 0,
      phepTuchoi: 0,
      dataTable: '',
      nhanvientamung: 0,
      month: '',
      tongluong: 0,
      tongcong: 0
    }
  },
  methods: {
    // function to slice items when radio buttons are clicked using the slicePlotItems api
    onChangeItem: function () {
      const chart = this.$refs.fc.chartObj,
        lastActive = this.lastActive,
        value = this.radioValue;
      this.lastActive = value;
      if (value === 'none') {
        chart.slicePlotItem(lastActive, false);
      } else {
        chart.slicePlotItem(value, true);
      }
    },
    // function to actiavte radio buttons when plots are clicked
    onSliceClick: function (e) {
      var isSliced = e.data.isSliced;
      if (isSliced) {
        this.lastActive = this.radioValue = 'none'
      } else {
        this.lastActive = this.radioValue = e.data.index
      }
    },
    async loadThongke() {
      let val = await axios.post('/api/loadthongke', {
        time: moment().format('MM - YYYY')
      });
      this.month = moment().format('MM');
      this.totalNV = val.data.totalNV;
      this.nvDanglam = val.data.nvDanglam;
      this.nvDakhoa = val.data.nvDakhoa;
      this.chiNhanh = val.data.chiNhanh;
      this.soPhep = val.data.soPhep;
      this.phepDuyet = val.data.phepDuyet;
      this.phepChua = val.data.phepChua;
      this.phepTuchoi = val.data.phepTuchoi;
      this.dataTable = val.data.listNVTamung.data;
      this.nhanvientamung = val.data.CountNVTamung;
      this.tongluong = val.data.permission;
      //công
      let countWorkshilfts = [];
      let workshiftsNotNull = val.data.listCong.filter((res) => {
        return res.workshifts != ''
      });
      workshiftsNotNull.forEach(res => {
        res.workshifts.forEach(r => {
          countWorkshilfts.push(r);
        })
      });
      let number = countWorkshilfts.reduce((weight, val, index, column) => {
        return val.formm.form_work > 4 ? weight += 2 : weight += 1;
      }, 0);
      this.tongcong = number;
      
      let per = []
        per.push(
          {
            "label": val.data.thongkePer.label1,
            "value": val.data.thongkePer.value1
          },
          {
            "label": val.data.thongkePer.label2,
            "value": val.data.thongkePer.value2
          },
          {
            "label": val.data.thongkePer.label3,
            "value": val.data.thongkePer.value3
          },
          {
            "label": val.data.thongkePer.label4,
            "value": val.data.thongkePer.value4
          },
          {
            "label": val.data.thongkePer.label5,
            "value": val.data.thongkePer.value5
          },
          {
            "label": val.data.thongkePer.label6,
            "value": val.data.thongkePer.value6
          },
          {
            "label": val.data.thongkePer.label7,
            "value": val.data.thongkePer.value7
          },
          {
            "label": val.data.thongkePer.label8,
            "value": val.data.thongkePer.value8
          },
          {
            "label": val.data.thongkePer.label9,
            "value": val.data.thongkePer.value9
          },
          {
            "label": val.data.thongkePer.label10,
            "value": val.data.thongkePer.value10
          },
          {
            "label": val.data.thongkePer.label11,
            "value": val.data.thongkePer.value11
          },
          {
            "label": val.data.thongkePer.label12,
            "value": val.data.thongkePer.value12
          }
        )
      
      this.dataSource.data = per;
    }
  }
}
</script>

<style scoped>

</style>
