require('./bootstrap');
window.Vue = require('vue');
//import
import route from './Router';
import UI from 'element-ui';
//vuex
import vuex from 'vuex';
Vue.use(vuex);
import storeData from './Store';
const store = new vuex.Store(storeData);
import lang from 'element-ui/lib/locale/lang/vi'
import locale from 'element-ui/lib/locale'
//Scheldule
// import '@progress/kendo-ui';
// import '@progress/kendo-theme-default/dist/all.css';
// import { Scheduler } from '@progress/kendo-scheduler-vue-wrapper'
// import { SchedulerResource } from '@progress/kendo-scheduler-vue-wrapper'
// import { SchedulerView } from '@progress/kendo-scheduler-vue-wrapper'
// import { SchedulerInstaller } from '@progress/kendo-scheduler-vue-wrapper'

//DatePicker
import flatpickr from 'flatpickr'
//v-form
import {Form, HasError, AlertError} from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

locale.use(lang);
// Vue.use(SchedulerInstaller);
Vue.use(route);
Vue.use(vuex);
Vue.use(UI);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router:route, 
    store,
    components:{
        // Scheduler
    }
});
