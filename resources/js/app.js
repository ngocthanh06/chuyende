require('./bootstrap');

window.Vue = require('vue');
import jQuery from "jquery";
window.jQuery = window.$ = jQuery

import Layout from './components/Layouts/main.vue';
import router from './Router';
import store from './Store/main'
import lang from 'element-ui/lib/locale/lang/vi'
import UI from 'element-ui';
import locale from 'element-ui/lib/locale'
import { Form, HasError, AlertError } from 'vform';
import JsonExcel from 'vue-json-excel';
import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion'
import './filters/index';

Vue.use(VueFusionCharts, FusionCharts, Charts, FusionTheme)
window.Form = Form;
Vue.component('downloadExcel', JsonExcel);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
locale.use(lang);
Vue.use(UI);

const app = new Vue({
    el: '#app',
    router,
    store,
    template: '<Layout></Layout>',
    components: {
        // Scheduler
        Layout
    }
});