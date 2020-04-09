<template>
<section class="calendar">
  <div class="card">
    <div class="card-body">
      <div class="list-view">
        <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
          <h3>Bảng lương tháng</h3>
          <div class="block">
            <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
            </el-date-picker>
          </div>
        </div>
        <!-- end title -->
        <div class="select-choose">
          <!-- chọn công ty -->
          <div class="form-group flatpickr col-sm-2" style="float:right">
            <select @change="changeEmpComp()" v-model="company" class="form-control" id="exampleFormControlSelect1">
              <option value="0" selected>Tất cả</option>
              <option v-for="items in getCompanies" :key="items.idComp" :value="items.idComp">{{items.nameComp}}</option>
            </select>
          </div>
          <!-- <end công ty -->
        </div>
        <div class="content">
          <table class="table table-dark table-striped">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Họ Tên </th>
                <th>Chức vụ</th>
                <th>Hệ số</th>
                <th>Lương/ca</th>
                <th>Số công làm</th>
                <th>Thu nhập</th>
                <th>Công tạm ứng</th>
                <th>Thưởng</th>
                <th>Phạt</th>
                <th>Thực lĩnh</th>
                <th>Đã thanh toán</th>
                <th>Còn lại</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(items, key) in dataTable" :key="key" class="table-primary" style="color: #000">
                <td>{{key +1}}</td>
                <td>{{items.User_fullname}}</td>
                <td>{{items.role.Role_name}}</td>
                <td>{{items.role.coefficient}}</td>
                <td>{{items.role.price.toLocaleString('it-IT', { style: 'currency', currency: 'VND'})}}</td>
                <td v-if="items.workshifts">{{workshilfts(items.workshifts)}}</td>
                <td>{{thunhap(items.role.coefficient, items.role.price, items.workshifts).toLocaleString('it-IT', {style: 'currency', currency: 'VND' })}}</td>
                <td>{{tamung(items.prepayment)}}</td>
                <td style="width: 150px">{{thuong(items.workshifts).toLocaleString('it-IT', {style: 'currency', currency: 'VND' })}}</td>
                <td style="width: 150px">{{phat(items.workshifts).toLocaleString('it-IT', {style: 'currency', currency: 'VND' })}}</td>
                <td>{{thuclinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment).toLocaleString('it-IT', { style: 'currency', currency: 'VND'})}}</td>
                <td v-if="items.permission">{{dathanhtoan(items.permission).toLocaleString('it-IT', {style: 'currency', currency: 'VND' })}}</td>
                <td>{{chuathanhtoan(items.permission,items.role.coefficient,items.role.price,items.workshifts, items.prepayment).toLocaleString('it-IT', {style: 'currency', currency: 'VND' })}}</td>
                <td>
                  <el-tooltip v-if=" items.permission != '' && checkLuong(items.permission,items.role.coefficient,items.role.price,items.workshifts, items.prepayment) == 0" effect="light" :content="`Ngày thanh toán: ${items.permission[0].day_pay}`" placement="top">
                    <el-button type="primary" size="mini">Đã lưu</el-button>
                  </el-tooltip>
                  <el-tooltip effect="light" v-else content="Thông tin lương tháng này chưa được lưu" placement="top">
                    <el-button type="danger" @click="onSubmit(items.User_id,items.role.coefficient,items.role.price,items.workshifts, items.prepayment)" size="mini">Chưa lưu</el-button>
                  </el-tooltip>
                </td>
              </tr>
            </tbody>
          </table>
          <el-pagination background @current-change="changePage" :page-size="pagiSize" :current-page="currentPage" layout="prev, pager, next" :total="total" style="text-align:center">
          </el-pagination>
        </div>
        <div>
          <hr>
          <div>
            <h3>Chi tiết lương tháng {{subStrMonth()}} </h3>
            <p><b>Tổng công làm: <i> {{workshifts}} công </i></b> </p>
            <p><b>Tổng công tạm ứng: <i>  {{prepayment}} công </i></b> </p>
            <p><b>Tổng công đã thanh toán: <i>  {{workspay}} công </i></b> </p>
            <p><b>Tổng công chưa thanh toán: <i>  {{workshifts - workspay}} công </i></b> </p>
            <p><b>Tổng tiền đã thanh toán: <i>  {{paydone.toLocaleString('it-IT', { style: 'currency', currency: 'VND'})}} </i></b>  </p>          </div>
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
import thuong from './inputThuong';
import moment from 'moment';
export default {
  components: {
    thuong
  },
  data() {
    return {
      month: '',
      loading: true,
      numWeek: "",
      numYear: "",
      company: 0,
      dataTable: [],
      total: 1,
      currentPage: 1,
      pagiSize: 10,
      workshifts: 0,
      prepayment: 0,
      paydone: 0,
      needPay: 0,
      workspay: 0,
    }
  },
  methods: {
    async thongke() {
      let countWorkshilfts = [];
      let thongke = await axios.post('/api/thongke', {
        time: this.month,
        idComp: this.company
      });
      this.totalWorkshilfts(thongke.data);
      this.totalPrepayment(thongke.data);
      this.totalPermission(thongke.data);
    },

    
    /**
     * Todo total Permission
     * @param $thongke
     * * Response: arr[]
     */
    totalPermission(thongke) {
      let countPermission = [];
      let Permission = thongke.filter((res) => {
        return res.permission != '';
      })
      Permission.forEach(res => {
        res.permission.forEach(r => {
          countPermission.push(r);
        })
      })
      let qtyCong = countPermission.reduce((weight, val, index, column) => {
        return weight += val.qty;
      }, 0);
      this.workspay = qtyCong;
      let number = countPermission.reduce((weight, val, index, column) => {
        return weight += val.Per_total;
      }, 0);
      this.paydone = number;
    },

    /**
     * Todo get total prepayment
     * @param $thongke
     * * Response: arr[]
     */
    totalPrepayment(thongke) {
      let countPrepayment = [];
      let prepayment = thongke.filter((res) => {
        return res.prepayment != '';
      })
      prepayment.forEach(res => {
        res.prepayment.forEach(r => {
          countPrepayment.push(r)
        })
      });
      let number = countPrepayment.reduce((weight, val, index, column) => {
        return weight += val.qtycong;
      }, 0);
      this.prepayment = number;

    },

    /**
     * Todo get total workshilft
     * @param $thongke
     * * Response: arr[]
     */
    totalWorkshilfts(thongke) {
      let countWorkshilfts = [];
      let workshifts = thongke.filter((res) => {
        return res.workshifts != '';
      })
      workshifts.forEach(res => {
        res.workshifts.forEach(r => {
          countWorkshilfts.push(r)
        })
      })
      let numberWorkshilfts = countWorkshilfts.reduce((weight, val, index, column) => {
        return val.formm.FormM_Work > 4 ? weight += 2 : weight += 1;
      }, 0);
      this.workshifts = numberWorkshilfts;
    },

    formatVND(nunber) {
      return number.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
      })
    },
    checkLuong(val, coff, price, works, prepayment){
        return this.chuathanhtoan(val, coff, price, works, prepayment);
    },
    chuathanhtoan(val, coff, price, works, prepayment){
        return this.thuclinh(coff, price, works, prepayment) - this.dathanhtoan(val);
    },
    dathanhtoan(per){
       return per.reduce((wei, val , index, column) => {
         return wei += val.Per_total;
       }, 0);
    },
    thuclinh(coff, price, works, prepayment) {
      return this.thunhap(coff, price, works) - this.tamung(prepayment) * price + this.thuong(works) - this.phat(works);
    },
    thuong(works) {
      return this.workshilfts(works) > 5 ? 100000 : 0;
    },
    phat(works) {
      return this.workshilfts(works) < 5 ? 0 : 0;
    },
    tamung(prepayment) {
      return prepayment.reduce((wei, val, index, column) => {
        return wei += val.qtycong;
      }, 0);
    },
    /**
     * Todo sub string get year in month
     * @param $month | format MM - YYYY
     * * Response: arr[]
     */
    subStrMonth() {
      return this.month.substr(0, 2);
    },
    /**
     * Todo sub string get year in year
     * @param $month | format MM - YYYY
     * * Response: arr[]
     */
    subStrYear() {
      return this.month.substr(5, 4);
    },
    /**
     * Todo submit add luong Nhan vien
     * @param $user_id, $coff, $price, $works, $prepayment
     * * Response: arr[]
     */
    onSubmit(user_id, coff, price, works, prepayment) {
      let thuong = this.thuong(works);
      let phat = this.phat(works);
      let thuclinh = this.thuclinh(coff, price, works, prepayment);
      let day_pay = moment().format("YYYY-MM-DD");
      let month = this.subStrMonth();
      let year = this.subStrYear();
      let qty = this.workshilfts(works);
      let Per_time = year + '-' + month + '-' + '01';
      axios.post('/api/addLuong', {
          bonus: thuong,
          error: phat,
          Per_total: thuclinh,
          day_pay: day_pay,
          User_id: user_id,
          Per_time: Per_time,
          qty: qty
        })
        .then(res => {
          if (res.data.code == 200) {
            this.$message({
              showClose: true,
              message: 'Thông báo, Lưu lương nhân viên thành công',
              type: 'success'
            });
            this.changePage(this.currentPage);
            this.thongke();
          }
        });
    },
    /**
     * Todo get thu nhập
     */
    thunhap(coff, price, works) {
      return coff * price * this.workshilfts(works);
    },
    /**
     * Todo get workshilfts
     */
    workshilfts(val) {
      let works = val.filter((res) => {
        return res.status == 2;
      });
      let number = works.reduce((weight, val, index, column) => {
        return val.formm.FormM_Work > 4 ? weight += 2 : weight += 1;
      }, 0);
      return number;
    },
    /**
     * Todo change page 
     */
    changePage(page) {
      this.currentPage = page;
      this.loadInfomation();
    },
    /**
     * Todo list all employer
     * * Response: arr[]
     */
    changeEmpComp() {
      this.month = this.getTimeNow;
      this.loadInfomation();
      this.thongke();
    },
    /**
     * Todo load infomation employer
     * * Response: arr[]
     */
    async loadInfomation() {
      let val = await axios.post(`/api/listLuongNV/${this.pagiSize}?page=${this.currentPage}`, {
        time: this.month,
        idComp: this.company
      });
      this.dataTable = val.data.data;
      this.total = val.data.total;
    },
    /**
     * Todo list all Luong NV
     * @param $month, $year
     * * Response: arr[]
     */
    async getMonth() {
      if (this.month != null) {
        let val = await axios.post(`/api/listLuongNV/${this.pagiSize}?page=${this.currentPage}`, {
          time: this.month,
          idComp: this.company
        });
        this.dataTable = val.data.data;
        this.total = val.data.total;
        this.thongke();
      } else {
        this.$message({
          showClose: true,
          message: 'Thông báo, Tháng không được để trống.!',
          type: 'error'
        });
      }
    },
  },
  computed: {
    getCompanies() {
      return this.$store.getters.getCompany;
    },
    allCompanies() {
      return this.$store.dispatch("allCompany");
    },
    getTimeNow() {
      return moment().format("MM - YYYY");
    },
  }
}
</script>
