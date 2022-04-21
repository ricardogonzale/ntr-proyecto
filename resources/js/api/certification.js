export default {
    newCertification(data) {
        return axios.post("/newCertification", data);
    },

    updateCertification(data) {
        return axios.post("/updateCertification", data);
    },

    deleteCertification(data) {
        return axios.post("/deleteCertification", data);
    },

    activateCertification(data) {
        return axios.post("/activateCertification", data);
    },

    dataCertification(data) {
        return axios.post("/dataCertification", data);
    },
};
