import driverApi from "../api/vehicle.js";

export default {
    state: {
        vehicle: [],
        dataVehicle: [],
    },

    getters: {
        getDataVehicle: (state) => {
            return state.dataVehicle;
        },
    },

    mutations: {
        SET_VEHICLES(state, vehicle) {
            state.vehicle = vehicle;
        },
        SET_DRIVERSDATA(state, vehicle) {
            state.vehicle = vehicle;
        },
    },

    actions: {
        async getVehicle({ commit }) {
            await axios.get("/getVehiclelist").then((response) => {
                commit("SET_VEHICLES", response.data);
            });
        },

        getDataVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .dataVehicle(data)
                    .then((res) => {
                        commit("SET_DRIVERSDATA", res.data);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        newVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .newVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        updateVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .updateVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },

        deleteVehicle({ commit }, data) {
            return new Promise((resolve, reject) => {
                driverApi
                    .deleteVehicle(data)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
};
