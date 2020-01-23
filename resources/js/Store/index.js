export default {
    state: {
       district: [],
       address: [],
       users: [],
    },
    //xử lý thao tác chức năng
    getters: {
        getDistrict(state){return state.district},
    },
    //Diễn tả 1 hành động
    actions: {
        allEmployers(context,[pagiSize,currentPage]){
            let uri = `/api/allemployers/${pagiSize}?page=${currentPage}`;
            axios.get(uri).then((res)=>{ context.commit('commitEmployers', res.data)});
        },
    },
    //Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    //Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: {
        commitEmployers(state,data){state.district = data},
    }

}

