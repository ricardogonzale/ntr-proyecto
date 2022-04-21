import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
import auth from "./modules/auth.js";
import carrier from "./modules/carrier.js";
import client from "./modules/client.js";
import driver from "./modules/driver.js";
import vehicle from "./modules/vehicle.js";
import certification from "./modules/certification.js";

export default new Vuex.Store({
    state: {
        loadpage: false,
    } /* END OF STATE */,

    mutations: {
        setloadpage: function (state, payload) {
            Vue.set(state, "loadpage", payload.loadpage);
        },
    } /* END OF MUTATIONS */,

    getters: {
        clients: (state) => {
            return state.clients;
        },
    },
    actions: {} /* END OF ACTIONS */,
    modules: {
        auth,
        carrier,
        client,
        driver,
        vehicle,
        certification,
    },
});
