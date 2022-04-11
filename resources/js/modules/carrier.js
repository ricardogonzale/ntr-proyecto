import carrierApi from "../api/carrier.js";

export default {
    state: {
        carriers: [],
    } /* END OF STATE */,

    getters: {} /* END OF GETTERS */,

    mutations: {
        SET_CARRIERSDATA(state, carriers) {
            state.carriers = carriers;
        },
    } /* END OF MUTATIONS */,

    actions: {
        async getCarrier({ commit }) {
            await axios.get("/getCarrierlist").then((response) => {
                commit("SET_CARRIERSDATA", response.data);
            });
        },

        registerCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .registerCarrier(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .updateCarrier(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteCarrier({ commit }, data) {
            return new Promise((resolve, reject) => {
                carrierApi
                    .deleteCarrier(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    } /* END OF ACTIONS */,
};
