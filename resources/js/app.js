require('./bootstrap');
window.Vue = require('vue');
//import
import Layout from './components/Layouts/main.vue';
import route from './Router';

import jQuery from "jquery";

window.jQuery = window.$ = jQuery

import UI from 'element-ui';
import VueRouter from 'vue-router';

import store from './Store/main'
import lang from 'element-ui/lib/locale/lang/vi'
import locale from 'element-ui/lib/locale'
//v-form
import { Form, HasError, AlertError } from 'vform';

//excel
import JsonExcel from 'vue-json-excel';


import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.charts';

//import the theme VueFusionCharts
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion'

// register VueFusionCharts component
Vue.use(VueFusionCharts, FusionCharts, Charts, FusionTheme)
window.Form = Form;
Vue.component('downloadExcel', JsonExcel);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
locale.use(lang);
Vue.use(route);
Vue.use(UI);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// initialize(store, router);

const app = new Vue({
    el: '#app',
    router: route,
    store,
    template: '<Layout></Layout>',
    components: {
        // Scheduler
        Layout
    }
});