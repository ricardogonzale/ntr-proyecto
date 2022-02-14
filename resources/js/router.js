import Vue from 'vue'
import VueRouter from 'vue-router';
import store from './store.js'
 
Vue.use(VueRouter)

const router = new VueRouter({
  // mode: 'history',
});

router.beforeEach((to, from, next) => {
  store.commit('setloadpage', { loadpage: true });
  next();
});
router.afterEach(() => {
  setTimeout(() => {
    store.commit('setloadpage', { loadpage: false });
  }, 500)
  
})

export default router;