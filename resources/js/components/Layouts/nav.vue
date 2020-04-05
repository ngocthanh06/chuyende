<template>
<nav class="navbar navbar-expand justify-content-between fixed-top">
  <a class="navbar-brand mb-0 h1 d-none d-md-block" href="index.html">
    <img src="/upload/demo/img/logo.png" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
    ỨNG DỤNG XẾP CA LÀM NHÂN VIÊN
  </a>

  <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-icon">
          <i data-feather="search"></i>
        </div>
      </div>
      <input type="text" class="form-control" id="search" placeholder="Type to search...">
    </div>
  </form>

  <div class="d-flex flex-1 d-block d-md-none">
    <a href="#" class="sidebar-toggle ml-3">
      <i data-feather="menu"></i>
    </a>
  </div>

  <ul class="navbar-nav d-flex justify-content-end mr-2">
    <template v-if="!currentUser">
      <li>
        <router-link to="/login" class="nav-link">Login</router-link>
      </li>
    </template>
    <template v-else>
      
      <li class="nav-item dropdown d-flex align-items-center mr-2">
        <el-dropdown class="nofitication" trigger="click">
        <span class="el-dropdown-link">
          Thông báo<i class="el-icon-caret-bottom el-icon--right"></i>
          <el-badge class="mark" :value="12" />
        </span>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item class="clearfix">
            comments
            <el-badge class="mark" :value="12" />
          </el-dropdown-item>
          <el-dropdown-item class="clearfix">
            replies
            <el-badge class="mark" :value="3" />
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
        <a href="" @click="logout" class="nav-item dropdown d-flex align-items-center mr-2">{{ currentUser.User_fullname }}</a>
        <a href="" @click="logout" class="nav-item dropdown d-flex align-items-center mr-2">Logout</a>
      </li>

    </template>
  </ul>
</nav>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store.commit('logout');
      this.$router.push('/login');
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    }
  }
}
</script>
<style lang="scss">
  .nofitication{
    padding: 0 10px; cursor: pointer;
    .el-dropdown-link{
      color: #3490dc
    }
  }
  .mark{
    background: none;
  }
</style>