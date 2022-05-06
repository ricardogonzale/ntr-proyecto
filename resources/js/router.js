import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store.js";

import ListSender from "./components/sender/ListSenderComponent.vue";
import ListClients from "./components/clients/ListClientsComponent.vue";
import ListCarriers from "./components/carriers/ListCarriersComponent.vue";
import UpdateDataCarriers from "./components/carriers/UpdateDataCarriersComponent.vue";
import UpdateDataClients from "./components/clients/UpdateDataClientsComponent.vue";
import ListDrivers from "./components/drivers/ListDriversComponent.vue";
import ListVehicle from "./components/vehicle/ListVehicleComponent.vue";
import ListCertification from "./components/certifications/ListCertificationComponent.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: "/listsender",
            name: "Lista de Envios",
            component: ListSender,
        },
        {
            path: "/listclients",
            name: "Listar Clientes",
            component: ListClients,
        },
        {
            path: "/listcarriers",
            name: "Listar Transportistas",
            component: ListCarriers,
        },
        {
            path: "/updatedatacarrier",
            name: "Actualizar Transportista",
            component: UpdateDataCarriers,
        },
        {
            path: "/listdrivers",
            name: "Conductores",
            component: ListDrivers,
        },
        {
            path: "/listvehicles",
            name: "Vehiculos",
            component: ListVehicle,
        },
        {
            path: "/listcertifications",
            name: "Certificaciones",
            component: ListCertification,
        },
        {
            path: "/updatedataclient",
            name: "Actualizar Distribudor",
            component: UpdateDataClients,
        },
    ],
});

router.beforeEach((to, from, next) => {
    store.commit("setloadpage", { loadpage: true });
    next();
});
router.afterEach(() => {
    setTimeout(() => {
        store.commit("setloadpage", { loadpage: false });
    }, 500);
});

export default router;
