export default {
    newDriver(data) {
        return axios.post("/newVehicle", data);
    },

    updateDriver(data) {
        return axios.post("/updateVehicle", data);
    },

    deleteDriver(data) {
        return axios.post("/deleteVehicle", data);
    },
    dataCarrier(data) {
        return axios.post("/dataVehicle", data);
    },
};
