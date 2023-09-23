
import { createRouter, createWebHistory } from "vue-router";
//guest
import Home from './pages/frontend/home.vue';
import AboutUS from './pages/frontend/about_us.vue';
import Products from './pages/frontend/products.vue';
    import Productdetails from './pages/frontend/products/product_details.vue';
import Portfolio from './pages/frontend/portfolio.vue';
    import Portfoliodetails from './pages/frontend/portfolios/portfolio_details.vue';
import Team from './pages/frontend/team.vue';
import Contact from './pages/frontend/contact.vue';
import Login from './pages/frontend//auth/login.vue';
import Register from './pages/frontend//auth/register.vue';
import ForgotPassword from './pages/frontend//auth/forgotpassword.vue';

// authenticated
import Dashboard from './pages/backend/dashboard.vue';
// website settings
import HeaderSettings from './pages/backend/websitesettings/headersettings.vue';
import FooterSettings from './pages/backend/websitesettings/footersettings.vue';
import PagesSettings from './pages/backend/websitesettings/pagessettings.vue';
    import HomePagesSettings from './pages/backend/websitesettings/pagesettings/homesettings.vue';
    import AboutPagesSettings from './pages/backend/websitesettings/pagesettings/aboutsettings.vue';

import AppearanceSettings from './pages/backend/websitesettings/appearancesettings.vue';

// main settings
import ProductsSettings from './pages/backend/productportfolio/productsettings.vue';
import PortfolioSettings from './pages/backend/productportfolio/portfoliosettings.vue';
// setup & general configuration
import GeneralSettings from './pages/backend/generalsettings/generalsettings.vue';
import SMPTSettings from './pages/backend/generalsettings/smptsettings.vue';

// usrers & Persmissions
import AllStaff from './pages/backend/userspermission/usersettings.vue';
import StaffPermissions from './pages/backend/userspermission/permissionsettings.vue';
//superadmin settings
import SuperadminSettings from './pages/backend/superadmin/superadmin.vue';

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
        path: '/about',
        name: 'About Us',
        component: AboutUS,
        // component: () =>
            // import ( /* webpackChunkName: "aboutuS" */ './pages/frontend/about.vue'),
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
        path: '/products',
        name: 'Products',
        component: Products,
        // component: () =>
            // import ( /* webpackChunkName: "aboutuS" */ './pages/frontend/about.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'High - Impact Products',
        }
    },
    {
        path: '/products/details/:product',
        name: 'Product Details',
        component: Productdetails,
        // component: () =>
            // import ( /* webpackChunkName: "aboutuS" */ './pages/frontend/about.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'High - Impact Product Detail',
        },
        params:{
            product:'',
        },

    },
    {
        path: '/portfolio',
        name: 'Portfolio',
        component: Portfolio,
        // component: () =>
            // import ( /* webpackChunkName: "aboutuS" */ './pages/frontend/about.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Some of our finest works.',
        }
    },
    {
        path: '/portfolio/details/:portfolio',
        name: 'Portfolio Details',
        component: Portfoliodetails,
        params:{
            portfolio:'',
        },
        // component: () =>
            // import ( /* webpackChunkName: "aboutuS" */ './pages/frontend/about.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Details of Some of our finest works.',
        }
    },
    {
        path: '/team',
        name: 'Team',
        component: Team,//
        // component: () =>
            // import ( /* webpackChunkName: "Team" */ './pages/frontend/team.vue'),
        meta: {
            requiresAuth: false,
            title:'empty',
            description:'empty',
            image:'empty',
            keywords:'empty',
            info: 'Creative Minds',
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
    // authenticated
    {
        path: '/auth/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        }
    },
    // products & Portfolio
    {
        path: '/auth/products/settings',
        name: 'Products Settings',
        component: ProductsSettings,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/portfolio/settings',
        name: 'Portfolio Settings',
        component: PortfolioSettings,
        meta: {
            requiresAuth: true,
        }
    },
    // website setup
    {
        path: '/auth/website/headersettings',
        name: 'Header Settings',
        component: HeaderSettings,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/website/footersettings',
        name: 'Footer Settings',
        component: FooterSettings,
        meta: {
            // requiresAuth: true,
        }
    },
    {
        path: '/auth/website/pagessettings',
        name: 'Pages Settings',
        component: PagesSettings,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/website/pagessettings/:param',
        name: 'Home Settings',
        component: HomePagesSettings,
        params:{
            param:'',
        },
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/website/pagessettings/:param',
        name: 'About Us Settings',
        component: AboutPagesSettings,
        params:{
            param:'',
        },
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/website/appearancesettings',
        name: 'Appearance Settings',
        component: AppearanceSettings,
        meta: {
            requiresAuth: true,
        }
    },

    // general settings & Configuration
    {
        path: '/auth/general/settings',
        name: 'General Settings',
        component: GeneralSettings,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/general/smtpsettings',
        name: 'SMPT Settings',
        component: SMPTSettings,
        meta: {
            requiresAuth: true,
        }
    },
    // users & Permissions
    {
        path: '/auth/staff/all',
        name: 'All Staff',
        component: AllStaff,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/auth/staff/permissions',
        name: 'Staff Permissions',
        component: StaffPermissions,
        meta: {
            requiresAuth: true,
        }
    },
    // superadmin settings
    {
        path: '/auth/superadmin/settings',
        name: 'Superadmin Settings',
        component: SuperadminSettings,
        meta: {
            requiresAuth: true,
        }
    },
];

export default createRouter({
    history: createWebHistory(),
    routes: routes,
  });




