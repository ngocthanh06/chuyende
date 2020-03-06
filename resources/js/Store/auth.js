import { getLocalUser } from "../helper/auth";
const user = getLocalUser();

export default {
    state: { 
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null, 
    },
    //xử lý thao tác chức năng
    getters: { 
        //authenication
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
    },
    //Diễn tả 1 hành động
    actions: { 
        //authenication
        login(context) {
            context.commit("login");
        },
       
    },
    //Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    //Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: { 
        ///Authenication
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            // state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});
            state.currentUser = payload.user;
            localStorage.setItem("user", JSON.stringify(payload.user));
            localStorage.setItem("access_token", payload.access_token);
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            localStorage.removeItem("access_token");
            state.isLoggedIn = false;
            state.currentUser = null;
        }
        
    }

}

