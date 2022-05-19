export default {
    registerCarrier(data) {
        return axios.post("/newCarrier", data);
    },
    registerCarrierFront(data) {
        return axios.post("/newCarrierFront", data);
    },
    updateCarrier(data) {
        return axios.post("/updateCarrier", data);
    },

    deleteCarrier(data) {
        return axios.post("/deleteCarrier", data);
    },
    dataCarrier(data) {
        return axios.post("/dataCarrier", data);
    },
};
