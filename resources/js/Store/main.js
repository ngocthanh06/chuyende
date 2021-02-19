import Vue from 'vue';
import Vuex from 'vuex';
import sidebar from './modules/sidebar';
import form from './modules/form';
import chat from './modules/chat'
import auth from './auth';
import helper from './modules/helper';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        sidebar,
        form,
        auth,
        chat,
        helper
    }
});

export default store;
