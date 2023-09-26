
import { createRouter, createWebHistory } from "vue-router";
//guest
import Home from './pages/frontend/home.vue';
import Contact from './pages/frontend/contact.vue';
import Login from './pages/frontend//auth/login.vue';
import Register from './pages/frontend//auth/register.vue';
import ForgotPassword from './pages/frontend//auth/forgotpassword.vue';
import ForgotPasswordResponse from './pages/frontend//auth/forgotpasswordresponse.vue';
import PasswordResetLink from './pages/frontend//auth/passwordresetlink.vue';

// authenticated
import Dashboard from './pages/backend/dashboard.vue';
// website settings
import Messages from './pages/backend/message.vue';
import Notifications from './pages/backend/notification.vue';

const routes = [

    //guest
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'About HillMan Paints Ltd',
        }
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact,//
        // component: () =>
            // import ( /* webpackChunkName: "Contact" */ './pages/frontend/contact.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Get intouch with us',
        },
    },
    // guest
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Login to our System',
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Get Registered with us',
        }
    },
    {
        path: '/forgotpassword',
        name: 'Forgot Password',
        component: ForgotPassword,
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Reset Your Password Here',
        }
    },
    {
        path: '/forgotpassword/response',
        name: 'Forgot Password Response',
        component: ForgotPasswordResponse,
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Check Your Email For password Reset Link',
        }
    },
    {
        path: '/forgotpassword/reset/link/:id/:token',
        name: 'Password Reset Link',
        component: PasswordResetLink,
        params:{
            id:'',
            token:'',
        },
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Password Reset Link',
        }
    },
    // authenticated
    {
        path: '/auth/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/messages',
        name: 'Messages',
        component: Messages,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/notifications',
        name: 'Notifications',
        component: Notifications,
        meta: {
            requiresAuth: true,
        }
    },
];

export default createRouter({
    history: createWebHistory(),
    routes: routes,
  });




