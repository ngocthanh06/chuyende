<template>
<div class="modal fade" id="checkdiemdanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Ca làm nhân viên đã đăng ký ngày <span style="color: red ">{{date}}</span></h5>
        <button type="button" @click="handleClose" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ant-modal-body">
        <div class="row m-0 timekeeping-list-date-cell-container">
          <!-- showcalam -->
          <div v-for="(val, item) in Calam" :key="item" class="col-6 modal-shift-wrapper d-flex">
            <div class="cell-content large" style="border-color: rgba(102, 102, 102, 0.467); background-color: rgba(102, 102, 102, 0.133);">
              <div class="name">{{val.formm.form_name}}</div>
              <span class="clock-in-out-time text-secondary font-size-10" v-if="val.status == 0" style="color: #900C3F!important">Chưa Điểm danh</span>
              <span class="clock-in-out-time text-secondary font-size-10" v-else-if="val.status == 1" style="color: #FF0000 !important">Không đi làm</span>
              <span class="clock-in-out-time text-secondary font-size-10" v-else style="color: #0000FF !important">Đã Điểm danh <br> (Vào: {{val.ws_time_in}} - Ra: {{val.ws_time_out}})</span>
              <div class="overlay-action">
                <button type="button" class="action" trigger="click" @click="diemdanh(val.form_id, val.work_id, val.status)" href="#diemdanh" data-target="#diemdanh" data-toggle="modal">
                  <i aria-label="icon: eye" class="anticon anticon-eye">
                    <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="eye" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                      <path d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 0 0 0 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path>
                    </svg>
                  </i>
                </button>

              </div>
            </div>
          </div>
          <!-- endshowcalam -->
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-default" @click="handleClose()" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>

  </div>
</div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      Calam: [],
    }
  },
  props: {
    calam: {
      type: Object,
      default: {}
    }
  },
  methods: {
    diemdanh(id, work, status) {
      this.$emit('diemdanh', id, work, status);
    },
    handleClose() {
      this.$emit('getMonth');
    },
    //get Calam user
    getCaLamUser() {
      axios.post('/api/editCalamUser', this.calam).then(res => {
        this.Calam = res.data;
      })
    },

  },
  computed: {
    date() {
      return moment(this.calam.day).format("DD/MM/YYYY");
    },
  }
}
</script>
