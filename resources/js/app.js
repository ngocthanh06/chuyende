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

Vue.use(route);
Vue.use(vuex);
Vue.use(UI);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router:route, 
    store
});
