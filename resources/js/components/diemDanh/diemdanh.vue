<template>
<div class="modal fade" id="diemdanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Điểm danh ca làm <span style="color: red"> {{FormM_name.FormM_name}} </span> ngày <span style="color: red">{{date}}</span></h5>
        <button type="button" @click="handleClose()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ant-modal-body">
        <div class="row m-0 timekeeping-list-date-cell-container">
          <el-form ref="form" :model="form" label-width="120px" style="width: 90%">
            <el-form-item label="Thời gian">
              <el-col :span="11" prop="WS_time_in">
                <el-time-picker placeholder="Giờ vào" value-format="HH:mm:ss" format="HH:mm:ss" v-model="form.WS_time_in"></el-time-picker>
              </el-col>
              <el-col :span="11" prop="WS_time_out">
                <el-time-picker placeholder="Giờ ra" value-format="HH:mm:ss" format="HH:mm:ss" v-model="form.WS_time_out"></el-time-picker>
              </el-col>
            </el-form-item>
            <el-form-item label="Phép">
              <el-radio-group v-model="attendance" style="line-height: 50px">
                <el-radio :label="1" :disabled="disable.attendance1">Có phép</el-radio>
                <el-radio :label="2" :disabled="disable.attendance2">Không phép</el-radio>
                <el-radio :label="0" :disabled="disable.attendance3">Phép chưa duyệt</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="Ghi chú">
              <el-input type="textarea" v-model="form.Work_desc"></el-input>
            </el-form-item>
            <el-form-item label="Điểm danh">
              <el-radio-group v-model="form.status" size="small" style="line-height: inherit">
                <el-radio-button :label="1">Nghỉ làm</el-radio-button>
                <el-radio-button :label="2">Đi làm</el-radio-button>
              </el-radio-group>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" href="#checkPhep" data-toggle="modal" data-target="#checkPhep" @click="openPhep">Kiểm tra phép</el-button>
            </el-form-item>
          </el-form>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" @click="onSubmit()" data-dismiss="modal" aria-hidden="true">Lưu</button>
        <button class="btn btn-default" @click="handleClose()" data-dismiss="modal" aria-hidden="true">Đóng</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import moment from "moment";
