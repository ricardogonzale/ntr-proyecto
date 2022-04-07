import authApi from "../api/auth/auth.js";

export default {
    state: {
        loadpage: false,
        // the auth state of the user
        loggedIn: false,
        // current logged in user
        user: {},
        userdata: [],
    } /* END OF STATE */,

    getters: {
        loggedIn(state) {
            return state.loggedIn;
        },

        user(state) {
            return state.user;
        },
    } /* END OF GETTERS */,

    mutations: {
        setLoggedIn(state, loggedIn) {
            state.loggedIn = loggedIn;
        },

        setUser(state, user) {
            state.user = user;
        },

        setloadpage: function (state, payload) {
            Vue.set(state, "loadpage", payload.loadpage);
        },

        SET_USERDATA(state, userdata) {
            state.userdata = userdata;
        },
    } /* END OF MUTATIONS */,

    actions: {
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                authApi
                    .login(credentials)
                    .then((res) => {
                        commit("setLoggedIn", true);
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        } /* END OF LOGIN */,

        logout({ commit }) {
            return new Promise((resolve, reject) => {
                authApi
                    .logout()
                    .then((res) => {
                        commit("setLoggedIn", false);
                        // set the user
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        } /* END OF LOGOUT */,

        register({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                authApi
                    .register(credentials)
                    .then((res) => {
                        // commit('setLoggedIn', true);
                        // set the user
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        update({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                authApi
                    .update(credentials)
                    .then((res) => {
                        // commit('setLoggedIn', true);
                        // set the user
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        delete({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                authApi
                    .delete(credentials)
                    .then((res) => {
                        // commit('setLoggedIn', true);
                        // set the user
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async getUserdata({ commit }) {
            await axios.get("/getUserinfo").then((response) => {
                console.log("Aqui");
                if (response.message === "Unauthenticated") {
                    window.location = "/";
                }
                commit("SET_USERDATA", response.data);
            });
        },

        /* END OF LOGOUT */
    } /* END OF ACTIONS */,
};
