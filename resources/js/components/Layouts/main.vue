<template>
<div class="adminx-container" >
    <navi v-if=" ! ['login', 'register'].includes($route.name)"></navi>
    <router-view v-else></router-view>
</div>
</template>
<script>
import navi from './navigation'; 
export default {
    components:{
        navi
    },  
}
</script>