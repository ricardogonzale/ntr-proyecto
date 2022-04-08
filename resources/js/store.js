import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
import auth from "./modules/auth.js";
export default new Vuex.Store({
    state: {
        loadpage: false,
        userdata: [],
        clients: [],
        carriers: [],
    } /* END OF STATE */,

    mutations: {
        setloadpage: function (state, payload) {
            Vue.set(state, "loadpage", payload.loadpage);
        },

        SET_USERDATA(state, userdata) {
            state.userdata = userdata;
        },
        SET_CLIENTSDATA(state, clients) {
            state.clients = clients;
        },
        SET_CARRIERSDATA(state, carriers) {
            state.carriers = carriers;
        },
    } /* END OF MUTATIONS */,

    getters: {
        clients: (state) => {
            return state.clients;
        },
    },
    actions: {
        async getClients({ commit }) {
            await axios.get("/getClientlist").then((response) => {
                commit("SET_CLIENTSDATA", response.data);
            });
        },
        async getCarrier({ commit }) {
            await axios.get("/getCarrierlist").then((response) => {
                commit("SET_CARRIERSDATA", response.data);
            });
        },
        /* END OF LOGOUT */
    } /* END OF ACTIONS */,
    modules: {
        auth,
    },
});
