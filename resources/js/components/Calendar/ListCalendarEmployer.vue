<template>
<div>
  <section id="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div class="title">
            <div class="ttLeff">
              <div class="form-group">
                <button data-toggle="modal" data-target="#AddEmp_Modal" class="btn btn-sm btn-outline-secondary">
                  <i aria-label="icon: user-add" class="anticon anticon-user-add"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="user-add" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                      <path d="M678.3 642.4c24.2-13 51.9-20.4 81.4-20.4h.1c3 0 4.4-3.6 2.2-5.6a371.67 371.67 0 0 0-103.7-65.8c-.4-.2-.8-.3-1.2-.5C719.2 505 759.6 431.7 759.6 349c0-137-110.8-248-247.5-248S264.7 212 264.7 349c0 82.7 40.4 156 102.6 201.1-.4.2-.8.3-1.2.5-44.7 18.9-84.8 46-119.3 80.6a373.42 373.42 0 0 0-80.4 119.5A373.6 373.6 0 0 0 137 888.8a8 8 0 0 0 8 8.2h59.9c4.3 0 7.9-3.5 8-7.8 2-77.2 32.9-149.5 87.6-204.3C357 628.2 432.2 597 512.2 597c56.7 0 111.1 15.7 158 45.1a8.1 8.1 0 0 0 8.1.3zM512.2 521c-45.8 0-88.9-17.9-121.4-50.4A171.2 171.2 0 0 1 340.5 349c0-45.9 17.9-89.1 50.3-121.6S466.3 177 512.2 177s88.9 17.9 121.4 50.4A171.2 171.2 0 0 1 683.9 349c0 45.9-17.9 89.1-50.3 121.6C601.1 503.1 558 521 512.2 521zM880 759h-84v-84c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v84h-84c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h84v84c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-84h84c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z"></path>
                    </svg></i>
                  Thêm nhân viên
                </button>
                <addModal></addModal>
              </div>
              <div class="form-group flatpickr">
                <input id="datepicker" class="form-control mb-2 date-default flatpickr-input active" v-model="dateValueNow" type="text" placeholder="Chọn ngày">
              </div>
              <!-- Theo tuần -->
              <div class="form-group flatpickr">
                <select class="form-control" id="exampleFormControlSelect1">
                  <option v-for="item in Option" :key="item.id" :value="item.id">{{item.value}}</option>
                </select>
              </div>
              <!-- end theo tuần -->
              <!-- chọn công ty -->
              <div class="form-group flatpickr">
                <select v-on:change="changeEmpComp()" v-model="company" class="form-control" id="exampleFormControlSelect1">
                  <option value="" disabled selected hidden>Chọn chi nhánh công ty</option>
                  <option v-for="items in getCompanies" :key="items.idComp" :value="items.idComp">{{items.nameComp}}</option>
                </select>
              </div>
              <!-- <end công ty -->
            </div>
            <!-- end left -->
            <div class="ttRight">
              <button v-for="item in titleRight" :key="item.id" class="btn btn-sm btn-outline-info">
                <router-link :to="item.link"><span :class="item.icon"></span>{{item.value}}</router-link>
              </button>
            </div>
            <!-- end right -->
          </div>
          <!-- end title -->
          <div class="content">
            <div class="ctTitleSearch">
              <div class="titleTableSearch">
                <div class="name-Search">
                  <i aria-label="icon: search" class="anticon anticon-search" style="font-size: 13px; padding-left: 10px; padding-right: 5px;"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="search" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                      <path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z"></path>
                    </svg></i>
                  <span>
                    <input type="text" name="search" id="" placeholder="Tìm kiếm">
                  </span>
                </div>
              </div>
              <div v-for="item in getNumW()" :key="item" class="titleTable">
                <span>{{item}}</span>
              </div>
            </div>
            <div class="ctLists">
              <div v-for="(item, index) in getEmpCom()" :key="index" class="L_item">
                <div class="i_name titleTableSearch">
                  <a class="logo" href="#">
                    <img src="https://chat.tanca.io:3001/avatar/+84783449848">
                  </a>
                  <span>{{item.User_fullname}}</span>
                </div>
                <!-- THời gian ca làm (7) -->
                <div v-for="val in ChangeCaLam()" :key="val" class="i_desc titleTable">
                  <!-- giá trị ca làm mỗi nhân viên -->
                  <div v-for="(value, index) in ValueCaLam" :key="index" v-if="value != null">
                    <!-- thêm modal ca làm -->
                    <div class="hidebutton" v-if="val === value.WS_date && item.User_id === value.User_id">
                      <button href="#EditModal" data-toggle="modal" data-target="#EditModal" role="button" v-on:click="EditCaLam(item.User_id, val)" class="btn btn-pill btn-outline-success">Đã đăng ký</button>
                    </div>
                  </div>
                  <button v-on:click="setCaLam(item.User_id, val)" data-toggle="modal" data-target="#myModal" type="button" class="add_btn">
                    <i aria-label="icon: plus" class="anticon anticon-plus"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                        <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path>
                        <path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path>
                      </svg></i>
                  </button>
                </div>
              </div>

            </div>
            <!-- Add CaLam -->
            <modelCalam v-bind:getCaLamProp="getCaLam" v-bind:calam="idCaLam" v-on:HandelPage=" HandelPage"></modelCalam>
            <!-- Edit Calam -->
            <EditModal ref="editCalam" v-bind:getCaLamProp="getCaLam" v-bind:calam="idCaLam" v-on:HandelPage="HandelPage" v-on:OpenAdd="OpenAdd"></EditModal>
            <!-- addOnEdit -->
            <addchildModel ref="addCalam" v-bind:getCaLamProp="getCaLam" v-bind:calam="idCaLam" v-on:HandelPage=" HandelPage"></addchildModel>
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
import addModal from './addModal.vue';
import EditModal from './EditModalCalam.vue';
import modelCalam from './modelCalam.vue';
import moment from 'moment';
import addchildModel from './addChildCalam.vue';
export default {
  components: {
    addModal,
    modelCalam,
    EditModal,
    addchildModel
  },
  data() {
    return {
      dateValueNow: '',
      numWeek: '',
      numYear: '',
      idCaLam: {
        WS_date: '',
        User_id: '',
        idComp: ''
      },
      Option: [{
          id: 1,
          value: 'Theo tuần'
        },
        {
          id: 2,
          value: 'Theo tháng'
        },
      ],
      titleRight: [{
          id: 1,
          icon: 'oi oi-spreadsheet',
          value: ' Ca làm',
          link: '/Show-Calam'
        },
        {
          id: 2,
          icon: 'oi oi-layers',
          value: ' Xếp ca',
          link: ''
        },
        {
          id: 3,
          icon: 'oi oi-timer',
          value: ' Vào/ra',
          link: ''
        },
        {
          id: 4,
          icon: 'oi oi-data-transfer-download',
          value: ' Xuất Excel',
          link: ''
        },
      ],
      company: '',
      ValueCaLam: [],
    }
  },
  created() {
    setInterval(this.getNow, 1000),
      this.$store.dispatch('allCompany');
    this.getNumWeek();
    this.$store.dispatch('SetNumWeek', [this.numWeek, this.numYear]);
    this.getTimeNow();
    // this.$store.dispatch('SetDateCaLam',[this.numWeek, this.numYear]);
  },
  mounted() {
    //calendar
    flatpickr('#datepicker', {
      'locate': 'vi',
      weekNumbers: true,
      language: 'vi',
      dateFormat: "\\T\\u\\ầ\\n\\: W - Y",
      defaultDate: 'today',
      "onChange": [
        (dataObj, data, instance) => {
          const weekNumber = instance.selectedDates[0] ?
            instance.config.getWeek(instance.selectedDates[0]) :
            null;
          this.numWeek = weekNumber;
          let year = moment(dataObj[0]).format('YYYY');
          this.numYear = year;
          this.$store.dispatch('SetDateCaLam', [this.numWeek, this.numYear]);
          this.setVal();
          return this.$store.dispatch('SetNumWeek', [weekNumber, year]);
        }
      ]
    });
  },
  methods: {
    //Get time now 
    getTimeNow() {
      return this.dateValueNow = `Tuần: ${moment().weeks()} - ${moment().year()}`
    },
    // get number week
    getNumWeek() {
      this.numYear = moment().year();
      return this.numWeek = moment().week();
    },
    getNumW() {
      return this.$store.getters.getNumWeek
    },
    // get employer in company
    getEmpCom() {
      return this.$store.getters.getEmployerComp;
    },
    // change employer when change choose company orther
    changeEmpComp() {
      this.loading = true;
      this.$store.dispatch('SetDateCaLam', [this.numWeek, this.numYear]);
      this.$store.dispatch('allEmployerComp', this.company);
      this.setVal();
    },
    hamAxios(companyId) {
      console.log(companyId);
      // code
      // em gọi axios chỗ này ne, em mún truyền cái gì vào cũng đc hết
    },
    ChangeCaLam() {
      return this.$store.getters.getDatecaLam;
    },
    // thêm ca làm cho nhân viên khi truyền xuống modelCalam 
    setCaLam(valueID, date) {
      this.idCaLam['User_id'] = valueID;
      this.idCaLam['WS_date'] = date;
      this.idCaLam['idComp'] = this.company;
      this.$store.dispatch('allCaLam');
    },
    // Sửa ca làm cho nhân viên khi truyền xuống modelCalam 
    EditCaLam(valueID, date) {
      this.idCaLam['User_id'] = valueID;
      this.idCaLam['WS_date'] = date;
      this.idCaLam['idComp'] = this.company;
      this.$refs.editCalam.getCaLamUser();
      this.$store.dispatch('allCaLam');
    },
    //ca làm đã đăng ký
    setVal() {
      let count = 0;
      let date = [];
      axios.post('/api/countCaLam', {
        id: this.company,
        date: this.$store.getters.getDatecaLam
      }).then(res => {
        res.data.forEach(
          val => {
            val.forEach(
              va => {
                date[count] = va;
                count++;
              }
            )
          }
        )
        return this.ValueCaLam = date
      })
    },
    //xử lý khi đóng thêm ca làm sẽ load lại
    HandelPage() {
      this.changeEmpComp();
      this.$refs.editCalam.getCaLamUser();
    },
    //Call addCalamm khi mở btn cộng trong chỉnh sửa
    OpenAdd() {
      this.$refs.addCalam.getCaLamUser();
    }
  },
  computed: {
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany
    },
    getCaLam() {
      return this.$store.getters.getCaLam;
    },
  },
  watch: {
    // company(newVal, oldVal) {
    //     console.log(newVal, oldVal)
    //     if(newVal) {
    //         this.changeEmpComp();
    //         this.hamAxios(newVal);
    //     }
    // },
  }
}
</script>

