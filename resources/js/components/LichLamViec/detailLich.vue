<template>
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-if="detailCa" id="myModal">Nhân viên <span style="color: red; text-transform: uppercase">{{detailCa['nameCa']}}</span> ngày <span style="color:red"> {{ detailCa['date']}}</span></h5>
        <button type="button" @click="handleClose" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ant-modal-body">
        <div class="row m-0 timekeeping-list-date-cell-container">
          <!-- showcalam -->
          <template v-for="(val, item) in Calam">
            <div :key="item" class="col-6 modal-shift-wrapper d-flex">
              <div class="cell-content large" style="border-color: rgba(102, 102, 102, 0.467); background-color: rgba(102, 102, 102, 0.133);">
                <div class="name">{{val.user_fullname}}</div>
                <span class="clock-in-out-time text-secondary font-size-10" v-if="val.workshifts[0].status == 0" style="color: #900C3F!important">Chưa Điểm danh</span>
                <span class="clock-in-out-time text-secondary font-size-10" v-else-if="val.workshifts[0].status == 1" style="color: #FF0000 !important">Không đi làm</span>
                <span class="clock-in-out-time text-secondary font-size-10" v-else style="color: #0000FF !important">Đã Điểm danh <br> (Vào: {{val.workshifts[0].ws_time_in}} - Ra: {{val.workshifts[0].ws_time_out}})</span>
                <div class="overlay-action">
                  <button type="button" class="action" @click="diemdanh(val.user_id, val.idComp)" href="#diemdanh" data-target="#diemdanh" data-toggle="modal">
                    <i aria-label="icon: eye" class="anticon anticon-eye">
                      <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="eye" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                        <path d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 0 0 0 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path>
                      </svg>
                    </i>
                  </button>
                  <el-dropdown @command="delCaLam" v-if="val.workshifts[0].status == 0" style="width: 33%">
                    <button type="button" class="action ant-dropdown-trigger">
                      <i aria-label="icon: ellipsis" class="anticon anticon-ellipsis">
                        <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="ellipsis" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                          <path d="M176 511a56 56 0 1 0 112 0 56 56 0 1 0-112 0zm280 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0zm280 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0z"></path>
                        </svg>
                      </i>
                    </button>
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item :command="{text: 'del', value: val, idCa: detailCa.idCa , date: detailCa.date }" icon="el-icon-delete" style="color: red">Xóa</el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </div>
              </div>
            </div>
          </template>
          <!-- endshowcalam -->
          <!-- addcalam -->
          <div class="col-6 modal-shift-wrapper add-shift-button-wrapper">
            <button type="button" @click="OpenAdd()" class="ant-btn add-shift-button ant-btn-dashed">
              <i aria-label="icon: plus" class="anticon anticon-plus">
                <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                  <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path>
                  <path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path>
                </svg>
              </i>
            </button>
          </div>
          <!-- end addcalam -->
        </div>
      </div>
      <button ref="openAdd4" style="display: none" href="#addCalamforUser" data-target="#addCalamforUser" data-toggle="modal"></button>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import moment from'moment'
export default {
  data() {
    return {
      Calam: [],
      classHide: {
        active: true,
        'display': 'none'
      }
    }
  },
  props: {
    getsInv: {
      type: Array,
      default: {}
    },
    detailCa: {
      type: Object,
      default: {}
    }
  },
  methods: {

    HandelPage() {
      this.$emit('HandelPage')
    },
    OpenAdd() {
      let now = moment().format('YYYY-MM-DD');
      let date = this.detailCa.date;
      if (now <= date) {
        this.$refs.openAdd4.click();
        this.$emit('OpenAdd');
      } else {
        this.$message.error('Thông báo, hết hạn đăng ký ca làm.');
      }
    },
    handleClose() {
      this.Calam = []
    },

    //get Calam user
    getClamUser() {
      axios.post('/api/getsArrUser', {
        val: this.detailCa.value,
        date: this.detailCa.date
      }).then(res => {
        this.Calam = res.data;
      })
    },

    getListUser() {
      axios.post('/api/getListUser', {
          idComp: this.detailCa.idComp,
          date: this.detailCa.date,
          form_id: this.detailCa.idCa
        })
        .then(res => {
          this.Calam = res.data;
        })
    },
    //id: user_id,
    //Work: idComp
    diemdanh(id, work) {
      this.$emit('diemdanh', id, work);
    },
    //delete Calam User
    delCaLam(command) {
      if (command.text === 'del') {
        this.$confirm('Bạn muốn hủy ca làm ? Tiếp tục?', 'Thông báo', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning'
          }).then(() => {
            axios.post('/api/delCawhereID/', {
              value: command.value,
              date: command.date,
              idCa: command.idCa
            }).then(res => {
              if (res.status === 200) {
                this.HandelPage()
              }
            });
            // this.HandelPage()
            this.$message({
              type: 'success',
              message: 'Ca làm đã được hủy'
            });
          })
          .catch(() => {
            this.$message({
              type: 'info',
              message: 'Không thể hủy ca làm'
            });
          });
      }
    },
  },
  computed: {}
}
</script>
