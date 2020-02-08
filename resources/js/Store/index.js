import moment from 'moment';
export default {
    state: {
       district: [],
       numWeek : '',
       company: [],
       EmployerComp : [],
    },
    //xử lý thao tác chức năng
    getters: {
        getDistrict(state){return state.district},
        getNumWeek(state){return state.numWeek},
        getCompany(state){return state.company},
        getEmployerComp(state){return state.EmployerComp}
    },
    //Diễn tả 1 hành động
    actions: {
        allEmployers(context,[pagiSize,currentPage]){
            let uri = `/api/allemployers/${pagiSize}?page=${currentPage}`;
            axios.get(uri).then((res)=>{ context.commit('commitEmployers', res.data)});
        },
        //Lấy tất cả tên công ty
        allCompany(context){
            axios.get('/api/company').then((res)=>{context.commit('commitCompany', res.data)})
        },
        //Lấy số ngày 
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
        },
        
        //Lấy nhân viên với điều kiện công ty
        allEmployerComp(context, id){
            axios.get(`api/empCompany/${id}`).then((res)=>{ context.commit('commitEmpComp',res.data) });
        },
    },
    //Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    //Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: {
        commitEmployers(state,data){state.district = data},
        commitNumWeek(state,data){state.numWeek = data},
        commitCompany(state,data){state.company = data},
        commitEmpComp(state,data){state.EmployerComp = data}
        
    }

}

