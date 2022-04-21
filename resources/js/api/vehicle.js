export default {
    newVehicle(data) {
        return axios.post("/newVehicle", data);
    },

    updateVehicle(data) {
        return axios.post("/updateVehicle", data);
    },

    deleteVehicle(data) {
        return axios.post("/deleteVehicle", data);
    },

    activateVehicle(data) {
        return axios.post("/activateVehicle", data);
    },

    dataVehicle(data) {
        return axios.post("/dataVehicle", data);
    },
};
