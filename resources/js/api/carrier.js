export default {
    registerCarrier(data) {
        return axios.post("/newCarrier", data);
    },

    updateCarrier(data) {
        return axios.post("/updateCarrier", data);
    },

    deleteCarrier(data) {
        return axios.post("/deleteCarrier", data);
    },
};
