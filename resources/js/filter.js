import moment from 'moment';
import { createApp } from 'vue';

const app = createApp({});
app.config.globalProperties.$filters = {
    timeAgo(date) {
      return moment(date).fromNow()
    },
  }
// app.config.globalProperties.$filters = {
//     upText (text) {
//         return text.charAt(0).toUpperCase() + text.slice(1);
//     },
//     dateformat (created) {
//         return moment(created).format('MMM Do YYYY');
//     },
//     datetimeformat (created) {
//         return moment(created).format('MMM Do YYYY h:mm a');
//     },
//     year (created) {
//         return moment(created).format('YYYY');
//     },
//     timeformat (created) {
//         return moment(created).format('h:mm:ss a');
//     },

//     sortlength (text, length, suffix) {
//         return text.substring(0, length) + suffix;
//     },
//     currency (text, currency) {
//         return currency +". "+ text;
//     },

//     createdAt (value) {
//         return moment(value).fromNow();
//     },
//     PassedDaystoExpiry (Expiry_value, createdate_value, ) {
//         var expiryDate = moment(createdate_value).add(Expiry_value, 'd');
//         var now = moment();
//         return expiryDate.diff(now, 'days');
//     },
//     ExpiryDate (Expiry_value, createdate_value, ) {
//         var expiryDate = moment(createdate_value).add(Expiry_value, 'd');
//         return moment(expiryDate).format('MMM Do YYYY');
//     },
//     Today () {
//         var now = moment();
//         return moment(now).format('YYYYMMDDHHmmss');
//     },
//     TodaysDate () {
//         return moment().format('DD/MM/YYYY');
//     },
//     TodaysDueDate (due_value) {
//         return moment().add(due_value, 'days').format('DD/MM/YYYY');
//     },
//     dateformat2 (value) {
//         return moment(value).format('DD/MM/YYYY');
//     },
//     Size (bytes, decimals = 2){
//         if (bytes === 0) return '0 Bytes';
//        const k = 1024;
//        const dm = decimals < 0 ? 0 : decimals;
//        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
//        const i = Math.floor(Math.log(bytes) / Math.log(k));
//        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
//     },
// }


