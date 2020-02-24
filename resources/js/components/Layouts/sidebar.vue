<template>
   <div class="adminx-sidebar expand-hover push">
          <ul class="sidebar-nav">
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
    
}
</script>