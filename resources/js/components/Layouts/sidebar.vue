<template>
   <div class="adminx-sidebar expand-hover push">
     <!-- nhân viên -->
          <ul v-if="currentUser.Role_id == 1" class="sidebar-nav">  
            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                </span>
                  <router-link to="/ad-calendar" href="#" class="nav-link">
                  Đặt lịch nhân viên
                </router-link>
              </a>
            </li> 
          </ul>
      <!-- end nhân viên -->
          <!-- QUản lý -->
          <ul v-else-if="currentUser.Role_id== 2" class="sidebar-nav">  
              <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>                  
                </span>
                  <router-link to="/employers" href="#" class="nav-link">
                  Nhân viên
                </router-link>
              </a>
            </li> 
            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                 
                </span>
                  <router-link to="/Set-Calendar" href="#" class="nav-link">
                  Đặt ca làm việc cho quản lý
                </router-link>
              </a>
            </li> 
             <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                </span>
                  <router-link to="/Set-Calendar" href="#" class="nav-link">
                  Lịch làm nhân viên
                </router-link>
              </a>
            </li> 
            
             <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                </span>
                  <router-link to="/Show-Calam" href="#" class="nav-link">
                  Ca làm
                </router-link>
              </a>
            </li> 

             <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>                </span>
                  <router-link to="/list-calendar" href="#" class="nav-link">
                  Chấm công
                </router-link>
              </a>
            </li> 

             <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg>
                </span>
                  <router-link to="/list-calendar" href="#" class="nav-link">
                  Lương
                </router-link>
              </a>
            </li> 

            
             <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </span>
                  <router-link to="/getChinhanh" href="#" class="nav-link">
                  Chi nhánh
                </router-link>
              </a>
            </li> 

            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                </span>
                  <router-link to="/Set-Calendar" href="#" class="nav-link">
                  Chức vụ
                </router-link>
              </a>
            </li> 
          </ul>
        <!-- end quản lý -->

          <ul v-else class="sidebar-nav">
            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span>
                  <router-link to="/employers" href="#" class="nav-link">
                  Nhân viên
                </router-link>
              </a>
            </li> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                 
                </span>
                  <router-link to="/Set-Calendar" href="#" class="nav-link">
                  Đặt lịch
                </router-link>
              </a>
            </li> 
            <li class="sidebar-nav-item">
              <a href="index.html" class="sidebar-nav-link active">
                <span class="sidebar-nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                
                </span>
                  <router-link to="/ad-calendar" href="#" class="nav-link">
                  Đặt lịch admin
                </router-link>
              </a>
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