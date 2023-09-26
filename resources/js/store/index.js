import { createStore } from 'vuex'
import login from './modules/Auth/login';
import message from './modules/Notification/message';
import notification from './modules/Notification/notification';
import user from './modules/User/user';
export const store = createStore({
    modules: {
        //auth
        login,
        notification,
        message,
        user,
    }
});




