<template>
<div>
  <section class="calendar" id="getLichNv">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div class="title">
            <div class="ttLeff">
              <div class="form-group">
                <button data-toggle="modal" data-target="#AddEmp_Modal" class="btn btn-sm btn-outline-secondary">
                  <i aria-label="icon: user-add" class="anticon anticon-user-add">
                    <svg viewBox="64 64 896 896" focusable="false" class data-icon="user-add" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                      <path d="M678.3 642.4c24.2-13 51.9-20.4 81.4-20.4h.1c3 0 4.4-3.6 2.2-5.6a371.67 371.67 0 0 0-103.7-65.8c-.4-.2-.8-.3-1.2-.5C719.2 505 759.6 431.7 759.6 349c0-137-110.8-248-247.5-248S264.7 212 264.7 349c0 82.7 40.4 156 102.6 201.1-.4.2-.8.3-1.2.5-44.7 18.9-84.8 46-119.3 80.6a373.42 373.42 0 0 0-80.4 119.5A373.6 373.6 0 0 0 137 888.8a8 8 0 0 0 8 8.2h59.9c4.3 0 7.9-3.5 8-7.8 2-77.2 32.9-149.5 87.6-204.3C357 628.2 432.2 597 512.2 597c56.7 0 111.1 15.7 158 45.1a8.1 8.1 0 0 0 8.1.3zM512.2 521c-45.8 0-88.9-17.9-121.4-50.4A171.2 171.2 0 0 1 340.5 349c0-45.9 17.9-89.1 50.3-121.6S466.3 177 512.2 177s88.9 17.9 121.4 50.4A171.2 171.2 0 0 1 683.9 349c0 45.9-17.9 89.1-50.3 121.6C601.1 503.1 558 521 512.2 521zM880 759h-84v-84c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v84h-84c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h84v84c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-84h84c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z" />
                    </svg>
                  </i>
                  Thêm nhân viên
                </button>
                <addModal></addModal>
              </div>
              <div class="form-group flatpickr">
                <input id="datepicker" class="form-control mb-2 date-default flatpickr-input active" v-model="dateValueNow" type="text" placeholder="Chọn ngày" />
              </div>
              <!-- end theo tuần -->
              <!-- chọn công ty -->
              <div class="form-group flatpickr">
                <select v-on:change="changeEmpComp()" v-model="company" class="form-control" id="exampleFormControlSelect1">
                  <option value disabled selected hidden>Chọn chi nhánh</option>
                  <option v-for="items in getCompanies" :key="items.idComp" :value="items.idComp">{{items.nameComp}}</option>
                </select>
              </div>
              <!-- <end công ty -->
            </div>
            <!-- end left -->
            <div class="ttRight">
              <button v-for="item in titleRight" :key="item.id" class="btn btn-sm btn-outline-info">
                <router-link :to="item.link">
                  <span :class="item.icon"></span>
                  {{item.value}}
                </router-link>
              </button>
            </div>
            <!-- end right -->
          </div>
          <!-- end title -->
          <div class="content">
            <div class="ctTitleSearch">
              <div class="titleTableSearch" style="background: #f6f6f6 ; color: #000; border-color: #e3e3e3; border-bottom: 1px solid">
                <div class="name-Search" style="margin: 0 auto;">
                  <span> Ca làm / Buổi </span>
                </div>
              </div>
              <div v-for="item in getNumW" :key="item" class="titleTable">
                <span>{{item}}</span>
              </div>
            </div>
            <div class="ctLists">
              <!-- fulltime/ca sáng/ca chiều -->
              <div class="L_item" v-for="(calam,key) in ChangeCaLam" :key="key">

                <div class="i_name titleTableSearch">
                  <span style="margin: 0 auto">{{calam.form_name}}</span>
                </div>
                <!-- số ngày 7 -->
                <div v-for="(item, dex) in getDatecaLam" :key="dex" class="i_desc titleTable">
                  <!-- button -->
                  <div class="checkElement" v-if="calam.workshifts != '' ">
                    <button role="button" @click="detailsCalam(calam.workshifts, item, calam.form_name, calam.form_id)" class="btn btn-pill btn-outline-success" href="#detail" data-toggle="modal" data-target="#detail">
                      <div class="ElementsWork" v-for="(c1, vk1) in calam.workshifts" :key="vk1">
                        <svg v-if="c1.ws_date === item" style="color:rgb(0,0,0)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                          <circle cx="8.5" cy="7" r="4"></circle>
                          <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                      </div>
                    </button>
                  </div>

                  <button v-else @click="detailsCalam(calam.workshifts, item, calam.form_name, calam.form_id)" href="#detail" data-toggle="modal" data-target="#detail" type="button" class="add_btn">
                    <i aria-label="icon: plus" class="anticon anticon-plus">
                      <svg viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                        <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z" />
                        <path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z" />
                      </svg>
                    </i>
                  </button>
                </div>
              </div>
            </div>
            <!-- Lịch -->
            <detailLich ref="editClam" v-on:diemdanh="diemdanh" v-on:HandelPage=" HandelPage" v-bind:getsInv="infoCaNv" v-on:OpenAdd="OpenAdd" v-bind:detailCa="NameDateCalam">
            </detailLich>
            <!--add addCalamforUser-->
            <addCalamforUser ref="addCalam" v-bind:infoCaLam="NameDateCalam" v-on:HandelPage=" HandelPage">
            </addCalamforUser>

            <!-- điểm danh -->
             <diemdanh ref="diemdanh" v-on:kiemtraCalam="kiemtraCalam" v-on:openPhep="openPhep" v-bind:calam="idCaLam"></diemdanh>
          <!-- checkphep -->
            <checkPhep ref="checkPhep" v-on:openPhep="openPhep"></checkPhep>
          </div>
        </div>
        <!-- nofitication -->
        <div class="notice" style="margin:15px 0;">
          <b style="color: red; font-size: 16px">Ghi chú:</b><span> Chủ cửa hàng hoặc quản lý có thể kiểm tra tình trạng hoặc thêm nhân viên tại đây.</span>
          <ul style="list-style-type:none; padding: 0">
            <li>
              <svg style="color:rgb(0,0,0)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <polyline points="17 11 19 13 23 9"></polyline>
              </svg>
              <span>: Số nhân viên làm việc trong 1 ca</span></li>
          </ul>
        </div>
        <!-- endnofitication -->
        <!-- end list view -->
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->

  </section>
