// export default {

//   state: {
//     form: [],
//  },
//  //xử lý thao tác chức năng
//  getters: {
//      getlistForm(state){return state.form}, 
//  },
//  //Diễn tả 1 hành động
//  actions: { 
//       allListFrom(context, id){
//           axios.get(`/api/CalamID/${id}`).then(res=>{context.commit('commitForm', res.data)});
//       }
    
//  },
//  //Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
//  //Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
//  mutations: {
//       commitForm(state,data){state.form = data},  
//  },

// }