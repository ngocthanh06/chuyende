export function initialize(store, router){  
    router.beforeEach((to, from, next) => {
        console.log(to)
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = store.state.currentUser;
    if(requiresAuth && !currentUser ){
        return next('/login');
    }
    else if(to.path == '/login' && currentUser){
       return next('/Set-Calendar');
    }
    else
        return next();
    });

    axios.interceptors.response.use(null, (error) => {
        if(error.response.status == 401){
            store.commit('logout');
            router.push('/login');
        } 
    });
    if (store.getters.currentUser) {
        setAuthorization(store.getters.currentUser.token);
    }
}
    // kiểm tra token đăng nhập
    export function setAuthorization(token) {
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
    }