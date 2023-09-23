import { createStore } from 'vuex'
import login from './modules/Auth/login';
import payment from './modules/Payment/payment';
// settings
import businesssettings from './modules/Settings/settings';
import pages from './modules/Settings/pages';
export const store = createStore({
    modules: {
        //auth
        login,
        //default
        payment,

        //settings
        businesssettings,
        pages,
    }
});




