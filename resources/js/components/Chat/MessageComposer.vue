<template>
  <div class="composer">
    <textarea v-model ="messages" @keydown.enter ="send" placeholder="Messages...."></textarea>
  </div>
</template>
<script>
export default {
    data(){
      return {
        messages: ''
      }
    },
    methods:{
      send(e){
        e.preventDefault();
        
        if(this.messages == ''){
          return;
        }
        this.$emit('send', this.messages)
        this.messages = '';
      }
    }
}
</script>
<style lang="scss">
    .composer textarea{
      width: 96%;
      margin: 10px;
      resize: none;
      border-radius: 3px;
      border: 1px solid lightgray;
      padding: 6px;
    }

</style>