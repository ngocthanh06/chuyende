import vue from "vue";
import VueRouter from "vue-router";
vue.use(VueRouter);
//vuex
import vuex from 'vuex';
vue.use(vuex);
import storeData from '../Store/auth';
const store = new vuex.Store(storeData);
//login
import login from '../components/Login/login.vue';
//shops
import Setting from '../components/thanh.vue'
//Employers
import Employers from '../components/Employers/Show.vue';
import AddEmployer from '../components/Employers/Add.vue';
import EditEmployer from '../components/Employers/Edit.vue';
import MainCalendar from '../components/Calendar/main.vue';
//Calam
import AddCalam from '../components/CaLam/Add.vue';
import ShowCaLam from '../components/CaLam/Show.vue';
import EditCaLam from '../components/CaLam/Edit.vue';
import adCalendar from '../components/Calendar/Admin.vue';
//demo
import Demo from '../components/thanh.vue';
//Calendat
import pageErrors from '../components/404.vue';
import homepage from '../components/home.vue';
import listcalendar from '../components/Calendar/ListCalendarEmployer.vue';
//Chi nhánh
import getChiNhanh from '../components/ChiNhanh/showChinhanh.vue';
import editChinhanh from '../components/ChiNhanh/editChinhanh.vue';
import addChinhanh from '../components/ChiNhanh/addChinhanh.vue';
// import SetCalendar from '../components/Calendar/Setcalendar.vue';
//Show lịch nhân viên
import getLichNv from '../components/LichLamViec/showLich.vue';
const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/hello', component: Setting, name: 'hello' },
    { path: '/employers', component: Employers, name: 'employer', meta: { requiresAuth: true } },
    { path: '/addEmployer', component: AddEmployer, name: 'addEmployer', meta: { requiresAuth: true } },
    { path: '/edit-Employer/:id', component: EditEmployer, meta: { requiresAuth: true } },
    { path: '/Set-Calendar', component: MainCalendar, name: 'SetCalendar', meta: { requiresAuth: true } },
    { path: '/Show-Calam', component: ShowCaLam, name: 'ShowCalam', meta: { requiresAuth: true } },
    { path: '/Add-Calam', component: AddCalam, name: 'AddCalam', meta: { requiresAuth: true } },
    { path: '/Edit-Calam/:id', component: EditCaLam, name: 'EditCalam', meta: { requiresAuth: true } },
    { path: '/demo', component: Demo, name: 'demo' },
    { path: '/ad-calendar', component: adCalendar, name: 'adCalendar', meta: { requiresAuth: true } },
    { path: '/404', component: pageErrors, name: '404' },
    { path: '/homepage', component: homepage, name: 'homepage', meta: { requiresAuth: true } },
    { path: '/list-calendar', component: listcalendar, name: 'listcalendar', meta: { requiresAuth: true } },
    { path: '/getChinhanh', component: getChiNhanh, name: 'getChinhnanh', meta: { requiresAuth: true } },
    { path: '/editChiNhanh/:id', component: editChinhanh, name: 'editChinhanh', meta: { requiresAuth: true } },
    { path: '/addChinhanh', component: addChinhanh, name: 'addChinhnanh', meta: { requiresAuth: true } },
    { path: '/getLichNv', component: getLichNv, name: 'getLichNv', meta: { requiresAuth: true } },
];
const router = new VueRouter({
    mode: 'history',
    requiresAuth: 'active',
    base: process.env.MIX_PUBLISH_APP_URL,
    routes
});
//Check Login/Louout with Role_id when using Route-Link
router.beforeEach((to, from, next) => {
    let routes = ['/employers', '/Show-Calam', '/Set-Calendar']; 
    //Get value meta router-link
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    //Get value userlogin valid access_token
    const currentUser = store.state.currentUser;
    if (requiresAuth && !currentUser) {
        next('/login');
    }
    else if (currentUser && routes.indexOf(to.path) != -1) {
        if (currentUser.Role_id == 1) { next('/ad-calendar') }
        else next();
    }
    else if (to.path == '/login' && localStorage.access_token) {
        next('/home');
    }
    else {
        next();
    }
    if (store.getters.currentUser) {
        setAuthorization();
    }
})
// kiểm tra token đăng nhập
export function setAuthorization() {
    var access_token = localStorage.getItem('access_token');
    axios.defaults.headers.common['Authorization'] = 'Bearer' + access_token;
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    //Xử lý trạng thái token
    axios.interceptors.response.use(
        //Accept
        function (response) {
            return response;
        },
        function (err) { 
            // expired token error
            if (err && err.response && err.response.status === 422) {
                localStorage.removeItem('access_token');
                localStorage.removeItem('user');
                alert(err.response.message);
                return router.push({
                    name: 'login'
                }); 
            }
            // validate error
            if (err && err.response && err.response.status === 422) {
                return Promise.reject(err.response.data);
            }
            return Promise.reject(err);
        }
    );
}

export default router