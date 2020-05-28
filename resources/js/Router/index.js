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
import register from '../components/Login/register.vue';
//shops
import Setting from '../components/thanh.vue'
//Employers
import Employers from '../components/Employers/Show.vue';
import AddEmployer from '../components/Employers/Add.vue';
import EditEmployer from '../components/Employers/Edit.vue';
import MainCalendar from '../components/Calendar/main.vue';
import employerDanger from '../components/Employers/employerDanger';
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
//Phép
import listsPhep from '../components/phep/listPhep';
// user
import infomation from '../components/Users/infomation';
//Show lịch nhân viên
import getLichNv from '../components/LichLamViec/showLich.vue';
//Công
import listCong from '../components/cong/listCong';
//Chức vụ
import listChucvu from '../components/chucVu/show';
import addChucvu from '../components/chucVu/create';
import editChucvu from '../components/chucVu/edit';

import listphepchuaduyet from '../components/phep/phepChuaDuyet';
// reset pasword
import resetPasword from '../components/resetPassword/reset-password';
import password_change from '../components/resetPassword/password';
const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/hello', component: Setting, name: 'hello' },
    { path: '/employers', component: Employers, name: 'employer', meta: { requiresAuth: true } },
    { path: '/addEmployer', component: AddEmployer, name: 'addEmployer', meta: { requiresAuth: true } },
    { path: '/edit-Employer/:id', component: EditEmployer, meta: { requiresAuth: true } },
    { path: '/Set-Calendar', component: MainCalendar, name: 'SetCalendar', meta: { requiresAuth: true } },
    { path: '/Show-Calam', component: ShowCaLam, name: 'ShowCalam', meta: { requiresAuth: true } },
    { path: '/Add-Calam', component: AddCalam, name: 'AddCalam', meta: { requiresAuth: true } },
    { path: '/Edit-Calam/:id', component: EditCaLam, name: 'EditCalam', meta: { requiresAuth: true } },
    { path: '/demo', component: Demo, name: 'demo', meta: { requiresAuth: true } },
    { path: '/ad-calendar', component: adCalendar, name: 'adCalendar', meta: { requiresAuth: true } },
    { path: '/404', component: pageErrors, name: '404' },
    { path: '/homepage', component: homepage, name: 'homepage', meta: { requiresAuth: true } },
    { path: '/list-calendar', component: listcalendar, name: 'listcalendar', meta: { requiresAuth: true } },
    { path: '/getChinhanh', component: getChiNhanh, name: 'getChinhnanh', meta: { requiresAuth: true } },
    { path: '/editChiNhanh/:id', component: editChinhanh, name: 'editChinhanh', meta: { requiresAuth: true } },
    { path: '/addChinhanh', component: addChinhanh, name: 'addChinhnanh', meta: { requiresAuth: true } },
    { path: '/getLichNv', component: getLichNv, name: 'getLichNv', meta: { requiresAuth: true } },
    { path: '/listPhep', component: listsPhep, name: 'listPhep', meta: { requiresAuth: true } },
    { path: '/infomation', component: infomation, name: 'infomation', meta: { requiresAuth: true } },
    { path: '/infoUser/:id', component: infomation, name: 'infoUser', meta: { requiresAuth: true } },
    { path: '/listCong', component: listCong, name: 'listCong', meta: { requiresAuth: true } },
    { path: '/employerDanger', component: employerDanger, name: 'employerDanger', meta: { requiresAuth: true } },
    { path: '/listChucvu', component: listChucvu, name: 'listChucvu', meta: { requiresAuth: true } },
    { path: '/addChucvu', component: addChucvu, name: 'addChucvu', meta: { requiresAuth: true } },
    { path: '/editChucvu/:id', component: editChucvu, name: 'editChucvu', meta: { requiresAuth: true } },
    { path: '/editUserNV', component: EditEmployer, name: 'editUser', meta: { requiresAuth: true } },
    { path: '/listphepchuaduyet', component: listphepchuaduyet, name: 'listphepchuaduyet', meta: { requiresAuth: true } },
    { path: '/resetpassword', component: resetPasword, name: 'resetpassword' },
    { path: '/password_change/:id', component: password_change, name: 'passwordChange' },
];
const router = new VueRouter({
    mode: 'history',
    requiresAuth: 'active',
    base: process.env.MIX_PUBLISH_APP_URL,
    routes
});
//Check Login/Louout with Role_id when using Route-Link
router.beforeEach((to, from, next) => {
        let routes = ['/employers', '/Show-Calam', '/Set-Calendar', '/getLichNv', '/listPhep', '/listCong', '/getChinhanh', '/listChucvu'];
        let routeAd = ['/ad-calendar', '/infomation', '/editUserNV', '/Set-Calendar'];
        //Get value meta router-link
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        //Get value userlogin valid access_token
        const currentUser = store.state.currentUser;
        if (requiresAuth && !currentUser) {
            next('/login');
        } else if (currentUser && routes.indexOf(to.path) != -1) {
            if (currentUser.Role_id == 1) { next('/ad-calendar') } else next();
        } else if (currentUser && routeAd.indexOf(to.path) != -1) {
            if (currentUser.Role_id == 2) { next('/employers') } else next();
        } else if (to.path == '/login' && localStorage.access_token || to.path == '/resetpassword') {
            next('/');
        } else {
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
        function(response) {
            return response;
        },
        function(err) {
            // expired token error
            if (err && err.response && err.response.status === 401) {
                localStorage.removeItem('access_token');
                localStorage.removeItem('user');
                // alert('Đăng nhập hết hạn');
                return router.push({
                    name: 'login'
                });
            }
            // validate error
            if (err && err.response && err.response.status === 422) {
                return Promise.reject(err);
            }
            return Promise.reject(err);
        }
    );
}

export default router