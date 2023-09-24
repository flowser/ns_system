//login
namespaced: true;
const state = {
        access_token       : JSON.parse(localStorage.getItem('access_token')) || null,
        expires_in         : JSON.parse(localStorage.getItem('expires_in')) || null,
        refresh_token      : JSON.parse(localStorage.getItem('refresh_token')) || null,
        token_type         : JSON.parse(localStorage.getItem('token_type')) || null,

        user               : JSON.parse(localStorage.getItem('storeduser')) || null,
        passwordresetemail : JSON.parse(localStorage.getItem('passwordresetemail')) || null,
        roles              : JSON.parse(localStorage.getItem('storedroles')) || [],
        permissions        : JSON.parse(localStorage.getItem('storedpermissions')) || [],
        dashboard          : JSON.parse(localStorage.getItem('storeddashboard')) || null,

    };
const getters = {
        Passwordresetemail(state) {
            return state.passwordresetemail;
        },
        Token(state) {
            return state.access_token;
        },
        Tokenexpiry(state) {
            return state.expires_in;
        },
        Refreshtoken(state) {
            return state.refresh_token;
        },
        Auth(state){
            return state.access_token !== null;
        },
        AuthUser(state){
            return state.user;
        },
        AuthUserId(state){
            return state.user.id;
        },
        AuthUserRoles(state) {
            return state.roles;
        },
        AuthUserPermissions(state) {
            return state.permissions;
        },
        AuthDashboard(state){
            return state.dashboard;
        },
    };
