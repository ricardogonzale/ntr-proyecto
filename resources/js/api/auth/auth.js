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
};
