import moment from 'moment';
import auth from './auth';
import form from './form';
export default {
    state: {
        district: [],
        numWeek: '',
        company: [],
        EmployerComp: [],
        DateCaLam: [],
        CaLam: [],
        Role: [],
    },
    // Todo xử lý thao tác chức năng
    getters: {
        getDistrict(state) { return state.district },
        getNumWeek(state) { return state.numWeek },
        getCompany(state) { return state.company },
        getEmployerComp(state) { return state.EmployerComp },
        getDatecaLam(state) { return state.DateCaLam },
        getCaLam(state) { return state.CaLam },
        getRole(state) { return state.Role },
    },
    // Todo Diễn tả 1 hành động
    actions: {
        allEmployers(context, [pagiSize, currentPage]) {
            let uri = `/api/allemployers/${pagiSize}?page=${currentPage}`;
            axios.get(uri).then((res) => { context.commit('commitEmployers', res.data) });
        },
        // Todo Lấy tất cả tên công ty
        allCompany(context) {
            axios.get('/api/company').then((res) => { context.commit('commitCompany', res.data) })
        },
        // Todo Lấy số ngày 
        SetNumWeek(context, data) {
            let numsDay = [];
            let scheldule = [];
            scheldule.push({
                days: Array(7).fill(0).map((n, i) => moment().week(data[0]).weekYear(data[1]).startOf('isoWeek').clone().add(n + i, 'day'))
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
            context.commit('commitNumWeek', numsDay);
        },
        SetDateCaLam(context, data) {

            let numsDay = [];
            let scheldule = [];
            scheldule.push({
                days: Array(7).fill(0).map((n, i) => moment().week(data[0]).weekYear(data[1]).startOf('isoWeek').clone().add(n + i, 'day'))
            });
            scheldule.forEach(
                (date) => {
                    date.days.forEach(
                        (d, index) => {
                            numsDay[index] = d.lang('vi').format('YYYY-MM-DD');
                        }
                    )
                }
            );
            context.commit('commitDateCalam', numsDay);
        },

        // Todo Lấy nhân viên với điều kiện công ty chỉ lấy nhân vi
        allEmployerComp(context, id) {
            axios.get(`api/empCompany/${id}`).then((res) => { context.commit('commitEmpComp', res.data) });
        },

        // Todo Lấy tất cả ca làm
        allCaLam(context) {
            axios.get('/api/CaLam').then((res) => { context.commit('commitCaLam', res.data) })
        },
        allRole(context) {
            axios.get(`/api/Role`).then((res) => { context.commit('commitRole', res.data) });
        },

    },
    // Todo Trạng thái không thể thay đổi trực tiếp mà chỉ thay đổi thông qua commit
    // Todo Từ action thay đổi gọi xuống commit của mutations thông qua context.commit
    mutations: {
        commitEmployers(state, data) { state.district = data },
        commitNumWeek(state, data) { state.numWeek = data },
        commitCompany(state, data) { state.company = data },
        commitEmpComp(state, data) { state.EmployerComp = data },
        commitDateCalam(state, data) { state.DateCaLam = data },
        commitCaLam(state, data) { state.CaLam = data },
        commitRole(state, data) { state.Role = data },


    },

    modules: {
        auth,
        form
    }

}