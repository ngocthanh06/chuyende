<template>
<div class="adminx-container" >

    <div class="adminx-content">
          
          <nav-bar></nav-bar>

          <side-bar></side-bar>
  
          <div class="adminx-main-content">
            <div class="container-fluid">
              <!-- BreadCrumb -->
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
              <router-view></router-view>
            </div>
          </div>
        </div>
</div>
</template>
<script>

import navBar from'./nav';
import SideBar from './sidebar';
export default {
    components:{
        navBar, SideBar
    },
    data(){
        return {

        }
    }
}
</script>