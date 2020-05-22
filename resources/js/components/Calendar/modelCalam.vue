<template>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Lựa chọn ca làm</h5>
        <button type="button" @click="handleClose" class="close" data-dismiss="modal" aria-label="Close">
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
          </div>
        </div>
        <div class="container form">
          <div class="formAll">
            <el-table :data="getCaLamProp" style="width: 100%" height="250">
              <el-table-column prop="FormM_name" label="Ca làm"> </el-table-column>
              <el-table-column prop="FormM_Work" label="Thời gian( Giờ)"></el-table-column>
              <el-table-column prop="FormM_TimeIn" label="Bắt đầu"> </el-table-column>
              <el-table-column prop="FormM_TimeOut" label="Kết thúc"> </el-table-column>
              <el-table-column label="Chọn">
                <template slot-scope="scope">
                  <input type="checkbox" @change="getTime(scope.row)" :id="scope.row.FormM_id" :value="scope.row" v-model="selected">
                  <i class="form-icon"></i>
                </template>
              </el-table-column>
            </el-table>
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
      selected: [],
      ruleForm1: {
        FormM_id: [],
        User_id: '',
        WS_date: ''
      },
      rule: [],
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
    HandelPage() {
      this.$emit('HandelPage')
    },
    Accept() {
      if (this.selected.length != 0) {
        this.selected.forEach(
          val => {
            this.ruleForm1.FormM_id.push(val);
          },
        );
        this.ruleForm1['User_id'] = this.calam['User_id'];
        this.ruleForm1['WS_date'] = this.calam['WS_date'];
        axios.post('/api/CaLam', this.ruleForm1).then((res) => {
          try {
            if (res.status === 200) {
              this.HandelPage();
              this.ruleForm1.FormM_id = [];
              this.$message({
                type: 'success',
                message: 'Ca làm việc đã được cập nhật'
              });
            }
          } catch {
            this.$message({
              type: 'warning',
              message: 'Lỗi'
            });
          }
        });
        this.handleClose();
      };
    },
    handleClose() {
      return this.selected = []
    },
    getTime(val) {
      let date = this.calam.WS_date;
      let FormM_id = val.FormM_id;
      axios.post('/api/checkWorkshiftsWhere', {
        date: date,
        FormM_id: FormM_id,
        idComp: this.calam.idComp
      }).then(res => {
        if (res.data < 5) {
          if ($(`#${val.FormM_id}`).is(':checked') === true) {
        this.number = this.number + val.FormM_Work; 
            //Check time work 
            if (this.selected.length > 1 && val.FormM_Work >= 8) {
              this.$alert('<b>Bạn đã đăng ký ca làm <i style="color: red">PARTTIME</i> nên không không thể đăng ký thêm <i style="color: red">FULLTIME</i></b>', 'Thông báo', {
                dangerouslyUseHTMLString: true,
                confirmButtonText: 'OK',
                callback: action => {
                  $(`#${val.FormM_id}`).prop('checked', false);
                  this.selected = this.selected.filter(name => name !== val);
                  this.$message({
                    type: 'success',
                    message: `Lựa chọn gần đây đã được hủy`
                  });
                }
              });
            } else if (this.selected.length > 1) {
              if (this.selected[0].FormM_Work >= 8) {
                this.$alert('<b>Bạn đã đăng ký <i style="color: red">FULLTIME</i> nên không còn ca phù hợp</b>', 'Thông báo', {
                  confirmButtonText: 'OK',
                  dangerouslyUseHTMLString: true,
                  callback: action => {
                    $(`#${val.FormM_id}`).prop('checked', false);
                    this.selected = this.selected.filter(name => name !== val);
                    this.$message({
                      type: 'success',
                      message: `Lựa chọn gần đây đã được hủy`
                    });
                  }
                });
              }
              else if(this.selected.length > 1 && val.FormM_Work < 8 && this.number > 8 ){
                this.$alert('<b>Bạn đã đăng ký nhiều hơn <i style="color: red">1 ca</i> và số lượng ca cho phép không vượt quá <i style="color: red">2 ca</i> trong 1 ngày vì vậy không thể đăng ký tiếp</b>', 'Thông báo', {
                  confirmButtonText: 'OK',
                  dangerouslyUseHTMLString: true,
                  callback: action => {
                    $(`#${val.FormM_id}`).prop('checked', false);
                    this.selected = this.selected.filter(name => name !== val);
                    this.$message({
                      type: 'success',
                      message: `Lựa chọn gần đây đã được hủy`
                    });
                    this.number -= val.FormM_Work;
                  }
                });
              }
            }
          } else {
            if (this.selected.length === this.count) {
              this.selected.forEach(res => {
                if (res.FormM_id == val.FormM_id) {
                  $(`#${val.FormM_id}`).prop('checked', true);
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
                this.selected = this.selected.filter(name => name !== val);
                this.$message({
                  type: 'success',
                  message: `Lựa chọn gần đây đã được hủy`
                });
                this.number -= val.FormM_Work;
              }).catch(() => {
                $(`#${val.FormM_id}`).prop('checked', true);
                this.$message({
                  type: 'info',
                  message: 'Thao tác không thành công'
                });
                this.number -= val.FormM_Work;
              });
            }
          }
        } else {
          this.$alert('<b>Ca làm đã vượt quá giới hạn cho phép !! </br> <i style="color: red">Bạn có thể liên hệ chủ hoặc quản lý để được bổ sung.!</i></b>', 'Thông báo', {
            dangerouslyUseHTMLString: true,
            confirmButtonText: 'OK',
            callback: action => {
              $(`#${val.FormM_id}`).prop('checked', false);
              this.selected = this.selected.filter(name => name !== val);
              this.$message({
                type: 'success',
                message: `Lựa chọn gần đây đã được hủy`
              });
              this.number -= val.FormM_Work;
            }
          });
        }

      })
    }
  },
  computed: {

  }
}
</script>
