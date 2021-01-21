import Vue from 'vue';
import Vuex from 'vuex';
import sidebar from './modules/sidebar';
import form from './modules/form';
import chat from './modules/chat'
import auth from './auth';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        sidebar,
        form,
        auth,
        chat
    }
});

export default store;
