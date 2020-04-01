import moment from 'moment';
export default function formatDay(time) {
    if (time) {
        return moment(String(time)).format('DD');
    }
}