<template>
  <div class="container">
    <form v-on:submit.prevent='SendNotification'>
        <div class="form-group">
            <label>Title</label>
            <input name="title" type="text" class="form-control" v-model="title">
        </div>
        <div class="form-group">
            <label>Content</label>
            <input name="content" type="text" v-model="content" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</template>
<script>
export default {
    created(){
    },
    data(){
        return {
            title: '',
            content: ''
        }
    },
    methods: {
        SendNotification(){
            axios.post('/api/nofitication', {'title': this.title, 'content': this.content}).then((res) => {
                console.log(res);
            })
        }
    }
}
</script>

