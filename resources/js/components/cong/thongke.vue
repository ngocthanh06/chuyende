<template>
<div>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div style="display: flex; justify-content: center; align-items: flex-end; margin-bottom: 10px" class="title-top">
            <h3>Tháng</h3>
            <div class="block">
              <el-date-picker @change="getMonth()" v-model="month" value-format="MM - yyyy" format="MM - yyyy" type="month" style="margin: 0 10px" placeholder="Chọn tháng phù hợp">
              </el-date-picker>
            </div>
            <el-select @change="chooseChinhanh()" class="col-sm-3" v-model="valueCompany" placeholder="Chọn chi nhánh">
              <el-option label="Tất cả" :value="0">
              </el-option>
              <el-option v-for="(item, key) in options" :key="key" :label="item.nameComp" :value="item.idComp">
              </el-option>
            </el-select>
          </div>
          <!-- end title -->
          <div class="content">
            <div class="ctTitleSearch" style="height: 100px">
              <div class="titleTableSearch">
                <h5 class="name-text">
                  Tên nhân viên
                </h5>
              </div>
              <div class="daysInMonth">
                <div class="daysTitle">
                  <h5>Ngày trong tháng</h5>
                </div>
                <!-- for daysInMonth -->
                <div class="days">
                  <div v-for="(item, key) in daysInMonths" :key="key" class="titleTable">
                    <span>{{item}}</span>
                  </div>
                </div>
                <!-- end for daysInMonth -->
              </div>
              <div class="titleTableSearch" style="flex: 80px; text-align : center">
                <span class="name-text" style="font-weight: bold">
                  Tổng ngày công
                </span>
              </div>
            </div>
            <div class="scroll-Y" id="style-4">
              <!-- for employers -->
              <div class="ctLists" v-for="(items, key) in employers" :key="key">
                <div class="L_item">
                  <div class="i_name titleTableSearch" style="padding: 0">
                    <span class="name-text">{{items.User_fullname}}</span>
                  </div>
                  <div class="daysInMonth">
                    <div class="days" style="height: 100%">
                      <div class="i_desc titleTable" v-for="(day, key) in daysMonth" :key="key">
                        <!-- for get workshifts -->
                        <div class="hidebutton">
                          <el-button href="#checkdiemdanh" data-target="#checkdiemdanh" data-toggle="modal" @click="openChamcong(items, day)" style="border: none">
                            <i class="el-icon-close"></i>
                          </el-button>
                        </div>
                        <!-- end for getWorkshilfts -->
                        <!-- for get workshifts -->
                        <template v-for="(i, k) in items.workshifts">
                          <div :key="k" v-if="i.WS_date == day">
                            <el-tooltip v-if="i.status == 2" class="item" effect="dark" :content="`Ngày: ${i.WS_date} ( Vào: ${i.WS_time_in} - Ra: ${i.WS_time_out} )`" placement="top-start">
                              <div class="hidebutton">
                                <el-button href="#checkdiemdanh" data-target="#checkdiemdanh" data-toggle="modal" @click="openChamcong(items, day)" style="border: none; color: #DC1AFB">
                                  <i class="el-icon-success" style="color:#007bff"></i>
                                </el-button>
                              </div>
                            </el-tooltip>
                            <el-tooltip v-else-if="i.status == 1" class="item" effect="dark" :content="`Ngày: ${i.WS_date} ( Vào: ${i.WS_time_in} - Ra: ${i.WS_time_out} )`" placement="top-start">
                              <div class="hidebutton">
                                <el-button href="#checkdiemdanh" data-target="#checkdiemdanh" data-toggle="modal" @click="openChamcong(items, day)" style="border: none; color: #DC1AFB">
                                  <i class="el-icon-error" style="color: red"></i>
                                </el-button>
                              </div>
                            </el-tooltip>
                            <el-tooltip v-else class="item" effect="dark" :content="`Ngày: ${i.WS_date} ( Vào: ${i.WS_time_in} - Ra: ${i.WS_time_out} )`" placement="top-start">
                              <div class="hidebutton">
                                <el-button href="#checkdiemdanh" data-target="#checkdiemdanh" data-toggle="modal" @click="openChamcong(items, day)" style="border: none; color: #DC1AFB">
                                  <i class="el-icon-warning"></i>
                                </el-button>
                              </div>
                            </el-tooltip>
                          </div>
                        </template>
                        <!-- end for getWorkshilfts -->
                      </div>
                    </div>
                  </div>
                  <div class="i_name titleTableSearch" style="padding: 0; flex: 80px; text-align : center">
                    <span class="name-text">{{numTotal(items.workshifts)}}</span>
                  </div>
                </div>
                <!-- end for -->
              </div>
            </div>
          </div>
        </div>

        <!-- notication -->
        <div class="notice row" style="margin: 15px 0px;">
          <div class="notice-left col-sm-9">
            <b style="color: red; font-size: 16px;">Ghi chú:</b><span> Ký hiệu chấm công.</span>
            <ul style="list-style-type: none; padding: 0px;">
              <li><span style="color: red">Ca làm fulltime được tính là 2 công</span></li>
              <li><span>- <i class="el-icon-close"></i>: Ca làm đăng ký trống</span></li>
              <li><span>- <i class="el-icon-success" style="color:#007bff"></i>: Có đi làm</span></li>
              <li><span>- <i class="el-icon-error" style="color: red"></i>: Không đi làm </span></li>
              <li><span>- <i class="el-icon-warning" style="color: #DC1AFB"></i>: Chưa điểm danh</span></li>
            </ul>
          </div>
          <div class="notice-right col-sm-3">
            <h5 style="text-decoration: underline;">Tổng Cộng: </h5>
            <h5>
              {{totalSum}} Công
            </h5>

          </div>
        </div>
        <!-- end notication -->
        <checkdiemdanh ref="checkdd" v-on:getMonth="getMonth" v-on:diemdanh="diemdanh" v-bind:calam="calam"></checkdiemdanh>
        <!-- diemdanh -->
        <diemdanhs ref="diemdanhs" v-on:EditCaLam="EditCaLam" v-bind:calam="calam" v-on:openPhep="openPhep"></diemdanhs>
        <!-- checkphep -->
        <checkPheps ref="checkPheps" v-on:openPhep="openPhep"></checkPheps>
        <!-- end list view -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </section>
