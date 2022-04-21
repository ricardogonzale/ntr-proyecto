export default {
    newDriver(data) {
        return axios.post("/newDriver", data);
    },

    updateDriver(data) {
        return axios.post("/updateDriver", data);
    },

    deleteDriver(data) {
        return axios.post("/deleteDriver", data);
    },

    activateDriver(data) {
        return axios.post("/activateDriver", data);
    },

    dataCarrier(data) {
        return axios.post("/dataCarrier", data);
    },
};
