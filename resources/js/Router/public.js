
import login from '../components/Login/login.vue';
import register from '../components/Login/register.vue';
import resetPasword from '../components/resetPassword/reset-password';
import password_change from '../components/resetPassword/password';
import pageErrors from '../components/404.vue';
import Setting from '../components/thanh.vue';

const routes = [
    { 
        path: '/login', 
        component: login, 
        name: 'login' 
    },

    { 
        path: '/register', 
        component: register, 
        name: 'register' 
    },
    
    { 
        path: '/hello', 
        component: Setting, 
        name: 'hello' 
    },

    { 
        path: '/404', 
        component: pageErrors, 
        name: '404' 
    },

    { 
        path: '/resetpassword', 
        component: resetPasword, 
        name: 'resetpassword' 
    },

    { 
        path: '/password_change/:id', 
        component: password_change, 
        name: 'passwordChange' 
    },
]

export default routes.map(route => {
    const meta = {
        public: true,
        onlyLoggedOut: true,
    };

    return {
        ...route,
        meta
    }
})
;
