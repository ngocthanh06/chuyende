import moment from 'moment';
export default {
    state: {
       district: [],
       numWeek : '',
    },
    //xử lý thao tác chức năng
    getters: {
        getDistrict(state){return state.district},
        getNumWeek(state){return state.numWeek},
    },
    //Diễn tả 1 hành động
    actions: {
        allEmployers(context,[pagiSize,currentPage]){
            let uri = `/api/allemployers/${pagiSize}?page=${currentPage}`;
            axios.get(uri).then((res)=>{ context.commit('commitEmployers', res.data)});
        },
        SetNumWeek(context,data){
            let numsDay = [];
            let scheldule = [];
            scheldule.push({
                days:Array(7).fill(0).map((n, i) => moment().week(data).startOf('isoWeek').clone().add(n + i, 'day'))
            });
            scheldule.forEach( 
                (date) => { 
                    date.days.forEach( 
                        (d, index) => {
                            numsDay[index] = d.lang('vi').format('dd D/M') 
                        }                    
                    )
                }
            );
            context.commit('commitNumWeek',numsDay);
        }
    },
    //Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    //Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: {
        commitEmployers(state,data){state.district = data},
        commitNumWeek(state,data){state.numWeek = data}
    }

}