const actions = {
    login({ commit, dispatch }, payload) {
        return new Promise((resolve, reject) => {
            payload.post('/api/login')
                .then(response => {
                    localStorage.clear();
                    const user           = response.data.user? response.data.user:'';
                    const roles          = response.data.user.roles? response.data.user.roles:[];
                    const permissions    = response.data.user.permissions? response.data.user.permissions:[];
                    // const businesssettings = response.data.user? response.data.businesssettings:[];

                    const Dashboard    = {
                        name:'Dashboard',
                        redirecturl:'/auth/dashboard',
                    };
                    commit('updateToken', response.data.access_token);
                    commit('updateTokenExpiry', response.data.expires_in);
                    commit('updateRefreshToken', response.data.refresh_token);
                    commit('updateTokenType', response.data.token_type);

                    commit('updateUser', user);
                    commit('updateRoles', roles);
                    commit('updatePermissions', permissions);

                    // commit('businesssettings', businesssettings, { root: true });
                    commit('updateDashboard', Dashboard);
                    resolve (response);
                })
                .catch(error => {
                    localStorage.clear();
                    reject(error);
                });
        });
    },
    Roleset(context, roleName){
        return new Promise((resolve, reject) => {
        let Roles = context.getters.AuthUserRoles;
        console.log(roleName, Roles);
            if (Array.isArray(roleName) == true) {
                var role =  roleName.some(ele => Roles.includes(ele));
                console.log('check', role);
                resolve (role);
            } else {
                console.log('check2', role);
                resolve(Roles.indexOf(roleName) !== -1);
            }
        });
    },
    register({ commit }, payload) {
        return new Promise((resolve, reject) => {
            payload.patch('/api/register')
                .then(response => {
                    localStorage.clear();
                    const user           = response.data.user? response.data.user:'';
                    const roles          = response.data.user.roles? response.data.user.roles:[];
                    const permissions    = response.data.user.permissions? response.data.user.permissions:[];
                    // const businesssettings = response.data.user? response.data.businesssettings:[];

                    const Dashboard    = {
                        name:'Dashboard',
                        redirecturl:'/auth/dashboard',
                    };
                    commit('updateToken', response.data.access_token);
                    commit('updateTokenExpiry', response.data.expires_in);
                    commit('updateRefreshToken', response.data.refresh_token);
                    commit('updateTokenType', response.data.token_type);

                    commit('updateUser', user);
                    commit('updateRoles', roles);
                    commit('updatePermissions', permissions);

                    // commit('businesssettings', businesssettings, { root: true });
                    commit('updateDashboard', Dashboard);
                    resolve (response);
                })
                .catch(error => {
                    localStorage.clear();
                    reject(error);
                });
        });
    },
    resetpasswordform({ commit }, payload) {
        return new Promise((resolve, reject) => {
            payload.patch('/api/login/password/reset/form')
                .then(response => {;
                    commit('updatepasswordresetemail', response.data.email);
                    resolve(response)
                })
                .catch(error => {
                    localStorage.clear();
                    reject(error);
                });
        });
    },
    passwordreset({ commit }, payload) {
        return new Promise((resolve, reject) => {
            payload.patch('/api/login/password/reset/' + payload.token)
                .then(response => {;
                    resolve(response)
                })
                .catch(error => {
                    localStorage.clear();
                    reject(error);
                });
        });
    },
    logout(context) { //done only whne logged in
        if (context.getters.Auth) {
            localStorage.clear();
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.access_token;
            return new Promise((resolve, reject) => {
                axios.post('/api/logout')
                    .then(response => {
                        localStorage.clear();
                        window.location.replace('/');
                        resolve(response);
                    })
                    .catch(error => {
                        localStorage.clear();
                        window.location.replace('/');
                        reject(error);
                    });
            });
        }else{
            localStorage.clear();
            window.location.replace('/')
        }
    },
    tokenexpirycheck(context) { //done only whne logged in
        if (context.getters.Auth){
            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.access_token;
            return new Promise((resolve, reject) => {
                axios.post('/api/refreshtoken',{
                    Refreshtoken: context.getters.Refreshtoken
                })
                    .then(response => {
                        // localStorage.clear();
                        context.commit('updateToken',        response.data.access_token);
                        context.commit('updateTokenExpiry',  response.data.expires_in);
                        context.commit('updateRefreshToken', response.data.refresh_token);
                        context.commit('updateTokenType',    response.data.token_type);
                        console.log(response)
                        resolve(response);
                    })
                    .catch(error => {
                        // localStorage.clear();
                        // window.location.replace('/');
                        console.log(error);
                        reject(error);
                    });
            });
        }
    },
};
const mutations = {
    updatepasswordresetemail: (state, passwordresetemail) => {
        localStorage.setItem('passwordresetemail', JSON.stringify(passwordresetemail));
        return state.passwordresetemail  = JSON.parse(localStorage.getItem('passwordresetemail'));
    },
    updateToken: (state, access_token) => {
        localStorage.setItem('access_token', JSON.stringify(access_token));
        return state.access_token  = JSON.parse(localStorage.getItem('access_token'));
    },
    updateTokenExpiry: (state, expires_in) => {
        localStorage.setItem('expires_in', JSON.stringify(expires_in));
        return state.expires_in    = JSON.parse(localStorage.getItem('expires_in'));
    },
    updateRefreshToken: (state, refresh_token) => {
        localStorage.setItem('refresh_token', JSON.stringify(refresh_token));
        return state.refresh_token = JSON.parse(localStorage.getItem('refresh_token'));
    },
    updateTokenType: (state, token_type) => {
        localStorage.setItem('token_type', JSON.stringify(token_type));
        return state.token_type    = JSON.parse(localStorage.getItem('token_type'));
    },
    updateDashboard(state, dashboard) {
        localStorage.setItem('storeddashboard', JSON.stringify(dashboard));
        return state.dashboard = JSON.parse(localStorage.getItem('storeddashboard'));
    },
    getuserid: (state, data) => {
        return state.userid = data;
    },
    destroyToken(state) {
        return state.access_token = null;
    },
    updateUser(state, user) {
        localStorage.setItem('storeduser', JSON.stringify(user));
        return state.user = JSON.parse(localStorage.getItem('storeduser'));
    },
    updateRoles(state, roles) {
        if(roles !== null){
            if(roles.length){
                const arrayroles   = _.map(roles, 'name')
                localStorage.setItem('storedroles', JSON.stringify(arrayroles));
                return state.roles = JSON.parse(localStorage.getItem('storedroles'));
            }
        }
    },
    updatePermissions(state, permissions) {
        if(permissions !== null){
            if(permissions.length){
                const arraypermissions   = _.map(permissions, 'name')
                localStorage.setItem('storedpermissions', JSON.stringify(arraypermissions));
                return state.permissions = JSON.parse(localStorage.getItem('storedpermissions'));
            }
        }
    },
};
export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
