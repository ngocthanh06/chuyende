import Vue from 'vue';
import moment from 'moment';

export default function formatDay(time) {
    if (time) {
        return moment(String(time)).format('DD');
    }
}

Vue.filter('formatMoney', function(monney) {
    return monney.toLocaleString('it-IT', {style: 'currency', currency: 'VND' });
});
