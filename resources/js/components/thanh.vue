<template>
<div>
  <section class="calendar">
    <div class="card">
      <div class="card-body">
        <div class="list-view">
          <div class="title">
            <div class="ttLeff"> 
             
              <div class="form-group flatpickr">
                <input id="datepicker" class="form-control mb-2 date-default flatpickr-input active" v-model="dateValueNow" type="text" placeholder="Chọn ngày" />
              </div> 
              <!-- chọn công ty -->
              <div class="form-group flatpickr">
                <select v-on:change="changeEmpComp()" v-model="company" class="form-control" id="exampleFormControlSelect1">
                  <option value disabled selected hidden>Chọn chi nhánh công ty</option>
                  <option v-for="items in getCompanies" :key="items.idComp" :value="items.idComp">{{items.nameComp}}</option>
                </select>
              </div>
              <!-- <end công ty -->
              <el-button type="sucess" @click="getIp()">test</el-button>
            </div>
            <!-- end left -->
             
          </div>
          <!-- end title -->
          <div class="content">
            <div class="ctTitleSearch">
              <div class="titleTableSearch">
                <div class="name-Search">
                  <i aria-label="icon: search" class="anticon anticon-search" style="font-size: 13px; padding-left: 10px; padding-right: 5px;">
                    <svg viewBox="64 64 896 896" focusable="false" class data-icon="search" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                      <path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z" />
                    </svg>
                  </i>
                  <span>
                    <input type="text" name="search" id placeholder="Tìm kiếm" />
                  </span>
                </div>
              </div>
              <div v-for="item in getNumW()" :key="item" class="titleTable">
                <span>{{item}}</span>
              </div>
            </div>
            <div class="ctLists">
             

            </div> 
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
import moment from "moment"; 
export default { 
  data() {
    return {
      dateValueNow: "",
      numWeek: "",
      numYear: "",
      idCaLam: {
        WS_date: "",
        User_id: "",
        idComp: ""
      }, 
      company: "", 
    };
  },
  created() {
    setInterval(this.getNow, 1000), this.$store.dispatch("allCompany");
    this.getNumWeek();
    this.$store.dispatch("SetNumWeek", [this.numWeek, this.numYear]);
    this.getTimeNow();
    // this.$store.dispatch('SetDateCaLam',[this.numWeek, this.numYear]);
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
          this.$store.getters.getCompany;
          return this.$store.dispatch("SetNumWeek", [weekNumber, year]);
        }
      ]
    });
  },
  methods: {
    async getIp(){
        let val = await axios.get('/api/getIp');
        console.log(val);
    },
    //Get time now
    getTimeNow() {
      return (this.dateValueNow = `Tuần: ${moment().weeks()} - ${moment().year()}`);
    },
    // get number week
    getNumWeek() {
      this.numYear = moment().year();
      return (this.numWeek = moment().week());
    },
    getNumW() {
      return this.$store.getters.getNumWeek;
    },
     
    // change employer when change choose company orther
    changeEmpComp() {
      this.loading = true;
      this.$store.dispatch("SetDateCaLam", [this.numWeek, this.numYear]);
      this.$store.dispatch("allEmployerComp", this.company); 
    },   
  },
  computed: { 
    // get all company
    getCompanies() {
      return this.$store.getters.getCompany;
    },
  }, 
};
</script>

