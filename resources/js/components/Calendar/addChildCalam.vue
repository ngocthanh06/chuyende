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
                <tr v-for="(item, key) in getCaLamProp" :key="key">
                  <th scope="row">{{item.form_name}}</th>
                  <td>{{item.form_work}}</td>
                  <td>{{item.form_time_in}}</td>
                  <td>{{item.form_time_out}}</td>
                  <td>
                    <input :id="'add'+item.form_id" @change="getTime(item)" v-bind:checked="checked(item)" type="checkbox" aria-label="Checkbox for following text input">
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
  Updating() {},
  data() {
    return {
      ruleForm1: {
        form_id: [],
        user_id: '',
        ws_date: ''
      },
      rule: [],
      Calam: [],
      count: '',
      number: 0,
    }
  },
  props: {
    calam: {
      type: Object,
      default: {}
    },
    getCaLamProp: {
      type: Array,
      default: []
    }
  },
  methods: {
    checked(val) {
      if (this.Calam.length <= this.count) {
        this.Calam.forEach(res => {
          if (res.form_id === val.form_id) {
            $(`#add${val.form_id}`).prop('checked', true);
            $(`#add${val.form_id}`).attr('disabled', true);
            if(this.Calam.length > 1 && this.number <= 8 ){
              this.number = this.number + val.form_work;
            }
            else if(this.Calam.length == 1 && val.form_work == 8 && this.number <= 8){
              this.number = 8;
            }
            else if(this.Calam.length == 1 && val.form_work == 4)
             {
               this.number = 4;
             }
          }
        })
      }
      // return check;

    },
    HandelPage() {
      this.$emit('HandelPage')
    },
    Accept() {
      if (this.Calam.length > this.count) {
        const value = this.Calam.filter((val, index, arr) => {
          if (index >= this.count) return val
        })
        value.forEach(
          val => {
            this.ruleForm1.form_id.push(val);
          },
        );
        this.ruleForm1['user_id'] = this.calam['user_id'];
        this.ruleForm1['ws_date'] = this.calam['ws_date'];
        axios.post('/api/CaLam', this.ruleForm1).then((res) => {
          try {
            if (res.status === 200) {
              this.HandelPage();
              this.ruleForm1.form_id = [];
              this.$message({
                type: 'success',
                message: 'Ca làm việc đã được cập nhật'
              });
              this.number = 0;
            }
          } catch {
            this.$message({
              type: 'warning',
              message: 'Lỗi'
            });
          }
        });
        this.handleCloseCalam();
      };
    },
    //get Calam user
    getCaLamUser() {
      axios.post('/api/editCalamUser', this.calam).then(res => {
        this.Calam = res.data;
        this.count = res.data.length;
        return res.data;
      })
    },
    handleCloseCalam() {
      $('#addCalamTable').find(':input').prop('checked', false);
      $('#addCalamTable').find(':input').attr('disabled', false);
      this.number = 0;
      return this.Calam = [];
    },
    getTime(val) {
      let date = this.calam.ws_date;
      let form_id = val.form_id;
      axios.post('/api/checkWorkshiftsWhere', {
        date: date,
        form_id: form_id,
        idComp: this.calam.idComp
      }).then(res => {
        if (res.data < 5) {
          if ($(`#add${val.form_id}`).is(':checked') === true) {
            this.Calam.push(val);
            this.number += val.form_work;
            //Check time work 
            if (this.Calam.length > 1 && val.form_work >= 8) {
              this.$alert('<b>Bạn đã đăng ký ca làm <i style="color: red">PARTTIME</i> nên không không thể đăng ký thêm <i style="color: red">FULLTIME</i></b>', 'Thông báo', {
                dangerouslyUseHTMLString: true,
                confirmButtonText: 'OK',
                callback: action => {
                  $(`#add${val.form_id}`).prop('checked', false);
                  this.Calam = this.Calam.filter(name => name !== val);
                  this.$message({
                    type: 'success',
                    message: `Lựa chọn gần đây đã được hủy`
                  });
                  this.number -= val.form_work;
                }
              });
            } else if (this.Calam.length > 1) {
              if (this.Calam[0].formm.form_work >= 8) {
                this.$alert('<b>Bạn đã đăng ký <i style="color: red">FULLTIME</i> nên không còn ca phù hợp</b>', 'Thông báo', {
                  dangerouslyUseHTMLString: true,
                  confirmButtonText: 'OK',
                  callback: action => {
                    $(`#add${val.form_id}`).prop('checked', false);
                    this.Calam = this.Calam.filter(name => name !== val);
                    this.$message({
                      type: 'success',
                      message: `Lựa chọn gần đây đã được hủy`
                    });
                    this.number -= val.form_work;
                  }
                });
              }
              else if(this.Calam.length > 1 && val.form_work < 8 && this.number > 8){
                  this.$alert('<b>Bạn đã đăng ký nhiều hơn <i style="color: red">1 ca</i> và số lượng ca cho phép không vượt quá <i style="color: red">2 ca</i> trong 1 ngày vì vậy không thể đăng ký thêm</b>', 'Thông báo', {
                    dangerouslyUseHTMLString: true,
                    confirmButtonText: 'OK',
                    callback: action => {
                      $(`#add${val.form_id}`).prop('checked', false);
                      this.Calam = this.Calam.filter(name => name !== val);
                      this.$message({
                        type: 'success',
                        message: 'Lựa chọn gần đây đã bị hủy'
                      });
                      this.number -= val.form_work;
                    }
                  })
                  
              }
            }
          } else {
            if (this.Calam.length === this.count) {
              this.Calam.forEach(res => {
                if (res.form_id == val.form_id) {
                  $(`#add${val.form_id}`).prop('checked', true);
                  this.$notify.error({
                    title: 'Error',
                    message: 'BẠN KHÔNG THỂ HỦY CA LÀM VIỆC ĐÃ ĐƯỢC TỰ CHỌN TỪ TRƯỚC'
                  });
                }
              })
            } else {
              this.$alert('<b>Bạn muốn <i style="color: red">HỦY</i> ca làm việc này ?</b>', 'Thông báo', {
                confirmButtonText: 'OK',
                dangerouslyUseHTMLString: true,
              }).then(() => {
                this.Calam = this.Calam.filter(name => name !== val);
                this.$message({
                  type: 'success',
                  message: `Lựa chọn gần đây đã được hủy`
                });
                this.number -= val.form_work;
              }).catch(() => {
                $(`#add${val.form_id}`).prop('checked', true);
                this.$message({
                  type: 'info',
                  message: 'Thao tác không thành công'
                });
              });
            }
          }
        } else {
          this.$alert('<b>Ca làm đã vượt quá giới hạn cho phép !! </br> <i style="color: red">Bạn có thể liên hệ chủ hoặc quản lý để được bổ sung.!</i></b>', 'Thông báo', {
            dangerouslyUseHTMLString: true,
            confirmButtonText: 'OK',
            callback: action => {
              $(`#add${val.form_id}`).prop('checked', false);
              this.Calam = this.Calam.filter(name => name !== val);
              this.$message({
                type: 'success',
                message: `Lựa chọn gần đây đã được hủy`
              });
              this.number -= val.form_work;
            }
          });
        }

      })
    }
  },
  computed: {}
}
</script>
