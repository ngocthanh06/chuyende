<template>
  <section>
  {{show()}}
    
    <form>
    <select v-on:change="a" v-model ="value1">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>
    </form>
  </section>
</template>
<script>
  export default {
    data () {
      return {
        open: false,
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
        value1: ''
      }
    },
    methods: {
      callback (msg) {
        this.$notify(`Modal dismissed with msg '${msg}'.`)
      },
      change(){
        console.log('thay đổi')
      },
      show(){
        console.log('aa')
      },
      changeVal(){
        console.log('b');
      }
    },
    computed: {
      a(){
        console.log('t')
      }
    }
  }
</script>