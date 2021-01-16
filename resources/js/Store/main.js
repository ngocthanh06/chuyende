import Vue from 'vue';
import Vuex from 'vuex';
import sidebar from './modules/sidebar';
import form from './modules/form';
import auth from './auth';

Vue.use(Vuex);
const store = new Vuex.Store({
    modules: {
        sidebar,
        form,
        auth
    }
});

export default store;
