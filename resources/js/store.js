import Vue  from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
import auth from './modules/auth.js';
export default new Vuex.Store({
    state: {
        loadpage: false,
        userdata: [],
    }, /* END OF STATE */

    mutations: {
        setloadpage: function (state, payload){
            Vue.set(state, 'loadpage', payload.loadpage);
         },

         SET_USERDATA(state, userdata) {
            state.userdata = userdata
         },
    },/* END OF MUTATIONS */

    actions: {
        async getUserdata({ commit }) {
            await axios.get('/getUserinfo')
                  .then(response => {
                     commit('SET_USERDATA', response.data)
            })
         },
        
        /* END OF LOGOUT */
    },/* END OF ACTIONS */
    modules: {
        auth,
    }
});