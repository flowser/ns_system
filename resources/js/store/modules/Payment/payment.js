//payment module

const state = {
    initpayment: JSON.parse(localStorage.getItem('storedinitpayment')) || {},
    payment: JSON.parse(localStorage.getItem('storedpayment')) || {},
    payments:  [],
    // payments:  JSON.parse(localStorage.getItem('storedpayments')) || [],
};
const getters = {
    Payment(state) {
        return state.payment;
    },
    InitPayment(state) {
        return state.initpayment;
    },
    Payments(state) {
        return state.payments;
    },
};
const actions = {
    payment(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedpayment');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Payments.length){
                        var response = context.getters.Payments.filter(payment => payment.id === payload.id);
                        console.log(response[0])
                        context.commit('payment', response[0]);
                        resolve(response[0]);
                    }else{
                            axios.get(payload.url + payload.id)
                            .then((response) => {
                                context.commit('payment',  response.data.payment);
                                resolve(response);
                        })
                            .catch(error => {
                                console.log(error, 'error');
                                reject(error);
                        });
                    }
                });
        }
    },
    Payments(context, url) {
        // if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                    axios.get(url)
                        .then((response) => {
                            context.commit('payments', response.data.payments);
                            resolve(response);
                        })
                        .catch(error => {
                            console.log(error, 'error');
                            reject(error);
                        });
            });
        // }
    },
    initPayment(context, payload){
        return new Promise((resolve, reject) =>{
            // if (context.rootGetters.Auth) {
                // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.initurl)
                .then((response)=>{
                    context.commit('initpayment', response.data.payment);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            // }
        });
    },
    addPayment(context, payload){
        return new Promise((resolve, reject) =>{
            // if (context.rootGetters.Auth) {
                // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.createurl)
                .then((response)=>{
                    context.commit('addpayment', response.data.payment);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            // }
        });
    },
    updatePayment(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('updatepayment', response.data.payment);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deletePayment(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get(payload.deleteurl + payload.id)
                .then((response)=>{
                        context.commit('payments', response.data.payments);
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
    payment(state, data) {
        localStorage.setItem('storedpayment', JSON.stringify(data));
        return state.payment  =  JSON.parse(localStorage.getItem('storedpayment'));
    },
    payments(state, data){
       localStorage.setItem('storedpayments', JSON.stringify(data));
       return state.payments  =  JSON.parse(localStorage.getItem('storedpayments'));
    },
    initpayment(state, data) {
        localStorage.setItem('storedinitpayment', JSON.stringify(data));
        return state.initpayment  =  JSON.parse(localStorage.getItem('storedinitpayment'));
    },
    addpayment(state, data) {
        let storedpayments = JSON.parse(localStorage.getItem('storedpayments'));
        storedpayments.push(data);
        localStorage.setItem('storedpayments', JSON.stringify(storedpayments));
        return state.payments =  JSON.parse(localStorage.getItem('storedpayments'));
    },
    updatepayment(state, data){
        let storedpayments = JSON.parse(localStorage.getItem('storedpayments'));
        const index = storedpayments.findIndex(payment => payment.id === data.id);
        storedpayments.splice(index, 1, data);

        localStorage.setItem('storedpayments', JSON.stringify(storedpayments));
        return state.payments  =  JSON.parse(localStorage.getItem('storedpayments'));
    },
    deletepayment(state, data){
        let storedpayments = JSON.parse(localStorage.getItem('storedpayments'));
        const index = storedpayments.findIndex(payment => payment.id === data.id);
        var newdata = storedpayments.splice(index, 1)

        localStorage.setItem('storedpayments', JSON.stringify(newdata));
        return state.payments  =  JSON.parse(localStorage.getItem('storedpayments'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};
























