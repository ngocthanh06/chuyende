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
// import SetCalendar from '../components/Calendar/Setcalendar.vue';
const routes =  [
    {path: '/login', component: login, name: 'login'}, 
    {path: '/hello', component:Setting , name: 'hello'},
    {path:'/employers' ,component: Employers, name: 'employer', meta: {requiresAuth: true} },
    {path: '/addEmployer', component: AddEmployer, name: 'addEmployer',meta: {requiresAuth: true}},
    {path: '/edit-Employer/:id',component: EditEmployer ,meta: {requiresAuth: true}},
    {path: '/Set-Calendar',component: MainCalendar, name: 'SetCalendar', meta: {requiresAuth: true}},
    {path: '/Show-Calam', component : ShowCaLam, name: 'ShowCalam', meta: {requiresAuth: true}},
    {path: '/Add-Calam', component : AddCalam, name: 'AddCalam', meta: {requiresAuth: true}},
    {path: '/Edit-Calam', component : EditCaLam, name: 'EditCalam', meta: {requiresAuth: true}},
    {path: '/demo',component : Demo, name: 'demo'},
    {path: '/ad-calendar', component: adCalendar, name: 'adCalendar', meta: {requiresAuth: true}}
    
];
const router = new VueRouter({ 
    mode: 'history',
    requiresAuth: 'active',
    base: process.env.MIX_PUBLISH_APP_URL,
    routes
}); 

//Check Login/Louout with Role_id when using Route-Link
router.beforeEach((to, from, next) => { 
    //Get value meta router-link
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    //Get value userlogin valid access_token
    const currentUser = store.state.currentUser;   
    if(requiresAuth && !currentUser) {
        next('/login');
    }
    else if( currentUser && to.path =='/employers' || currentUser && to.path =='/Show-Calam' ){
        if(currentUser.Role_id == 1){ next('/Set-Calendar') }
        else next();
    }
    else if(to.path == '/login' && currentUser) {
        next('/Set-Calendar');
    }  
    else  {
        next();
    } 
})
 
export default router