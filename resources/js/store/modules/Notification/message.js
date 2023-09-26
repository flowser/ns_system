//message module

const state = {
    message: JSON.parse(localStorage.getItem('storedmessage')) || {},
    messages:  JSON.parse(localStorage.getItem('storedmessages')) || [],
};
const getters = {
    Message(state) {
        return state.message;
    },
    Messages(state) {
        return state.messages;
    },
};
const actions = {
    message(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedmessage');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Messages.length){
                        // let response = context.getters.Messages.filter(message => message.id === payload.id);
                        // console.log(response[0])
                        let response = context.getters.Messages.find(message => message === payload);
                        context.commit('message', response);
                        resolve(response);
                    }
                });
        }
    },
    Messages(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                if(context.getters.Messages.length){
                    resolve(context.getters.Messages);
                }else{
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                        axios.get(url)
                            .then((response) => {
                                context.commit('messages', response.data.messages);
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
    addMessage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('addmessage', response.data.message);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateMessage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('addmessage', response.data.message);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    addFrontMessage(context, payload){
        return new Promise((resolve, reject) =>{
            payload.post(payload.createurl)
            .then((response)=>{
                // context.commit('addmessage', response.data.message);
                resolve(response);
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    deleteMessage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get(payload.deleteurl + payload.id)
                .then((response)=>{
                        context.commit('messages', response.data.messages);
                        resolve(response);
                })
                .catch(error => {
                    console.log(error, 'errortext')
                    reject(error);
                });
            }
        });
    },

}
const mutations = {
    message(state, data) {
        localStorage.setItem('storedmessage', JSON.stringify(data));
        return state.message  =  JSON.parse(localStorage.getItem('storedmessage'));
    },
    messages(state, data){
       localStorage.setItem('storedmessages', JSON.stringify(data));
       return state.messages  =  JSON.parse(localStorage.getItem('storedmessages'));
    },
    addmessage(state, data) {
        let storedmessages = JSON.parse(localStorage.getItem('storedmessages'));
        storedmessages.push(data);
        localStorage.setItem('storedmessages', JSON.stringify(storedmessages));
        return state.messages =  JSON.parse(localStorage.getItem('storedmessages'));
    },
    updatemessage(state, data){
        let storedmessages = JSON.parse(localStorage.getItem('storedmessages'));
        const index = storedmessages.findIndex(message => message.type === data.type);
        storedmessages.splice(index, 1, data);

        localStorage.setItem('storedmessages', JSON.stringify(storedmessages));
        return state.messages  =  JSON.parse(localStorage.getItem('storedmessages'));
    },
    deletemessage(state, data){
        let storedmessages = JSON.parse(localStorage.getItem('storedmessages'));
        const index = storedmessages.findIndex(message => message.id === data.id);
        var newdata = storedmessages.splice(index, 1)

        localStorage.setItem('storedmessages', JSON.stringify(newdata));
        return state.messages  =  JSON.parse(localStorage.getItem('storedmessages'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};


























