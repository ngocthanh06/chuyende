require('./bootstrap');
window.Vue = require('vue');
//import
import Layout from './components/Layouts/main.vue';
import route from './Router';

import UI from 'element-ui';
import VueRouter from 'vue-router';
//vuex
import vuex from 'vuex';
Vue.use(vuex);
import storeData from './Store';
const store = new vuex.Store(storeData);
import lang from 'element-ui/lib/locale/lang/vi'
import locale from 'element-ui/lib/locale'
//v-form
import { Form, HasError, AlertError } from 'vform';
import formStore from './Store/form';
const storeform = new vuex.Store(formStore);
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
locale.use(lang);
Vue.use(route);
Vue.use(vuex);
Vue.use(UI);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// initialize(store, router);

const app = new Vue({
    el: '#app',
    router: route,
    store,
    storeform,
    template: '<Layout></Layout>',
    components: {
        // Scheduler
        Layout
    }
});