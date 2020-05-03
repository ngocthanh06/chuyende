<template>
<div class="adminx-sidebar expand-hover push">
  <!-- nhân viên -->
  <ul v-if="currentUser.Role_id == 1" class="sidebar-nav">

    <li class="sidebar-nav-item">
      <router-link to="/ad-calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg> </span>
        <router-link to="/ad-calendar" href="#" class="nav-link">
          Đặt lịch nhân viên
        </router-link>
      </router-link>
    </li>
    <li class="sidebar-nav-item">
      <router-link to="/infomation" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="9" y1="15" x2="15" y2="15"></line>
          </svg>
        </span>
        <router-link to="/infomation" href="#" class="nav-link">
          Thông tin
        </router-link>
      </router-link>
    </li>

    <li class="sidebar-nav-item">
      <router-link to="/infomation" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <i class="el-icon-edit-outline"></i>
        </span>
        <router-link to="/editUserNV" href="#" class="nav-link">
          Sửa thông tin người dùng
        </router-link>
      </router-link>
    </li>
  </ul>
  <!-- end nhân viên -->
  <!-- QUản lý -->
  <ul v-else-if="currentUser.Role_id== 2" class="sidebar-nav">
    <li class="sidebar-nav-item">
      <router-link to="/Set-Calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
        </span>
        <router-link to="/homepage" href="#" class="nav-link">
          Home
        </router-link>
      </router-link>
    </li>
    <li class="sidebar-nav-item">
      <router-link to="/employers" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg data-v-fa6affac="" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" height="24" class="feather feather-users">
            <path data-v-fa6affac="" d="M 17 21 v -2 a 4 4 0 0 0 -4 -4 H 5 a 4 4 0 0 0 -4 4 v 2"></path>
            <circle data-v-fa6affac="" cx="9" cy="7" r="4"></circle>
            <path data-v-fa6affac="" d="M 23 21 v -2 a 4 4 0 0 0 -3 -3.87"></path>
            <path data-v-fa6affac="" d="M 16 3.13 a 4 4 0 0 1 0 7.75"></path>
          </svg>
        </span>
        <router-link to="/employers" href="#" class="nav-link">
          Nhân viên
        </router-link>
      </router-link>
    </li>
    <li class="sidebar-nav-item">
      <router-link to="/Set-Calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </span>
        <router-link to="/Set-Calendar" href="#" class="nav-link">
          Đặt ca làm việc cho quản lý
        </router-link>
      </router-link>
    </li>
    <li class="sidebar-nav-item">
      <router-link to="/getLichNv" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
        </span>
        <router-link to="/getLichNv" href="#" class="nav-link">
          Lịch làm nhân viên
        </router-link>
      </router-link>
    </li>

    <li class="sidebar-nav-item">
      <router-link to="/listPhep" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="9" y1="15" x2="15" y2="15"></line>
          </svg>
        </span>
        <router-link to="/listPhep" href="#" class="nav-link">
          Phép
        </router-link>
      </router-link>
    </li>

    <li class="sidebar-nav-item">
      <router-link to="/listCong" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
          </svg> </span>
        <router-link to="/listCong" href="#" class="nav-link">
          Thống kê
        </router-link>
      </router-link>
    </li>

    <!-- <li class="sidebar-nav-item">
      <router-link to="/list-calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
            <line x1="6" y1="6" x2="6" y2="6"></line>
            <line x1="6" y1="18" x2="6" y2="18"></line>
          </svg>
        </span>
        <router-link to="/list-calendar" href="#" class="nav-link">
          Lương
        </router-link>
      </router-link>
    </li> -->

    <li class="sidebar-nav-item">
      <router-link to="/Show-Calam" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
            <line x1="8" y1="6" x2="21" y2="6"></line>
            <line x1="8" y1="12" x2="21" y2="12"></line>
            <line x1="8" y1="18" x2="21" y2="18"></line>
            <line x1="3" y1="6" x2="3" y2="6"></line>
            <line x1="3" y1="12" x2="3" y2="12"></line>
            <line x1="3" y1="18" x2="3" y2="18"></line>
          </svg>
        </span>
        <router-link to="/Show-Calam" href="#" class="nav-link">
          Ca làm
        </router-link>
      </router-link>
    </li>

    <li class="sidebar-nav-item">
      <router-link to="/getChinhanh" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
          </svg>
        </span>
        <router-link to="/getChinhanh" href="#" class="nav-link">
          Chi nhánh
        </router-link>
      </router-link>
    </li>

    <li class="sidebar-nav-item">
      <router-link to="/listChucvu" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
          </svg>
        </span>
        <router-link to="/listChucvu" href="#" class="nav-link">
          Chức vụ
        </router-link>
      </router-link>
    </li>
  </ul>
  <!-- end quản lý -->

  <ul v-else class="sidebar-nav">

    <li class="sidebar-nav-item">
      <router-link to="/employers" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
        </span>
        <router-link to="/employers" href="#" class="nav-link">
          Nhân viên
        </router-link>
      </router-link>
    </li>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
      <circle cx="9" cy="7" r="4"></circle>
      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
    </svg>
    <li class="sidebar-nav-item">
      <router-link to="/Set-Calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </span>
        <router-link to="/Set-Calendar" href="#" class="nav-link">
          Đặt lịch
        </router-link>
      </router-link>
    </li>
    <li class="sidebar-nav-item">
      <router-link to="/ad-calendar" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </span>
        <router-link to="/ad-calendar" href="#" class="nav-link">
          Đặt lịch admin
        </router-link>
      </router-link>
    </li>

  </ul>
</div>
</template>

<script>
export default {
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    }
  }
}
</script>
