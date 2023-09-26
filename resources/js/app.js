import './bootstrap';
import { createApp } from 'vue';

// default imports
import {store} from "./store/index";
import router from './router';
import Roles from './components/essentials/Roles.vue';
import Auth from './components/essentials/Auth.vue';
import Others from './components/essentials/Others.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

// import variables
import FrontendComponent from './components/FrontendComponent.vue';
import BackendComponent from './components/BackendComponent.vue';
import Form from 'vform';
import {  Button,  HasError,  AlertError,  AlertErrors,  AlertSuccess} from 'vform/src/components/bootstrap5';
  // 'vform/src/components/bootstrap4'
  // 'vform/src/components/tailwind'

import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';

import LoadScript from "vue-plugin-load-script";
import Swal from 'sweetalert2';
import veProgress from "vue-ellipse-progress";
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';
import VueGoodTablePlugin from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

import DateFormat from '@voidsolutions/vue-dateformat';
import timeago from 'vue-timeago3'
import TextClamp from 'vue3-text-clamp';





const app = createApp({});

//constants
//  //tel-input
const globalOptions = {
    mode: 'auto',
    onlyCountries:['Ke'],
    autoFormat:true,
    inputOptions: {
      maxlength:'12',
      placeholder:'Enter A Phone Number',
      validCharactersOnly:true
    },
   };
// define your QuillEditor options
const quileditglobalOptions = {
    debug: 'info',
    contentType:'Delta',
    modules: {
      toolbar: 'full'
    },
    placeholder: 'Compose an epic...',
    readOnly: false,
    theme: 'snow'
  }
  // set default globalOptions prop
  QuillEditor.props.globalOptions.default = () => quileditglobalOptions;

//toast sweetalert2
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    width:500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
 });
 //Toast vue-toastification
 const options = {
    // You can set your default options here
 };

app.component('QuillEditor', QuillEditor);
app.component('QuillEditor', QuillEditor);
app.component('guestmaster', FrontendComponent);
app.component('authmaster', BackendComponent);

app.component('Multiselect', Multiselect);
app.component(Button.name, Button);
app.component(HasError.name, HasError);
app.component(AlertError.name, AlertError);
app.component(AlertErrors.name, AlertErrors);
app.component(AlertSuccess.name, AlertSuccess);

// Vue.mixin
app.mixin(Roles);
app.mixin(Auth);
app.mixin(Others);
//global access
window.Form = Form;
window.Swal  = Swal;
window.toast = toast;




// define options
const timeagoOptions = {
    converterOptions: {
        includeSeconds: false,
    }
  };

// app.use(intasend);
app.use(timeago, timeagoOptions);
app.use(TextClamp);
app.use(DateFormat);
app.use(LoadScript);
app.use(Toast, options);
app.use(veProgress);
//  app.use(plugin, defaultConfig);
app.use(ToastPlugin);
//  app.use(CAlert);
app.use(LoadingPlugin);
app.use(VueGoodTablePlugin);
app.use(VueTelInput, globalOptions); // Define default global options here (optional)
 app.use(router);
 app.use(store);
// app.use(Vueform, vueformConfig);
app.mount('#app');
