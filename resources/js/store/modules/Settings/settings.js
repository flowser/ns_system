//businesssetting module

const state = {
    businesssetting: JSON.parse(localStorage.getItem('storedbusinesssetting')) || {},
    // businesssetting: {},
    // businesssettings:  [],
    businesssettings:  JSON.parse(localStorage.getItem('storedbusinesssettings')) || [],
};
const getters = {
    Businesssetting(state) {
        return state.businesssetting;
    },
    Businesssettings(state) {
        return state.businesssettings;
    },
};
const actions = {
    businesssetting(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedbusinesssetting');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Businesssettings.length){
                        // let response = context.getters.Businesssettings.filter(businesssetting => businesssetting.id === payload.id);
                        // console.log(response[0])
                        let response = context.getters.Businesssettings.find(businesssetting => businesssetting === payload);
                        context.commit('businesssetting', response);
                        resolve(response);
                    }
                });
        }
    },
    Businesssettings(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                if(context.getters.Businesssettings.length){
                    resolve(context.getters.Businesssettings);
                }else{
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                        axios.get(url)
                            .then((response) => {
                                context.commit('businesssettings', response.data.businesssettings);
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
    addBusinesssetting(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('addbusinesssetting', response.data.businesssetting);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateBusinesssettingroutes(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateroutesurl)
                .then((response)=>{

                    // context.commit('businesssettings', response.data.businesssettings);
                    console.log("🚀 ~ file: settings.js:77 ~ .then ~ response.data:", response.data)
                    // resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateBulkBusinesssetting(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.bulkupdateurl)
                .then((response)=>{
                    context.commit('businesssettings', response.data.businesssettings);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateBusinesssetting(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('updatebusinesssetting', response.data.businesssetting);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deleteBusinesssetting(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get(payload.deleteurl + payload.id)
                .then((response)=>{
                        context.commit('businesssettings', response.data.businesssettings);
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
    businesssetting(state, data) {
        localStorage.setItem('storedbusinesssetting', JSON.stringify(data));
        return state.businesssetting  =  JSON.parse(localStorage.getItem('storedbusinesssetting'));
    },
    businesssettings(state, data){
       localStorage.setItem('storedbusinesssettings', JSON.stringify(data));
       return state.businesssettings  =  JSON.parse(localStorage.getItem('storedbusinesssettings'));
    },
    addbusinesssetting(state, data) {
        let storedbusinesssettings = JSON.parse(localStorage.getItem('storedbusinesssettings'));
        storedbusinesssettings.push(data);
        localStorage.setItem('storedbusinesssettings', JSON.stringify(storedbusinesssettings));
        return state.businesssettings =  JSON.parse(localStorage.getItem('storedbusinesssettings'));
    },
    updatebusinesssetting(state, data){
        let storedbusinesssettings = JSON.parse(localStorage.getItem('storedbusinesssettings'));
        const index = storedbusinesssettings.findIndex(businesssetting => businesssetting.type === data.type);
        storedbusinesssettings.splice(index, 1, data);

        localStorage.setItem('storedbusinesssettings', JSON.stringify(storedbusinesssettings));
        return state.businesssettings  =  JSON.parse(localStorage.getItem('storedbusinesssettings'));
    },
    deletebusinesssetting(state, data){
        let storedbusinesssettings = JSON.parse(localStorage.getItem('storedbusinesssettings'));
        const index = storedbusinesssettings.findIndex(businesssetting => businesssetting.id === data.id);
        var newdata = storedbusinesssettings.splice(index, 1)

        localStorage.setItem('storedbusinesssettings', JSON.stringify(newdata));
        return state.businesssettings  =  JSON.parse(localStorage.getItem('storedbusinesssettings'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};

























