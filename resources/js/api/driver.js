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

    dataCarrier(data) {
        return axios.post("/dataCarrier", data);
    },
};
