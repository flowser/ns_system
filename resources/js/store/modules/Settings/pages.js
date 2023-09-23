//page module

const state = {
    page: JSON.parse(localStorage.getItem('storedpage')) || {},
    // page: {},
    // pages:  [],
    pages:  JSON.parse(localStorage.getItem('storedpages')) || [],
};
const getters = {
    Page(state) {
        return state.page;
    },
    Pages(state) {
        return state.pages;
    },
};
const actions = {
    Page(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedpage');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Pages.length){
                        // let response = context.getters.Pages.filter(page => page.id === payload.id);
                        // console.log(response[0])
                        let response = context.getters.Pages.find(page => page.slug === payload);
                        context.commit('page', response);
                        resolve(response);
                    }
                });
        }
    },
    Pages(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                if(context.getters.Pages.length){
                    resolve(context.getters.Pages);
                }else{
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                        axios.get(url)
                            .then((response) => {
                                context.commit('pages', response.data.pages);
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
    addPage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('addpage', response.data.page);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updatePageroutes(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.autoupdateurl)
                .then((response)=>{
                    // context.commit('pages', response.data.pages);
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
    updatePage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('pages', response.data.pages);
                    context.commit('businesssettings', response.data.businesssettings, { root: true });
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deletePage(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get(payload.deleteurl + payload.id)
                .then((response)=>{
                        context.commit('pages', response.data.pages);
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
    page(state, data) {
        localStorage.setItem('storedpage', JSON.stringify(data));
        return state.page  =  JSON.parse(localStorage.getItem('storedpage'));
    },
    pages(state, data){
       localStorage.setItem('storedpages', JSON.stringify(data));
       return state.pages  =  JSON.parse(localStorage.getItem('storedpages'));
    },
    addpage(state, data) {
        let storedpages = JSON.parse(localStorage.getItem('storedpages'));
        storedpages.push(data);
        localStorage.setItem('storedpages', JSON.stringify(storedpages));
        return state.pages =  JSON.parse(localStorage.getItem('storedpages'));
    },
    updatepage(state, data){
        let storedpages = JSON.parse(localStorage.getItem('storedpages'));
        const index = storedpages.findIndex(page => page.slug === data.slug);
        storedpages.splice(index, 1, data);

        localStorage.setItem('storedpages', JSON.stringify(storedpages));
        return state.pages  =  JSON.parse(localStorage.getItem('storedpages'));
    },
    deletepage(state, data){
        let storedpages = JSON.parse(localStorage.getItem('storedpages'));
        const index = storedpages.findIndex(page => page.id === data.id);
        var newdata = storedpages.splice(index, 1)

        localStorage.setItem('storedpages', JSON.stringify(newdata));
        return state.pages  =  JSON.parse(localStorage.getItem('storedpages'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};


























