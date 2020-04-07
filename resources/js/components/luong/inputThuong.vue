<template>
    <el-input placeholder="Nhập thưởng" @change.once="loadThuong" v-model="thuong"></el-input>
</template>
<script>
export default {
  data(){
    return {
      thuong: 0
    }
  },
  methods:{
    loadThuong(){
      this.$emit('loadThuong', this.thuong);
    }
    
  }
}
</script>