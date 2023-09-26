//user module

const state = {
    user: JSON.parse(localStorage.getItem('storeduser')) || {},
    users:  JSON.parse(localStorage.getItem('storedusers')) || [],
};
const getters = {
    User(state) {
        return state.user;
    },
    Users(state) {
        return state.users;
    },
};
const actions = {
    user(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storeduser');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Users.length){
                        // let response = context.getters.Users.filter(user => user.id === payload.id);
                        // console.log(response[0])
                        let response = context.getters.Users.find(user => user === payload);
                        context.commit('user', response);
                        resolve(response);
                    }
                });
        }
    },
    Users(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                if(context.getters.Users.length){
                    resolve(context.getters.Users);
                }else{
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                        axios.get(url)
                            .then((response) => {
                                context.commit('users', response.data.users);
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
    addUser(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('adduser', response.data.user);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateUser(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('updateuser', response.data.user);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    addFrontUser(context, payload){
        return new Promise((resolve, reject) =>{
            payload.post(payload.createurl)
            .then((response)=>{
                // context.commit('adduser', response.data.user);
                resolve(response);
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    deleteUser(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get(payload.deleteurl + payload.id)
                .then((response)=>{
                        context.commit('users', response.data.users);
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
    user(state, data) {
        localStorage.setItem('storeduser', JSON.stringify(data));
        return state.user  =  JSON.parse(localStorage.getItem('storeduser'));
    },
    users(state, data){
       localStorage.setItem('storedusers', JSON.stringify(data));
       return state.users  =  JSON.parse(localStorage.getItem('storedusers'));
    },
    adduser(state, data) {
        let storedusers = JSON.parse(localStorage.getItem('storedusers'));
        storedusers.push(data);
        localStorage.setItem('storedusers', JSON.stringify(storedusers));
        return state.users =  JSON.parse(localStorage.getItem('storedusers'));
    },
    updateuser(state, data){
        let storedusers = JSON.parse(localStorage.getItem('storedusers'));
        const index = storedusers.findIndex(user => user.type === data.type);
        storedusers.splice(index, 1, data);

        localStorage.setItem('storedusers', JSON.stringify(storedusers));
        return state.users  =  JSON.parse(localStorage.getItem('storedusers'));
    },
    deleteuser(state, data){
        let storedusers = JSON.parse(localStorage.getItem('storedusers'));
        const index = storedusers.findIndex(user => user.id === data.id);
        var newdata = storedusers.splice(index, 1)

        localStorage.setItem('storedusers', JSON.stringify(newdata));
        return state.users  =  JSON.parse(localStorage.getItem('storedusers'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};



