</div>
</template>

<script>
import checkdiemdanh from './checkdiemdanh';
import checkPheps from '../diemDanh/checkPhep';
import diemdanhs from '../diemDanh/diemdanh.vue';
import moment from 'moment';
export default {
  components: {
    checkdiemdanh,
    checkPheps,
    diemdanhs,
  },
  mounted() {
    this.month = this.getDateNow;
    this.getMonth();
  },
  data() {
    return {
      calam: {
        User_id: '',
        WS_date: '',
        idComp: ""
      },
      options: [],
      valueCompany: 0,
      month: '',
      daysInMonths: [],
      daysMonth: [],
      employers: [],
      totalSum: 0,
    }
  },
  methods: {
    loadVal() {
      this.getCompany();
      this.totalCong();
    },
    /**
     * Todo show total calam
     * @param val: => arr[] workshilfts
     */
    numTotal(val) {
      let value = val.filter((res) => {
        return res.status == 2;
      })
      let number = value.reduce((weight, val, index, column) => {
        return val.formm.FormM_Work > 4 ? weight += 2 : weight += 1;
      }, 0)
      return number;
    },
    // Sửa ca làm cho nhân viên khi truyền xuống modelCalam
    EditCaLam(valueID, date) {
      this.calam["User_id"] = valueID;
      this.calam["WS_date"] = date;
      this.$refs.checkdd.getCaLamUser();
      this.$store.dispatch("allCaLam");
    },
    //Call diemdanh 
    //val : id form
    //work : work_id
    //status : 
    diemdanh(val, work, status) {
      this.$refs.diemdanhs.nameDate(val, work);
      this.$refs.diemdanhs.checkPhep(work);
      this.$refs.diemdanhs.diemDanh(work);
    },
    /**
     *  Todo Call Điểm danh 
     *  @param work_id: Work_id
     *  @param time:  WS_date
     *  * response: mở form phép
     */
    openPhep(work_id, time) {
      this.$refs.checkPheps.getAttendance(work_id, time)
      this.$refs.diemdanhs.checkPhep(work_id);
    },
    /**
     * Todo open modal chamcong
     * @param val: => arr[] user(employer)
     * day : work_id
     */
    openChamcong(val, day) {
      this.calam.User_id = val.User_id;
      this.calam.WS_date = day;
      this.$refs.checkdd.getCaLamUser();
    },
    /**
     * Todo when click month
     */
    getMonth() {
      if(this.month != null){
        this.daysInMonths = this.handleDaysinMonth;
        this.daysMonth = this.handleChecvaluekMonth;
        this.chooseChinhanh();
        // this.totalCong();
      }
      else{
        this.$message({
          showClose: true,
          message: 'Thông báo, Tháng không được để trống.!',
          type: 'error'
        });
      }
    },
    /**
     * Todo choose chi nhanh
     * * Response => arr list Employer in Company
     */
    async chooseChinhanh() {
      let val = await axios.post('/api/getCongNv', {
        idComp: this.valueCompany,
        date: this.month
      });
      this.employers = val.data;
      this.totalCong();
    },
    async totalCong() {
      let countWorkshilfts = [];
      let value = await axios.post('/api/totalCong', {
        date: this.month,
        idComp: this.valueCompany,
      });
      let workshiftsNotNull = value.data.filter((res) => {
        return res.workshifts != ''
      });
      workshiftsNotNull.forEach(res => {
        res.workshifts.forEach(r => {
          countWorkshilfts.push(r);
        })
      });
      let number = countWorkshilfts.reduce((weight, val, index, column) => {
        return val.formm.FormM_Work > 4 ? weight += 2 : weight += 1;
      }, 0);
      this.totalSum = number;
    },
    /**
     * Todo get list company
     */
    async getCompany() {
      let value = await axios.get('/api/company');
      this.options = value.data;
    },
  },
  computed: {

    /**
     * Todo get date time now
     */
    getDateNow() {
      return moment().format('MM - YYYY');
    },
    /**
     * Todo get number on month
     */
    countDaysMonth() {
      return moment(this.month, "MM-YYYY").daysInMonth();
    },
    /**
     * Todo get list day in month format dd
     */
    handleDaysinMonth() {
      var daysInMonth = [];
      var num = 1;
      while (num <= this.countDaysMonth) {
        var current = moment(this.month, "MM-YYYY").date(num);
        daysInMonth.push(current.format("DD"));
        num++;
      }
      return daysInMonth;
    },
    /**
     * Todo get list day in month format yyyy-mm-dd
     */
    handleChecvaluekMonth() {
      var daysInMonth = [];
      var num = 1;
      while (num <= this.countDaysMonth) {
        var current = moment(this.month, "MM-YYYY").date(num);
        daysInMonth.push(current.format("YYYY-MM-DD"));
        num++;
      }
      return daysInMonth;
    }
  },
}
</script>

<style lang="scss">
.notice-right {
  display: flex;
  justify-content: space-around;
}

.scroll-Y::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px #e3e3e3;
  background-color: #e3e3e3;
}

.scroll-Y::-webkit-scrollbar {
  width: 5px;
  background-color: #e3e3e3;
}

.scroll-Y::-webkit-scrollbar-thumb {
  background-color: #e3e3e3;
  border: 2px solid #555555;
}

.name-text {
  text-align: center;
  margin: 0 auto;
}

.scroll-Y {
  height: 300px;
  overflow: auto;
  overflow-y: overlay;
}

.daysInMonth {
  width: 100%;

  .daysTitle {
    border-top: 1px solid #e3e3e3;
    text-align: center;
    height: 50%;

    h5 {
      line-height: 50px;
    }
  }

  ;

  .days {
    display: flex;
    height: 50%;
  }
}
</style>
