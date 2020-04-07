<template>
<div class="modal fade" id="addCalamforUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Thêm nhân viên làm việc</h5>
        <button type="button" @click="handleCloseCalam()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <span style="color: red" class="font-size-12">Lưu ý: Nhân viên đã đăng ký nằm ở cột( đã đăng ký ), nhân viên chưa đăng ký nằm ở cột( chưa đăng ký ).!!
            </span>
          </div>
        </div>
        <div class="container form">
          <div class="formAll">
            <template>
              <div style="text-align: center; margin: 20px 0">
                <el-transfer style="text-align: left; display: inline-block" v-model="value" filterable :left-default-checked="limitLeft" :titles="['Chưa đăng ký', 'Đã đăng ký']" :button-texts="['Hủy bỏ', 'Đăng ký']" :format="{
                                                          noChecked: '${total}',
                                                          hasChecked: '${checked}/${total}'
                                                        }" @change="handleChange" :data="data">
                </el-transfer>
              </div>
            </template>

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
  data() {
    return {
      data: [],
      value: [],
      limitLeft: [],
      valRight: [],
    }
  },
  props: {
    infoCaLam: {
      type: Object,
      default: {}
    }
  },

  methods: {
    handleChange(value, direction, movedKeys) {
      // console.log(value, direction, movedKeys); 
      if (direction === 'right')
        this.valRight = movedKeys;;
    },
    //Lấy toàn bộ nhân viên trong công ty chưa đăng ký
    //ngày/id công ty/
    handleGetEmpByComp() {
      let val = [];
      this.handleIssetEmp();
      axios.post('/api/getEmployersByCompany', {
          idComp: this.infoCaLam.idComp
        })
        .then(res => {
          res.data.forEach(response => {
            if (this.limitLeft.indexOf(response.User_id) != -1)
              var a = response.User_id;
            val.push({
              key: response.User_id,
              label: response.User_fullname,
              disabled: a % response.User_id == 0
            });
          })
          this.data = val;
        })
        .catch(() => {
          'err'
        })
    },
    handleIssetEmp() {
      let valNew = [];
      axios.post('/api/getListUser', {
          idComp: this.infoCaLam.idComp,
          date: this.infoCaLam.date,
          FormM_id: this.infoCaLam.idCa
        })
        .then(res => {
          res.data.forEach(res => {
            valNew.push(res.User_id);
          });
          this.limitLeft = valNew;
          this.value = valNew
        })
        .catch(() => {
          'err'
        })
    },
    HandelPage() {
      this.$emit('HandelPage')
    },
    Accept() {
      axios.post('/api/postWorkshifts', {
          FormM_id: this.infoCaLam.idCa,
          User_id: this.valRight,
          WS_date: this.infoCaLam.date
        })
        .then(res => {
          this.HandelPage();
        })
      this.handleCloseCalam();
    },
    handleCloseCalam() {
      this.data = [],
        this.value = [],
        this.valRight = [],
        this.limitLeft = [],
        this.limitRight = []
    },
  },
  computed: {}
}
</script>

<style>
.transfer-footer {
  margin-left: 20px;
  padding: 6px 5px;
}
</style>
