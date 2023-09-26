//notification module

const state = {
    notification: JSON.parse(localStorage.getItem('storednotification')) || {},
    notifications:  JSON.parse(localStorage.getItem('storednotifications')) || [],
};
const getters = {
    Notification(state) {
        return state.notification;
    },
    Notifications(state) {
        return state.notifications;
    },
};
const actions = {
    notification(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storednotification');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Notifications.length){
                        // let response = context.getters.Notifications.filter(notification => notification.id === payload.id);
                        // console.log(response[0])
                        let response = context.getters.Notifications.find(notification => notification === payload);
                        context.commit('notification', response);
                        resolve(response);
                    }
                });
        }
    },
    Notifications(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                if(context.getters.Notifications.length){
                    resolve(context.getters.Notifications);
                }else{
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                        axios.get(url)
                            .then((response) => {
                                context.commit('notifications', response.data.notifications);
                                resolve(response);
                            })
                            .catch(error => {
                                console.log(error, 'error');
                                reject(error);
                            });
                };
            });
        }
    },
    addNotification(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('notifications', response.data.notifications);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateNotification(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('addnotification', response.data.notification);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    markReadNotification(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.markReadurl + payload.id)
                .then((response)=>{
                    context.commit('notifications', response.data.notifications);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },

}
const mutations = {
    notification(state, data) {
        localStorage.setItem('storednotification', JSON.stringify(data));
        return state.notification  =  JSON.parse(localStorage.getItem('storednotification'));
    },
    notifications(state, data){
       localStorage.setItem('storednotifications', JSON.stringify(data));
       return state.notifications  =  JSON.parse(localStorage.getItem('storednotifications'));
    },
    addnotification(state, data) {
        let storednotifications = JSON.parse(localStorage.getItem('storednotifications'));
        storednotifications.push(data);
        localStorage.setItem('storednotifications', JSON.stringify(storednotifications));
        return state.notifications =  JSON.parse(localStorage.getItem('storednotifications'));
    },
    updatenotification(state, data){
        let storednotifications = JSON.parse(localStorage.getItem('storednotifications'));
        const index = storednotifications.findIndex(notification => notification.id === data.id);
        storednotifications.splice(index, 1, data);

        localStorage.setItem('storednotifications', JSON.stringify(storednotifications));
        return state.notifications  =  JSON.parse(localStorage.getItem('storednotifications'));
    },
    deletenotification(state, data){
        let storednotifications = JSON.parse(localStorage.getItem('storednotifications'));
        const index = storednotifications.findIndex(notification => notification.id === data.id);
        var newdata = storednotifications.splice(index, 1)

        localStorage.setItem('storednotifications', JSON.stringify(newdata));
        return state.notifications  =  JSON.parse(localStorage.getItem('storednotifications'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};



