</div>
</template>

<script>
import moment from "moment";
import addModal from "../Calendar/addModal.vue";
import detailLich from "./detailLich";
import addCalamforUser from './addCalamforUser';
import diemdanh from '../diemDanh/diemdanh.vue';
import checkPhep from '../diemDanh/checkPhep';
export default {
  components: {
    detailLich,
    addCalamforUser,
     diemdanh,checkPhep,
     addModal
  },
  data() {
    return {
      idCaLam: {
        ws_date: "",
        user_id: "",
        idComp: ""
      },
      dateValueNow: "",
      numWeek: "",
      numYear: "",
      titleRight: [{
          id: 1,
          icon: "oi oi-spreadsheet",
          value: " Ca làm",
          link: "/Show-Calam"
        },
      ],
      company: "",
      ValueCaLam: [],
      infoCaNv: [],
      NameDateCalam: {
        value: [],
        date: '',
        nameCa: '',
        idCa: '',
        idComp: ''
      }
    };
  },
  created() {
    setInterval(this.getNow, 1000), this.$store.dispatch("allCompany");
    this.getNumWeek();
    this.$store.dispatch("SetNumWeek", [this.numWeek, this.numYear]);
    this.getTimeNow();
    this.$store.dispatch('allCaLam');
    // this.$store.dispatch('SetDateCaLam',[this.numWeek, this.numYear]);

  },
  updated() {

  },
  mounted() {

    //calendar
    flatpickr("#datepicker", {
      locate: "vi",
      weekNumbers: true,
      language: "vi",
      dateFormat: "\\T\\u\\ầ\\n\\: W - Y",
      defaultDate: "today",
      onChange: [
        (dataObj, data, instance) => {
          const weekNumber = instance.selectedDates[0] ?
            instance.config.getWeek(instance.selectedDates[0]) :
            null;
          this.numWeek = weekNumber;
          let year = moment(dataObj[0]).format("YYYY");
          this.numYear = year;
          this.$store.dispatch("SetDateCaLam", [this.numWeek, this.numYear]);
          this.changeEmpComp();
          return this.$store.dispatch("SetNumWeek", [weekNumber, year]);
        }
      ]
    });

  },
  methods: {
    /**
     *  Call Điểm danh 
     *  work_id: work_id
     *  time:  ws_date
     *  response: mở form phép
     */
    openPhep(work_id, time) { 
      this.$refs.checkPhep.getAttendance(work_id, time)
    },
    /**
     *  Call Điểm danh 
     *  val: user_id
     *  work:  idComp
     *  response: gán giá trị -> lấy work_id bằng async để call điểm danh
     */
    async diemdanh(val, work) { 
      this.idCaLam.user_id = val;
      this.idCaLam.idComp = work;
      let workshift = await axios.post('/api/workshilftsByformDateUser',{user_id : val, ws_date: this.NameDateCalam.date, form_id: this.NameDateCalam.idCa });
      this.$refs.diemdanh.nameDate(this.NameDateCalam.idCa, workshift.data.work_id);
      this.$refs.diemdanh.checkPhep(workshift.data.work_id);
      this.$refs.diemdanh.diemDanh(workshift.data.work_id);
    }, 
    //Call addCalamm khi mở btn cộng trong chỉnh sửa
    OpenAdd() {
      this.$refs.addCalam.handleGetEmpByComp();
    },
    /*
     * detail: get time now
     * request: 
     * response: string date
     * */
    getTimeNow() {
      return (this.dateValueNow = `Tuần: ${moment().weeks()} - ${moment().year()}`);
    },
    /*
     * detail: get number week
     * request: 
     * response: int number
     * */
    getNumWeek() {
      this.numYear = moment().year();
      return (this.numWeek = moment().week());
    },

    /*
     * detail: change employer when change choose company orther
     * request: 
     * response: 
     * */
    changeEmpComp() {
      this.loading = true;
      this.$store.dispatch('SetDateCaLam', [this.numWeek, this.numYear]);
      axios.post('/api/getsNgayLvNv', {
        idComp: this.company,
        date: this.getDatecaLam
      }).then(res => {
        this.ValueCaLam = res.data;
        // this.$refs.editClam.getListUser();
      }).catch();
    },

    /*
     * detail: Push workshift -> infoCaLam
     * request: arr [] workshift
     * response: push arr-> this.infoCalamNV
     * */
    detailsCalam(val, date, nameClam, idCa) {
      this.NameDateCalam['value'] = val;
      this.NameDateCalam['date'] = date;
      this.NameDateCalam['nameCa'] = nameClam;
      this.NameDateCalam['idCa'] = idCa;
      this.NameDateCalam['idComp'] = this.company;
      this.idCaLam.ws_date = date; 
      this.$refs.editClam.getClamUser();
    },
    
    kiemtraCalam() {
      this.$refs.editClam.getListUser();
    },
    /*
     * detail: handle when click close form 
     * request: arr [] workshift
     * response: Reload value by added
     * */
    HandelPage() {
      this.changeEmpComp();
      this.$refs.editClam.getListUser();
    },

  },
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany;
    },
    ChangeCaLam() {
      return this.ValueCaLam;
    },
    getNumW() {
      return this.$store.getters.getNumWeek;
    },
    getDatecaLam() {
      return this.$store.getters.getDatecaLam;
    },

  },
};
</script>

<style scoped>
#getLichNv>>>.titleTable:first-child {
  border-left: 1px solid #e3e3e3;
}

#getLichNv>>>.titleTable .btn-dangky {
  border-color: #5b8c85;
  color: #5b8c85;
  width: 100%
}

#getLichNv>>>.titleTableSearch {
  background: #5b8c85;
  border-color: #000;
  color: #fff
}

#getLichNv>>>.titleTable .checkElement {
  width: 100%
}

#getLichNv>>>.titleTable .checkElement .btn-outline-success {
  width: 100%;
  display: block;
  text-align: center;
  border-color: none;
  border: none
}

#getLichNv>>>.titleTable .checkElement .btn-outline-success:hover {
  background: #38c172
}

#getLichNv>>>.titleTable .checkElement .ElementsWork {
  display: inline-block
}
</style>