<style lang="scss">
#calendar {
  .card-body {
    flex: 1 1 auto;
    padding: 1.92rem 2.3rem;

    .list-view {
      height: 100%;
      display: flex;
      flex-direction: column;

      .title {
        display: flex;
        margin-bottom: 10px;
        -ms-flex-pack: justify !important;
        margin-left: -0.5rem;
        justify-content: space-between !important;

        .ttLeff {
          .form-group {
            float: left;
            margin: 0 0.5rem 0.5rem 0.5rem;
          }

          .flatpickr {
            position: relative;
            height: 28px;
            cursor: pointer;

            #datepicker {
              background: #ffffff !important;
              height: 100%;
            }
          }
        }

        .ttRight {
          button {
            margin: 0 5px
          }
        }
      }

      // end title
      .content {

        .ctTitleSearch,
        .L_item {
          height: 50px;
          overflow: hidden;
          display: flex;

          .titleTableSearch {
            flex: 0 1 200px;
            border: 1px solid #e3e3e3;
            margin: 0 !important;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 100%;

            input {
              border: none;
              outline: none
            }
          }

          .titleTable {
            flex: 1 1 10px;
            border-width: 1px 1px 1px 0;
            border-style: solid;
            border-color: #e3e3e3;
            margin: 0 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f6f6f6;
          }
        }

        .ctLists {

          .i_desc,
          .i_name {
            background-color: #ffffff;
            border-top: none;
            padding: 0 10px;

            button {
              color: rgba(0, 0, 0, .65);
              background-color: #fff;
              border-color: #e4e9f0;
              border-style: dashed;
              align-self: center;
              border-width: 2px;
              border-color: #e3e3e3;
              color: #e3e3e3;
              padding: 0;
              display: flex;
              justify-content: center;
              align-content: center;
              width: 50%;
            }

            .logo {
              margin-right: 5px;
              width: 24px;
              height: 24px;
              line-height: 24px;
              border-radius: 50%;

              img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
              }
            }
          }

          .titleTable {
            width: 100%;
            display: flex !important;
            position: relative;

            .hidebutton {
              width: 100%;
              position: absolute;
              top: 0;
              left: 0;
              bottom: 0;
              text-align: center;
              padding: 5px;
              line-height: 21px;
              background: #ffffff;
              display: flex;
              justify-content: center;
              align-items: center;

              button {
                width: 100%;
                border: 1px solid #28a745;
                color: #28a745
              }
            }
          }
        }
      }

      // end content
    }
  }
}

.flatpickr-monthDropdown-months {
  background: transparent;
  border: none;
  border-radius: 0;
  box-sizing: border-box;
  color: inherit;
  cursor: pointer;
  font-size: inherit;
  font-family: inherit;
  font-weight: 900;
  height: auto;
  line-height: inherit;
  margin: -1px 0 0 0;
  outline: none;
  padding: 0 0 0 0.5ch;
  position: relative;
  vertical-align: initial;
  -webkit-box-sizing: border-box;
  -webkit-appearance: menulist;
  -moz-appearance: menulist;
  width: auto;
}

.flatpickr-weekdaycontainer,
#exampleFormControlSelect1 {
  display: flex;
  height: 100%;
  width: 100%;
  align-items: center;
  margin-top: 10px;

  span {
    color: #000 !important;
  }
}

#exampleFormControlSelect1 {
  margin: 0;
  padding: 0 10px
}

.flatpickr-weekwrapper .flatpickr-weekday {
  position: relative;
  top: 5px;
  color: #000 !important;
}

.flatpickr-calendar {
  top: 212.719px !important;
}

.flatpickr-current-month input.cur-year {
  font-weight: 900;
}
</style>
