import vue from "vue";
import VueRouter from "vue-router";
//login
import login from '../components/Login/login.vue';

//logout
import logout from '../components/Login/logout.vue';


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
vue.use(VueRouter);

export default new VueRouter({
    base: process.env.MIX_PUBLISH_APP_URL,
    routes: [
        {path: '/login', component: login, name: 'login'},
        {path: '/logout', component: logout, name : 'logout'},
        {path: '/hello', component:Setting , name: 'hello'},
        {path:'/employers' ,component: Employers, name: 'employer'},
        {path: '/addEmployer', component: AddEmployer, name: 'addEmployer'},
        {path: '/edit-Employer/:id',component: EditEmployer },
        {path: '/Set-Calendar',component: MainCalendar, name: 'SetCalendar'},
        {path: '/Show-Calam', component : ShowCaLam, name: 'ShowCalam'},
        {path: '/Add-Calam', component : AddCalam, name: 'AddCalam'},
        {path: '/Edit-Calam', component : EditCaLam, name: 'EditCalam'},
        {path: '/demo',component : Demo, name: 'demo'},
        {path: '/ad-calendar', component: adCalendar, name: 'adCalendar'}
        
    ],
    mode: 'history',
})
