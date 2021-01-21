import Employers from '../components/Employers/Show.vue';
import AddEmployer from '../components/Employers/Add.vue';
import EditEmployer from '../components/Employers/Edit.vue';
import MainCalendar from '../components/Calendar/main.vue';
import employerDanger from '../components/Employers/employerDanger';
import AddCalam from '../components/CaLam/Add.vue';
import ShowCaLam from '../components/CaLam/Show.vue';
import EditCaLam from '../components/CaLam/Edit.vue';
import adCalendar from '../components/Calendar/Admin.vue';
import Demo from '../components/thanh.vue';
import homepage from '../components/home.vue';
import listcalendar from '../components/Calendar/ListCalendarEmployer.vue';
import getChiNhanh from '../components/ChiNhanh/showChinhanh.vue';
import editChinhanh from '../components/ChiNhanh/editChinhanh.vue';
import addChinhanh from '../components/ChiNhanh/addChinhanh.vue';
import listsPhep from '../components/phep/listPhep';
import infomation from '../components/Users/infomation';
import getLichNv from '../components/LichLamViec/showLich.vue';
import listCong from '../components/cong/listCong';
import listChucvu from '../components/chucVu/show';
import addChucvu from '../components/chucVu/create';
import editChucvu from '../components/chucVu/edit';
import listphepchuaduyet from '../components/phep/phepChuaDuyet';
import Messages from '../components/Messages';

const routes = [
    { 
        path: '/employers', 
        component: Employers, 
        name: 'employer', 
    },

    {
        path: '/messages',
        component: Messages,
        name: 'Messages'
    },

    { 
        path: '/addEmployer', 
        component: AddEmployer, 
        name: 'addEmployer', 
    },

    { 
        path: '/edit-Employer/:id', 
        component: EditEmployer, 
    },
    
    { 
        path: '/Set-Calendar', 
        component: MainCalendar, 
        name: 'SetCalendar', 
    },

    { 
        path: '/Show-Calam', 
        component: ShowCaLam, 
        name: 'ShowCalam', 
    },

    { 
        path: '/Add-Calam', 
        component: AddCalam, 
        name: 'AddCalam', 
    },

    { 
        path: '/Edit-Calam/:id', 
        component: EditCaLam, 
        name: 'EditCalam', 
    },

    { 
        path: '/demo', 
        component: Demo, 
        name: 'demo', 
    },

    { 
        path: '/ad-calendar', 
        component: adCalendar, 
        name: 'adCalendar', 
    },

    { 
        path: '/homepage', 
        component: homepage, 
        name: 'homepage', 
    },

    { 
        path: '/list-calendar', 
        component: listcalendar, 
        name: 'listcalendar', 
    },

    { 
        path: '/getChinhanh', 
        component: getChiNhanh, 
        name: 'getChinhnanh', 
    },

    { 
        path: '/editChiNhanh/:id', 
        component: editChinhanh, 
        name: 'editChinhanh', 
    },

    { 
        path: '/addChinhanh', 
        component: addChinhanh, 
        name: 'addChinhnanh', 
    },

    { 
        path: '/getLichNv', 
        component: getLichNv, 
        name: 'getLichNv', 
    },

    { 
        path: '/listPhep', 
        component: listsPhep, 
        name: 'listPhep', 
    },

    { 
        path: '/infomation', 
        component: infomation, 
        name: 'infomation', 
    },

    { 
        path: '/infoUser/:id', 
        component: infomation, 
        name: 'infoUser', 
    },

    { 
        path: '/listCong', 
        component: listCong, 
        name: 'listCong', 
    },

    { 
        path: '/employerDanger', 
        component: employerDanger, 
        name: 'employerDanger', 
    },

    { 
        path: '/listChucvu', 
        component: listChucvu, 
        name: 'listChucvu', 
    },

    { 
        path: '/addChucvu', 
        component: addChucvu, 
        name: 'addChucvu', 
    },

    { 
        path: '/editChucvu/:id', 
        component: editChucvu, 
        name: 'editChucvu', 
    },

    { 
        path: '/editUserNV', 
        component: EditEmployer, 
        name: 'editUser', 
    },

    { 
        path: '/listphepchuaduyet', 
        component: listphepchuaduyet, 
        name: 'listphepchuaduyet', 
    },
];

export default routes.map(route => {
    return {
        ...route,
        meta: {
            public: false
        }
    }
})
