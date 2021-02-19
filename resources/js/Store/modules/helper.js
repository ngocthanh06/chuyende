export default {
    state: {
        loading: true
    },

    getters: {
        getLoading: state => state.loading
    },

    actions: {
        setFalseLoading(context) {
            context.commit('commitLoading', false);
        },

        setTrueLoading(context) {
            context.commit('commitLoading', true);
        }

    },

    mutations: {
        commitLoading(state, data) {
            state.loading = data;
        }
    }
}
