import vue from "vue";
import VueRouter from "vue-router";
//shops
import Setting from '../components/thanh.vue'
//Employers
import Employers from '../components/Employers/Show.vue';
import AddEmployer from '../components/Employers/Add.vue';
import EditEmployer from '../components/Employers/Edit.vue';
vue.use(VueRouter);

export default new VueRouter({
    base: process.env.MIX_PUBLISH_APP_URL,
    routes: [
        {path: '/hello', component:Setting},
        {path:'/employers' ,component: Employers},
        {path: '/addEmployer', component: AddEmployer},
        {path: 'edit-Employer/:id',component: EditEmployer}
        
    ],
    mode: 'history',
})
