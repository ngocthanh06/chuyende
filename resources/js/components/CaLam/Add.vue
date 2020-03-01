<template> 
<div>
    <div class="pb-3">
                <h1>Thêm Ca làm</h1>
                <router-link class="btn btn-danger" to="/employers">Trở lại</router-link>
    </div>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
       <el-form-item label="Tên ca làm" prop="formM_name"> 
            <el-input v-model="ruleForm.formM_name"></el-input>
        </el-form-item> 
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
</div>
        </el-form-item>
        <el-form-item label="Số giờ công" prop="region">
            <el-input-number v-model="ruleForm.Work_time" controls-position="right" :min="1" :max="10"></el-input-number>
            <span>Giờ</span>
        </el-form-item>
        <el-form-item label="Giờ vào / ra">
            <el-col :span="11">
            <el-time-picker value-format="HH:mm:ss" format="HH:mm:ss" start="07:30" placeholder="Giờ vào" v-model="ruleForm.time_in" style="width: 100%;"></el-time-picker>
            </el-col>
            <el-col class="line" style="text-align: center" :span="2">-</el-col>
            <el-col :span="11">
            <el-time-picker value-format="HH:mm:ss" end="23:00" format="HH:mm:ss" placeholder="Giờ ra" v-model="ruleForm.time_out" style="width: 100%;"></el-time-picker>
            </el-col>
        </el-form-item>
        <el-form-item label="Ghi chú" prop="desc">
            <el-input type="textarea" v-model="ruleForm.Work_desc"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm')">Create</el-button>
            <el-button @click="resetForm('ruleForm')">Reset</el-button>
        </el-form-item>
</el-form>
</div>
</template>
<script>
export default {
    data() {
      return {
          options: [{
          value: 'Option1',
          label: 'Option1'
        }, {
          value: 'Option2',
          label: 'Option2'
        }, {
          value: 'Option3',
          label: 'Option3'
        }, {
          value: 'Option4',
          label: 'Option4'
        }, {
          value: 'Option5',
          label: 'Option5'
        }],
        ruleForm: {
          formM_name: '',
          Work_time: '',
          time_in: '',
          time_out: '',
          Work_desc: '',
        },
        rules: {
          
        }
      };
    },
    computed: {
        //Format thời gian
      pickerOptions(time){
          return time.getTime()
      },
    },
    methods: {
      submitForm(formName) {
          this.loading = true;
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('submit!');
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    }
  }
</script>