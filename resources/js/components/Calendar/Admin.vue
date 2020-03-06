<template>
    <div>
        <section id="calendar">
            <div class="card">
               <div class="card-body">
                   <div class="list-view">
                        <div class="title">
                            <div class="ttLeff">                                                                                            
                                <div  class="form-group flatpickr">
                                    <input id="datepicker" class="form-control mb-2 date-default flatpickr-input active" v-model="dateValueNow"  type="text" placeholder="Chọn ngày">
                                </div>
                                <!-- Theo tuần -->
                                <div class="form-group flatpickr">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option v-for="item in Option" :key="item.id" :value="item.id">{{item.value}}</option>
                                    </select>
                                </div>
                                <!-- end theo tuần --> 
                            </div>
                            <!-- end left -->
                            <div class="ttRight">
                                <button v-for="item in titleRight" :key="item.id" class="btn btn-sm btn-outline-info"><router-link :to="item.link" ><span :class="item.icon"></span>{{item.value}}</router-link></button>
                            </div>
                            <!-- end right -->
                        </div>
                        <!-- end title -->
                        <div class="content">
                                <div class="ctTitleSearch">
                                    <div class="titleTableSearch">
                                        <div class="name-Search">
                                            <i aria-label="icon: search" class="anticon anticon-search" style="font-size: 13px; padding-left: 10px; padding-right: 5px;"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="search" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z"></path></svg></i>
                                            <span>
                                                <input type="text" name="search" id="" placeholder="Tìm kiếm">
                                            </span>
                                        </div>
                                    </div>
                                    <div v-for="item in getNumW()" :key="item" class="titleTable">
                                        <span >{{item}}</span>
                                    </div>
                                </div>
                                <div class="ctLists">
                                    <div class="L_item">
                                        <div class="i_name titleTableSearch">
                                            <a class="logo" href="#">
                                                <img src="https://chat.tanca.io:3001/avatar/+84783449848">
                                            </a>
                                            <span>{{currentUser.User_fullname}}</span>
                                        </div>
                                        <!-- THời gian ca làm (7) -->
                                        <div v-for="val in ChangeCaLam" :key="val" class="i_desc titleTable">
                                            <!-- giá trị ca làm mỗi nhân viên -->
                                            <div v-for="(value, index) in ValueCaLam" :key ="index" v-if="value != null"  >
                                                <!-- thêm modal ca làm --> 
                                                    <div class="hidebutton" v-if="val === value.WS_date && currentUser.User_id === value.User_id"> 
                                                        <button href="#EditModal" data-toggle="modal" data-target="#EditModal" role="button" v-on:click="EditCaLam(currentUser.User_id, val)" class="btn btn-pill btn-outline-success">Đã đăng ký</button>
                                                    </div> 
                                            </div>
                                            <button v-on:click ="setCaLam(currentUser.User_id, val)" data-toggle="modal" data-target="#myModal" type="button" class="add_btn">
                                                          <i aria-label="icon: plus" class="anticon anticon-plus"><svg viewBox="64 64 896 896" focusable="false" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path></svg></i>           
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- Add CaLam -->
                                <modelCalam  v-bind:getCaLamProp ="getCaLam" v-bind:calam ="idCaLam" v-on:HandelPage =" HandelPage" ></modelCalam>
                                <!-- Edit Calam -->
                                <EditModal ref="editCalam" v-bind:getCaLamProp ="getCaLam" v-bind:calam ="idCaLam" v-on:HandelPage ="HandelPage" v-on:OpenAdd="OpenAdd" ></EditModal>
                                <!-- addOnEdit -->
                                <addchildModel ref="addCalam" v-bind:getCaLamProp ="getCaLam" v-bind:calam ="idCaLam" v-on:HandelPage =" HandelPage"></addchildModel>
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
        addModal, modelCalam,EditModal ,addchildModel
    },
    data(){
        return {
            dateValueNow:'',  numWeek : '', numYear: '',
            idCaLam: { WS_date: '', User_id: '',  idComp : '' },
            Option : [
                {id : 1, value : 'Theo tuần'},
                {id : 2, value : 'Theo tháng'},
            ],
            titleRight: [
                {id : 1, icon: 'oi oi-spreadsheet', value : ' Ca làm', link: ''},
                {id : 2, icon: 'oi oi-layers', value : ' Xếp ca', link: ''},
                {id : 3, icon: 'oi oi-timer', value : ' Vào/ra', link: ''},
                {id : 4, icon: 'oi oi-data-transfer-download', value : ' Xuất Excel',link: ''},
            ], 
            ValueCaLam: [],
        }
    },
    created(){
        setInterval(this.getNow,1000), 
        this.getNumWeek();
        this.$store.dispatch('SetNumWeek',[this.numWeek, this.numYear]);
        this.getTimeNow(); 
        this.getWeekUserWorked();
                    
    },
    mounted(){
        //calendar
        flatpickr('#datepicker',{
            'locate' : 'vi',
            weekNumbers : true,
            language: 'vi',
            dateFormat: "\\T\\u\\ầ\\n\\: W - Y",
            defaultDate: 'today',
            "onChange": [
                (dataObj,data,instance) => {
                    const weekNumber = instance.selectedDates[0]
                        ? instance.config.getWeek(instance.selectedDates[0])
                        : null;
                    this.numWeek = weekNumber;
                    let year = moment(dataObj[0]).format('YYYY');
                    this.numYear = year;
                    this.getWeekUserWorked();
                    return this.$store.dispatch('SetNumWeek',[weekNumber,year]);
                }
            ]
        });
    },
    methods: {
        //Get time now 
        getTimeNow(){
            return this.dateValueNow = `Tuần: ${moment().weeks()} - ${moment().year()}`
        },
        // get number week
        getNumWeek(){
            this.numYear = moment().year();
            return this.numWeek = moment().week();
        },
        // get number week
        getNumW(){
            return this.$store.getters.getNumWeek
        },
        // get employer in company
        getEmpCom(){
            return this.$store.getters.getEmployerComp;
        }, 
        // lấy ngày hiện tại và ngày công khi load trang
        getWeekUserWorked(){
            this.$store.dispatch('SetDateCaLam',[this.numWeek, this.numYear]);
            this.setVal();
        },
        // thêm ca làm cho nhân viên khi truyền xuống modelCalam 
        setCaLam(valueID, date){
            this.idCaLam['User_id'] = valueID;
            this.idCaLam['WS_date'] = date;
            this.idCaLam['idComp'] = this.currentUser.idComp;
            this.$store.dispatch('allCaLam');
        },
        // Sửa ca làm cho nhân viên khi truyền xuống modelCalam 
        EditCaLam(valueID, date){
            this.idCaLam['User_id'] = valueID;
            this.idCaLam['WS_date'] = date;
            this.idCaLam['idComp'] = this.currentUser.idComp;
            this.$refs.editCalam.getCaLamUser();
            this.$store.dispatch('allCaLam');
        },
        //ca làm đã đăng ký
        setVal(){
            let count = 0;
            let date = [];
            axios.post('/api/countCaLam', {id : this.currentUser.idComp, date:this.$store.getters.getDatecaLam }).then(res=>{
                res.data.forEach(
                    val => {
                        val.forEach(
                            va => { 
                                date[count] = va;
                                count ++;
                            }
                        )
                    }
                )
                return this.ValueCaLam = date
            })
        },
        //xử lý khi đóng thêm ca làm sẽ load lại
        HandelPage(){  
            this.$store.dispatch('SetDateCaLam',[this.numWeek, this.numYear]); 
            this.$refs.editCalam.getCaLamUser();
            this.setVal();
        },
        //Call addCalamm khi mở btn cộng trong chỉnh sửa
        OpenAdd(){
            this.$refs.addCalam.getCaLamUser();
        }
    },
    computed: {
        // get all company
        getCompanies(){
            return this.$store.getters.getCompany
        },
        getCaLam(){
            return this.$store.getters.getCaLam;
        },
        currentUser(){
            return this.$store.getters.currentUser;
        },
        ChangeCaLam(){
            return this.$store.getters.getDatecaLam;
        },
    }, 
}
</script>
<style lang="scss">
   
</style>