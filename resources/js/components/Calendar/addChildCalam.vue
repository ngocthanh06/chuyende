<template>
    <div class="modal fade" id="myModalChild" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal">Chỉnh sửa ca làm</h5>
                        <button type="button" @click="handleCloseCalam()" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              <span class="font-size-12">
                                  Chọn ca làm phù hợp ứng với mỗi nhân viên( Trường hợp nhân viên chọn fulltime thì không thể chọn
                                  parttime được ). 
                              </span>
                              <span style="color: red">Lưu ý: Nếu ca làm đã được chọn bạn không thể hủy nó trực tiếp tại đây, bạn có thể xóa ca làm từ bên ngoài.!!
                              </span>
                          </div>
                      </div>
                      <div class="container form">
                          <div class="formAll">
                              <table class="table" id="addCalamTable">
                                <thead>
                                    <tr>
                                    <th scope="col">Ca làm</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Bắt đầu</th>
                                    <th scope="col">Kết thúc</th>
                                    <th scope="col">Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in getCaLamProp">
                                        <th scope="row">{{item.FormM_name}}</th>
                                        <td>{{item.FormM_Work}}</td>
                                        <td>{{item.FormM_TimeIn}}</td>
                                        <td>{{item.FormM_TimeOut}}</td>
                                        <td>
                                            <input :id="'add'+item.FormM_id" @change="getTime(item)" v-bind:checked="checked(item)" type="checkbox" aria-label="Checkbox for following text input"> 
                                        </td>
                                    </tr> 
                                </tbody>
                                </table>
                          </div>
                      </div>
                </div>
            <div class="modal-footer">
                <button type="button" @click="Accept()" data-dismiss="modal" class="btn btn-secondary">Lưu</button>
            </div>
        </div>
    
    </div>
</div>
</template>
<script>
export default {
    Updating(){
    },
    data(){
        return {
            ruleForm1 : {
                FormM_id : [],
                User_id : '',
                WS_date: ''
            },
            rule: [],
            Calam: [],
            count: '',
        }
    },
    props: {
        calam : {
            type: Object,
            default: {}
        },
        getCaLamProp: {
            type: Array,
            default: []
        }
    },
    methods: {
        checked(val){  
            if(this.Calam.length <= this.count){  
                this.Calam.forEach(res => { 
                    if(res.FormM_id === val.FormM_id){  
                        $(`#add${val.FormM_id}`).prop('checked',true); 
                        $(`#add${val.FormM_id}`).attr('disabled',true); 
                    } 
                })
            }
            // return check;
              
        },
        HandelPage(){
            this.$emit('HandelPage')
        },
        Accept(){
            if(this.Calam.length > this.count){
                const value = this.Calam.filter((val, index, arr) => {
                        if(index >= this.count) return val
                })
                value.forEach(
                    val => { this.ruleForm1.FormM_id.push(val);},  
                );
                this.ruleForm1['User_id'] = this.calam['User_id'];
                this.ruleForm1['WS_date'] = this.calam['WS_date'];
                axios.post('/api/CaLam',this.ruleForm1).then((res)=>{
                    try{
                        if(res.status === 200){    
                            this.HandelPage();
                            this.ruleForm1.FormM_id = [];
                            this.$message({
                            type: 'success',
                            message: 'Ca làm việc đã được cập nhật'
                            }); 
                        }
                    }
                    catch{
                            this.$message({
                            type: 'warning',
                            message: 'Lỗi'
                            }); 
                    }
                });
                this.handleClose(); 
            };
        },
        //get Calam user
        getCaLamUser(){
            axios.post('/api/editCalamUser',this.calam).then(res=>{
               this.Calam = res.data; 
               this.count = res.data.length;
               return res.data;
            })
        },
        handleCloseCalam() {
            $('#addCalamTable').find(':input').prop('checked',false); 
            $('#addCalamTable').find(':input').attr('disabled',false); 
            return this.Calam = [];
        },
        getTime(val){
            if($(`#add${val.FormM_id}`).is(':checked') === true){
                this.Calam.push(val);
                //Check time work 
                if(this.Calam.length > 1 && val.FormM_Work >= 8)
                {
                    this.$alert('<b>Bạn đã đăng ký ca làm <i style="color: red">PARTTIME</i> nên không không thể đăng ký thêm <i style="color: red">FULLTIME</i></b>', 'Thông báo', {
                                dangerouslyUseHTMLString: true,
                                confirmButtonText: 'OK',
                                callback: action => {
                                    $(`#add${val.FormM_id}`).prop('checked',false);
                                    this.Calam = this.Calam.filter( name => name !== val);
                                    this.$message({
                                        type: 'success',
                                        message: `Lựa chọn gần đây đã được hủy`
                                    });
                            }
                        });
                }
                else if(this.Calam.length > 1 ){
                    if(this.Calam[0].form_m.FormM_Work >= 8){
                        this.$alert('<b>Bạn đã đăng ký <i style="color: red">FULLTIME</i> nên không còn ca phù hợp</b>', 'Thông báo', {
                                confirmButtonText: 'OK',
                                dangerouslyUseHTMLString: true,
                                callback: action => {
                                    $(`#add${val.FormM_id}`).prop('checked',false);
                                    this.Calam = this.Calam.filter( name => name !== val);
                                    this.$message({
                                            type: 'success',
                                            message: `Lựa chọn gần đây đã được hủy`
                                        });
                                }
                        });
                    }    
                }
          }
          else{ 
              if(this.Calam.length === this.count){
                  this.Calam.forEach(res => {
                      if(res.FormM_id == val.FormM_id){
                            $(`#add${val.FormM_id}`).prop('checked',true);
                            this.$notify.error({
                                title: 'Error',
                                message: 'BẠN KHÔNG THỂ HỦY CA LÀM VIỆC ĐÃ ĐƯỢC TỰ CHỌN TỪ TRƯỚC'
                            });
                      }
                  })
              }
              else{
                  this.$alert('<b>Bạn muốn <i style="color: red">HỦY</i> ca làm việc này ?</b>', 'Thông báo', {
                            confirmButtonText: 'OK',
                            dangerouslyUseHTMLString: true,
                     }).then(()=>{ 
                                this.Calam = this.Calam.filter( name => name !== val);
                                this.$message({
                                        type: 'success',
                                        message: `Lựa chọn gần đây đã được hủy`
                                });
                     }).catch(()=>{  $(`#add${val.FormM_id}`).prop('checked',true); 
                                this.$message({  
                                    type: 'info', 
                                    message: 'Thao tác không thành công' 
                                    });  
                            });
                         } 
                     }
              }
    },
    computed: {
    }
}
</script>