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
                                        <el-transfer
                                                style="text-align: left; display: inline-block"
                                                v-model="value4"
                                                filterable
                                                :left-default-checked="[2, 3]"
                                                :right-default-checked="[1]"
                                                :titles="['Chưa đăng ký', 'Đã đăng ký']"
                                                :button-texts="['Hủy bỏ', 'Đăng ký']"
                                                :format="{
                                                          noChecked: '${total}',
                                                          hasChecked: '${checked}/${total}'
                                                        }"
                                                @change="handleChange"
                                                :data="data">
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
        data(){
            const generateData = _ => {
                const data = [];
                for (let i = 1; i <= 15; i++) {
                    data.push({
                        key: i,
                        label: `Option ${ i }`,
                        disabled: i % 4 === 0
                    });
                }
                return data;
            };
            return {
            data: generateData(),
                data: generateData(),
                value: [1],
                value4: [1],  
            }
        },
        methods: {
            handleChange(value, direction, movedKeys) {
                console.log(value, direction, movedKeys);
            },
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

                    this.handleClose();
            },
            handleCloseCalam() {
                $('#addCalamTable').find(':input').prop('checked',false);
                $('#addCalamTable').find(':input').attr('disabled',false);
                return this.Calam = [];
            },

        },
        computed: {
        }
    }
</script>
<style>.transfer-footer {
    margin-left: 20px;
    padding: 6px 5px;
}
</style>