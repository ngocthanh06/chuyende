import Axios from "axios"

export default {
    state: { 
        listUser: []
    },
    
    getters: {
        listUser: state => state.listUser,
    },
    
    actions: { 
        
    },

    mutations: { 
        setListUser(state, listUser) {
          Axios.get(route('api.list.user')).then(res => {
            console.log(res);
          });
        },
    }

}