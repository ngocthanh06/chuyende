<template>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
            <h3>Bảng lương tháng</h3>
            <div class="block">
              <el-date-picker 
                @change="getMonth()" 
                v-model="month" 
                value-format="MM - yyyy" 
                format="MM - yyyy" 
                type="month" 
                style="margin: 0 10px" 
                placeholder="Chọn tháng phù hợp"
              >
              </el-date-picker>
            </div>
          </div>
          <div class="content" style="overflow-x: overlay">
            <table v-loading="loading"  class="table table-dark table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Họ Tên </th>
                  <th>Chức vụ</th>
                  <th>Hệ số</th>
                  <th>Lương/ca</th>
                  <th>Số công làm</th>
                  <th>Công tạm ứng</th>
                  <th>Thưởng</th>
                  <th>Phạt</th>
                  <th>Lương chính</th>
                  <th>Bảo hiểm</th>
                  <th>Lương đóng BH</th>
                  <th>Trích BH(10,5%)</th>
                  <th>Thực lĩnh</th>
                  <th>Đã thanh toán</th>
                  <th>Chưa thanh toán</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(items, key) in dataTable" :key="key" class="table-primary" style="color: #000">
                  <td> {{ key +1 }} </td>
                  <td> {{ items.user_fullname }} </td>
                  <td> {{ items.role.role_name }} </td>
                  <td> {{ items.role.coefficient }} </td>
                  <td> {{ items.role.price | formatMoney }} </td>
                  <td> {{ thunhap(items.role.coefficient, items.role.price, items.workshifts) | formatMoney }} </td>
                  <td> {{ tamung(items.prepayment) }} </td>
                  <td style="width: 150px"> {{ thuong(items.workshifts) | formatMoney }} </td>
                  <td style="width: 150px"> {{ phat(items.workshifts) | formatMoney }} </td>
                  <td> {{ luongchinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment) | formatMoney }} </td>
                  <td v-if="items.socical_insurance == 1">Có</td>
                  <td v-else>Không</td>
                  <td v-if="items.socical_insurance == 1">
                    {{ luongchinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment) | formatMoney }}
                  </td>
                  <td v-else></td>
                  <td v-if="items.socical_insurance == 1">
                    {{ BHXH(luongchinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment)) | formatMoney }}
                  </td>
                  <td v-else></td>
                  <td v-if="items.permission"> {{ dathanhtoan(items.permission) | formatMoney }} </td>
                  <td v-else></td>
                  <td> {{ (luongchinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment) - BHXH(luongchinh(items.role.coefficient,items.role.price,items.workshifts, items.prepayment))) | formatMoney }} </td>
                  <td> {{ chuathanhtoan(items.permission,items.role.coefficient,items.role.price,items.workshifts, items.prepayment) | formatMoney }} </td>
                  <td>
                    <el-tooltip v-if="items.permission != ''" effect="light" :content="`Ngày thanh toán: ${items.permission[0].day_pay}`" placement="top">
                      <el-button type="primary" size="mini">Đã lưu</el-button>
                    </el-tooltip>
                    <el-tooltip effect="light" v-else-if="items.permission == '' && currentUser.role_id == 2" content="Thông tin lương tháng này chưa được lưu" placement="top">
                      <el-button type="danger" @click="onSubmit(items.user_id,items.role.coefficient,items.role.price,items.workshifts, items.prepayment)" size="mini">Chưa lưu</el-button>
                    </el-tooltip>
                    <el-tooltip effect="light" v-else-if="items.permission == '' && currentUser.role_id == 1" content="Thông tin lương tháng này chưa được lưu" placement="top">
                      <el-button type="danger" size="mini">Chưa lưu</el-button>
                    </el-tooltip>
                  </td>
                </tr>
              </tbody>
            </table>
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
import { timeWorkStatus, requestStatus } from '../../config/constant.js';
import config from '../../config';

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
    }
  },

  methods: {
     BHXH(val) {
      return val * config.BHXH;
    },

    checkLuong(val, coff, price, works, prepayment){
        return this.chuathanhtoan(val, coff, price, works, prepayment);
    },

    chuathanhtoan(val, coff, price, works, prepayment){
        return this.luongchinh(coff, price, works, prepayment) - this.BHXH(this.luongchinh(coff, price, works, prepayment)) - this.dathanhtoan(val);
    },

    dathanhtoan(per){
       return per.reduce((wei, val) => {
         return wei += val.per_total;
       }, 0);
    },

    luongchinh(coff, price, works, prepayment) {
      return this.thunhap(coff, price, works) - this.tamung(prepayment) * price + this.thuong(works) - this.phat(works);
    },

    thuong(works) {
      return this.workshilfts(works) > timeWorkStatus.time_bonus ? config.bonus : 0;
    },

    phat(works) {
      return this.workshilfts(works) < timeWorkStatus.time_bonus ? config.penalize : 0;
    },

    tamung(prepayment) {
      return prepayment.reduce((wei, val) => {
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
      let luongchinh = this.luongchinh(coff, price, works, prepayment);
      let day_pay = moment().format("YYYY-MM-DD");
      let month = this.subStrMonth();
      let year = this.subStrYear();
      let qty = this.workshilfts(works);
      let per_time = year + '-' + month + '-' + '01';

      axios.post('/api/addLuong', {
          bonus: thuong,
          error: phat,
          per_total: luongchinh,
          day_pay: day_pay,
          user_id: user_id,
          per_time: per_time,
          qty: qty
        })
        .then(res => {
          if (res.data.code == requestStatus.success) {
            this.$message({
              showClose: true,
              message: 'Thông báo, Lưu lương nhân viên thành công',
              type: 'success'
            });

            this.loadInfomation();
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

      let number = works.reduce((weight, val) => {
        return val.formm.form_work > timeWorkStatus.part_time ? weight += 2 : weight += 1;
      }, 0);

      return number;
    },

    /**
     * Todo list all employer
     * * Response: arr[]
     */
    changeEmpComp() {
      this.month = this.getTimeNow;
      this.loadInfomation();
    },

    /**
     * Todo load infomation employer
     * * Response: arr[]
     */
    async loadInfomation() {
      let user_id = '';

      if (!this.$route.params.id) {
        user_id = this.currentUser.user_id;
      } else {
        user_id = this.$route.params.id;
      } 

      let val = await axios.post(`/api/luongNV`, {
        time: this.month,
        user_id: user_id
      });

      this.loading = false;
      this.dataTable = val.data;
    },

    /**
     * Todo list all Luong NV
     * @param $month, $year
     * * Response: arr[]
     */
    async getMonth() {
      if (this.month != null) {
        this.loadInfomation();
      } else {
        this.$message({
          showClose: true,
          message: 'Thông báo, Tháng không được để trống.!',
          type: 'error'
        });

        this.loading=true;
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

    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
}
</script>
