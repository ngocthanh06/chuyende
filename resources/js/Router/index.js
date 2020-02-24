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
        {path: '/login', component: login},
        {path: '/logout', component: logout},
        {path: '/hello', component:Setting},
        {path:'/employers' ,component: Employers},
        {path: '/addEmployer', component: AddEmployer},
        {path: '/edit-Employer/:id',component: EditEmployer},
        {path: '/Set-Calendar',component: MainCalendar},
        {path: '/Show-Calam', component : ShowCaLam},
        {path: '/Add-Calam', component : AddCalam},
        {path: '/Edit-Calam', component : EditCaLam},
        {path: '/demo',component : Demo},
        {path: '/ad-calendar', component: adCalendar}
        
    ],
    mode: 'history',
})