export default {
  created() {
    this.nameDate();
  },
  data() {
    return ({
      form: {
        WS_time_in: '',
        WS_time_out: '',
        status: '',
        Work_id: '',
        Work_desc: ''
      },
      attendance: '',
      disable: {
        attendance1: false,
        attendance2: false,
        attendance3: false
      },
      FormM_name: [],
    });
  },
  props: {
    calam: {
      type: Object,
      default: {}
    },
  },
  methods: {
    handleClose() {
        this.attendance = '';
        this.FormM_name = [];
        var self = this; //you need this because *this* will refer to Object.keys below`
        //Iterate through each object field, key is name of the object field`
        Object.keys(this.form).forEach(function(key,index) {
          self.form[key] = '';
        });
        this.disable.attendance1 = false;
        this.disable.attendance2 = false;
        this.disable.attendance3 = false;
    },
    /**
     *  main->$refs->diemDanh
     *  request: form
     */
    onSubmit() {
          axios.post('/api/diemdanh', this.form).then(res => {
            if (res.data.code === '200') {
              this.$message({
                message: 'Điểm danh thành công!',
                type: 'success'
              });
              this.handleClose();
              this.$emit('EditCaLam',this.calam.User_id, this.calam.WS_date);
            }
          })
    },
    /**
     *  main->$refs->diemDanh
     *  val: idCa/Form_id
     *  work:  work_id
     *  response: list FormM_name
     */
    nameDate(val, work) {
      axios.get(`/api/CalamID/${val}`).then(res => { 
        this.FormM_name = res.data;
      });
    },

    /**
     *  main->$refs->diemDanh
     *  work:  work_id
     *  response: list form
     */
    diemDanh(work) {
      axios.get(`/api/getWorkshifts/${work}`).then(res => {
        if(res.data.status == 0){
          this.form.WS_time_in = this.FormM_name.FormM_TimeIn;
          this.form.WS_time_out = this.FormM_name.FormM_TimeOut;
          this.form.Work_id = work;
        }
        else
        this.form = res.data;
      })
    },
    /**
     *  main->$refs->diemDanh
     *  work:  work_id
     *  response: check phép
     */
    checkPhep(work) {
      axios.post('/api/getAttendanceWhereId', {
        Workshifts_id: work,
        Att_time: this.calam.WS_date
      }).then(res => { 
        if (res.data === '') {
          this.disable.attendance3 = true;
          this.disable.attendance2 = true;
          this.disable.attendance1 = true;
        }
        if (res.data != null && res.data.Att_status == 0) {
          this.attendance = 0;
          this.disable.attendance1 = true;
          this.disable.attendance2 = true;
        }
        if (res.data != null && res.data.Att_status == 1) {
          this.attendance = 1;
          this.disable.attendance2 = true;
          this.disable.attendance3 = true;
        }
        if (res.data != null && res.data.Att_status == 2) {
          this.attendance = 2;
          this.disable.attendance1 = true;
          this.disable.attendance3 = true;
        }
      })
    },

    // checkPhep(work,status){
    //   this.form.status = status;
    //   axios.post('/api/getAttendanceWhereId',{Workshifts_id: work, Att_time: this.calam.WS_date}).then(res=>{
    //         if(res.data === ''){
    //           this.disable.attendance3 = true; 
    //           this.disable.attendance2 = true;
    //           this.disable.attendance1 = true;
    //         }
    //         if(res.data != null && res.data.Att_status === 1){
    //             this.attendance = 0;
    //             this.disable.attendance1 = true;
    //             this.disable.attendance2 = true; 
    //             this.form.status = 1;
    //         }

    //         // chưa điểm danh 
    //         // if(res.data === '' && this.form.status === 0){
    //         //   this.attendance = 2;
    //         //   this.disable.attendance2 = false;
    //         //   this.disable.attendance1 = true;
    //         //   this.disable.attendance3 = true; 
    //         // } 
    //         // if(res.data != null && res.data.Att_status === 0 && this.form.status === 0 ){
    //         //     this.attendance = 0;
    //         //     this.disable.attendance1 = true;
    //         //     this.disable.attendance2 = true; 
    //         // }
    //         //  if(res.data != null && res.data.Att_status === 1 && this.form.status === 0 ){
    //         //     this.attendance = 1;//Có phép
    //         //     this.disable.attendance3 = true; 
    //         //     this.disable.attendance2 = true; 
    //         // }
    //         // if(res.data != null && res.data.Att_status === 2 &&  this.form.status === 0){
    //         //     this.attendance = 2;
    //         //     this.disable.attendance1 = true;
    //         //     this.disable.attendance3 = true;  
    //         // } 
    //         // //nghỉ có phép
    //         // if(res.data != null && res.data.Att_status === 1 &&  this.form.status === 1){
    //         //     this.attendance = 1;//Có phép
    //         //     this.disable.attendance3 = true; 
    //         //     this.disable.attendance2 = true; 
    //         // } 
    //         // //nghỉ làm không chưa duyệt phép
    //         // if(res.data != null && res.data.Att_status === 0 &&  this.form.status === 1){
    //         //     this.attendance = 0;
    //         //     this.disable.attendance1 = true;
    //         //     this.disable.attendance2 = true;  
    //         // } 
    //         // //nghỉ làm không phép
    //         // if(res.data != null && res.data.Att_status === 2 &&  this.form.status === 1){
    //         //     this.attendance = 2;
    //         //     this.disable.attendance1 = true;
    //         //     this.disable.attendance3 = true;  
    //         // } 
    //         // // đang duyệt
    //         // if(res.data != null && this.form.status === 2){
    //         //   this.disable.attendance3 = true;
    //         //   this.disable.attendance2 = true;
    //         //   this.disable.attendance1 = true; 
    //         // }

    //     })

    // },
    openPhep() {
      this.$emit('openPhep', this.form.Work_id, this.calam.WS_date);
    }
  },
  computed: {
    date() {
      return moment(this.calam.WS_date).format('DD/MM/YYYY');
    },

  },
}
</script>
