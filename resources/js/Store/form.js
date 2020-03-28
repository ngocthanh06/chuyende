import Axios from "axios";

export default {
    state: {
        attendance: [],
    },
    // Todo xử lý thao tác chức năng
    getters: {
        /**
         * ? Attendances
         * @param state
         */
        getAttendance(state) {
            return state.attendance;
        },
    },
    // Todo Diễn tả 1 hành động
    actions: {
        /**
         * ? Attendances
         * @param context
         * @param data
         */
        async allAttendance(context, data) {
            let list = await Axios.post('/api/listAttendance', { date: data });
            context.commit("commitAttendance", list.data);
        },

    },
    // Todo Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    // Todo Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: {
        /**
         * ? Attendances
         * @param state
         * @param data
         */
        commitAttendance(state, data) {
            state.attendance = data
        },

    }

}