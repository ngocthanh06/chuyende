<template>
  <div id="app">
    <vue-dropzone id="upload" ref="myVueDropzone" :options="config"></vue-dropzone>
  </div>
</template>

<script>
import vueDropzone from "vue2-dropzone";

export default {
  data: () => ({
    config: {
      url: "http://127.0.0.1:8000/api/upload/",
       headers: { "My-Awesome-Header": "header value" },
       thumbnailWidth: 150,
          maxFilesize: 0.5,
      
    }
  }),
  components: {
    vueDropzone
  }
};
</script>