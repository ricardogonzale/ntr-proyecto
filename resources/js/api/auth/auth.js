export default {
    login(credentials) {
        return axios.post("/login", credentials);
    },

    logout() {
        return axios.post("/logout");
    },

    register(credentials) {
        return axios.post("/newClient", credentials);
    },

    update(credentials) {
        return axios.post("/updateClient", credentials);
    },

    delete(credentials) {
        return axios.post("/deleteClient", credentials);
    },
};
