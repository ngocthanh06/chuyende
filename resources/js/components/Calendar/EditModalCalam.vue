<template>
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal">Ca làm đã đăng ký</h5> 
                        <button type="button" @click="handleClose" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body ant-modal-body">
                <div class="row m-0 timekeeping-list-date-cell-container">
                    <!-- showcalam -->
                    <div v-for="(val, item) in Calam" :key="item" class="col-6 modal-shift-wrapper d-flex">
                        <div class="cell-content large" style="border-color: rgba(102, 102, 102, 0.467); background-color: rgba(102, 102, 102, 0.133);">
                            <div class="name">{{val.form_m.FormM_name}}</div>
                            <span class="clock-in-out-time text-secondary font-size-10">Điểm danh (Vào: -:- - Ra: -:-)</span>
                            <div class="overlay-action">
                            <button type="button" class="action">
                                <i aria-label="icon: eye" class="anticon anticon-eye">
                                    <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="eye" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 0 0 0 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path>
                                    </svg>
                                </i>
                            </button> 
                            <el-dropdown @command="delCaLam" style="width: 33%">
                                <button type="button" class="action ant-dropdown-trigger">
                                    <i aria-label="icon: ellipsis" class="anticon anticon-ellipsis">
                                        <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="ellipsis" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                            <path d="M176 511a56 56 0 1 0 112 0 56 56 0 1 0-112 0zm280 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0zm280 0a56 56 0 1 0 112 0 56 56 0 1 0-112 0z"></path>
                                        </svg>
                                    </i>
                                </button>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item :command="{text: 'nghiphep', value: val}" icon="el-icon-edit-outline">Tạo yêu cầu nghỉ phép</el-dropdown-item>
                                    <el-dropdown-item :command="{text: 'del', value: val.Work_id}" icon="el-icon-delete" style="color: red">Xóa</el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                            </div>
                        </div>
                    </div> 
                    <!-- endshowcalam -->
                    <!-- addcalam -->
                    <div class="col-6 modal-shift-wrapper add-shift-button-wrapper"> 
                        <button type="button" @click="OpenAdd()" href="#myModalChild" data-target="#myModalChild" data-toggle="modal" class="ant-btn add-shift-button ant-btn-dashed">
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
            
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div> 
    </div> 
</div>
</template>
<script> 
export default { 
    data(){
        return {
            Calam: [],
            classHide: {
                active: true,
                'display': 'none'
            }
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
        
        HandelPage(){
            this.$emit('HandelPage')
        },
        OpenAdd(){
            this.$emit('OpenAdd');
        },
        handleClose() {
        },
        
        //get Calam user
         getCaLamUser(){
            axios.post('/api/editCalamUser',this.calam).then(res=>{
                this.Calam = res.data;
            })
        },
        //delete Calam User
        delCaLam(command){
            if(command.text === 'del'){
                this.$confirm('Bạn muốn hủy ca làm ? Tiếp tục?', 'Thông báo', {
                    confirmButtonText: 'OK',  cancelButtonText: 'Cancel',  type: 'warning' }).then(() => {
                    axios.post('/api/delCalam/',{Work_id:command.value}).then(res=>{ 
                        if(res.status === 200) { this.HandelPage() } });
                    this.$message({ type: 'success', message: 'Ca làm đã được hủy'});
                    })
                    .catch(() => { this.$message({ type: 'info', message: 'Không thể hủy ca làm'});          
                });
            }
        }, 
    },
    computed: { 
    }
}
</script>
<style lang="scss"> 
.ant-modal-body{  padding: 20px; padding: 24px; font-size: 13px; line-height: 1.5; word-wrap: break-word;
        .timekeeping-list-date-cell-container{ flex: 1;  display: flex; white-space: normal; overflow: hidden;
            .modal-shift-wrapper{ padding: 0 5px 10px; height: 72px;
                    .cell-content { flex: 1; border: 2px solid #000; border-radius: 5px; margin: 1px; position: relative; overflow: hidden;};
                    .cell-content.large { padding: 5px; line-height: 1; 
                        .name { font-weight: 700; font-size: 12px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; margin-bottom: 3px;};
                        .font-size-10 { font-size: .76rem; }
                        .overlay-action { position: absolute; top: 0; right: 0; left: 0; bottom: 0; background: #79bac196; visibility: hidden; display: flex;
                            justify-content: center; align-items: center; padding-left: 2px; padding-right: 2px;
                             .action { border: 1px solid #fff; border-radius: 5px; margin-left: 2px; margin-right: 2px;
                                height: 25px; width: 100%; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; color: #fff;
                                max-width: 50px; display: flex; justify-content: center; align-items: center; background: #79bac196;
                            }
                        };
                    };
                    .cell-content:hover .overlay-action { visibility: visible; }     
            };
            .add-shift-button-wrapper {  flex: 1; display: flex; justify-content: center; align-items: center;
                .add-shift-button { border-width: 2px; color: #e3e3e3; display: flex;
                    justify-content: center; align-content: center;  width: 50%; background-color: #fff; border-color: #e4e9f0; border-style: dashed;
                    box-shadow: 0 2px 0 rgba(0,0,0,.015); cursor: pointer; transition: all .3s cubic-bezier(.645,.045,.355,1);
                    user-select: none; touch-action: manipulation; height: 32px; padding: 0 15px;
                    font-size: 13px; border-radius: 4px;line-height: 1.499; position: relative; font-weight: 400;
                    white-space: nowrap; text-align: center; background-image: none;
                    }
                }
            }
        }
button:focus {
    outline: none;
} 
</style>