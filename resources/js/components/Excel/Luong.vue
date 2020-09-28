<template>
<div>
  <!-- <el-button type="success" @click="handleExcel">Xuất Excel</el-button> -->
    <download-excel  ref="excel"
    class   = "btn btn-success btn-sm"
    :data   = "json_data"
    :fields = "json_fields"
    :worksheet = "permission"
    :name    = "name"
    >
    Xuất Excel
</download-excel>
</div>
</template>

<script> 
import moment from 'moment';
export default { 
  data() {
    return {
      name: 'Bangluong.xls',
      permission:'Lương tháng',
      json_fields: {
            'STT': 'STT',
            'Họ và tên': 'hoten',
            'Chức vụ': 'chucvu',
            'Hệ số': 'heso',
            'Lương/ca': 'luongca',
            'Số công làm': 'conglam',
            'Thu nhập': 'thunhap',
            'Công tạm ứng': 'tamung',
            'Thưởng': 'thuong',
            'Phạt': 'phat',
            'Thực lĩnh': 'thuclinh',
            'Đã thanh toán': 'thanhtoan',
            'Còn lại': 'conlai',
        },
        json_data: [],
        json_meta: [
            [
                {
                    'key': 'charset',
                    'value': 'utf-8'
                }
            ]
        ],
    };
  },
  
  methods: {
    async handleExcel(days, idComp){
      var arr = [];
      let num = 0;
      let value = {};
      let date = days;
      days == '' ? date = moment().format('MM - YYYY') : date;
      let thongke = await axios.post('/api/thongke', {
        time: days,
        idComp: idComp
      });
      thongke.data.forEach(res => {
        value = {
           'STT' : num ++,
           'hoten' : res.user_fullname,
           'chucvu' : res.role.role_name,
           'heso' : res.role.coefficient,
           'luongca' : res.role.price.toLocaleString('it-IT', { style: 'currency', currency: 'VND'}),
           'conglam' : this.workshilfts(res.workshifts),
           'thunhap' : this.thunhap(res.role.coefficient, res.role.price, res.workshifts),
           'tamung' : this.tamung(res.prepayment),
           'thuong' : this.thuong(res.workshifts).toLocaleString('it-IT', {style: 'currency', currency: 'VND' }),
           'phat' : this.phat(res.workshifts).toLocaleString('it-IT', {style: 'currency', currency: 'VND' }),
           'thuclinh': this.thuclinh(res.role.coefficient,res.role.price,res.workshifts, res.prepayment).toLocaleString('it-IT', { style: 'currency', currency: 'VND'}),
           'thanhtoan': this.dathanhtoan(res.permission).toLocaleString('it-IT', {style: 'currency', currency: 'VND' }),
           'conlai': this.chuathanhtoan(res.permission,res.role.coefficient,res.role.price,res.workshifts, res.prepayment).toLocaleString('it-IT', {style: 'currency', currency: 'VND' }), 
       };
        arr.push(value);
      });
        this.json_data = arr;
        this.name=`Bảng lương tháng ${days}`;
        this.permission = `Lương tháng ${days}` 
    },
    thuclinh(coff, price, works, prepayment) {
      return this.thunhap(coff, price, works) - this.tamung(prepayment) * price + this.thuong(works) - this.phat(works);
    },
    thuong(works) {
      return this.workshilfts(works) > 5 ? 100000 : 0;
    },
    phat(works) {
      return this.workshilfts(works) < 5 ? 0 : 0;
    },
    tamung(prepayment) {
      return prepayment.reduce((wei, val, index, column) => {
        return wei += val.qtycong;
      }, 0);
    },
    
    checkLuong(val, coff, price, works, prepayment){
        return this.chuathanhtoan(val, coff, price, works, prepayment);
    },
    chuathanhtoan(val, coff, price, works, prepayment){
        return this.thuclinh(coff, price, works, prepayment) - this.dathanhtoan(val);
    },
    dathanhtoan(per){
       return per.reduce((wei, val , index, column) => {
         return wei += val.per_total;
       }, 0);
    },
    thunhap(coff, price, works) {
      return coff * price * this.workshilfts(works);
    },
    /**
     * Todo get workshilfts
     */
    workshilfts(val) {
      let works = val.filter((res) => {
        return res.status == 2;
      });
      let number = works.reduce((weight, val, index, column) => {
        return val.formm.form_work > 4 ? weight += 2 : weight += 1;
      }, 0);
      return number;
    },
  },
  
};
</script>

