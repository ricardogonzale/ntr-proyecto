<template>
    <v-app id="main-layout">
        <div id="kt_header" class="header flex-column header-fixed">
            <!--Header Top-->
            <div class="header-top">
                <div class="container" style="padding: 12px 12px 6px 12px">
                    <div
                        class="align-items-center header-content-logo toogle-content"
                    >
                        <div
                            class="btn btn-icon toogle btn-lg mr-3"
                            id="kt_quick_panel_toggle"
                        >
                            <span class="svg-icon svg-icon-primary svg-icon-2x"
                                ><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo7\dist/../src/media/svg/icons\Text\Menu.svg-->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px"
                                    height="24px"
                                    viewBox="0 0 24 24"
                                    version="1.1"
                                >
                                    <g
                                        stroke="none"
                                        stroke-width="1"
                                        fill="none"
                                        fill-rule="evenodd"
                                    >
                                        <rect
                                            x="0"
                                            y="0"
                                            width="28"
                                            height="28"
                                        ></rect>
                                        <rect
                                            fill="#000000"
                                            x="4"
                                            y="5"
                                            width="24"
                                            height="1"
                                            rx="1.5"
                                        ></rect>
                                        <rect
                                            fill="#000000"
                                            x="4"
                                            y="13"
                                            width="24"
                                            height="1"
                                            rx="1.5"
                                        ></rect>
                                        <rect
                                            fill="#000000"
                                            x="4"
                                            y="21"
                                            width="24"
                                            height="1"
                                            rx="1.5"
                                        ></rect>
                                    </g></svg
                                ><!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="d-lg-flex nav align-self-end" role="logo">
                            <a href="../index.html" class="py-2 px-0 d-block">
                                <img
                                    alt="Logo"
                                    src="https://newtransportrevolution.com/assets/img-ntr/logo-ntr-black.svg"
                                    class="max-h-35px min-w-40px"
                                />
                            </a>
                        </div>
                    </div>
                    <div class="topbar header-content-menu user-content">
                        <!--Nav-->
                        <ul
                            class="d-none d-xl-flex nav align-self-end ml-auto mr-4 font-size-lg"
                            role="tablist"
                        >
                            <li class="nav-item">
                                <a
                                    href="../como-funciona-ntr.html"
                                    class="nav-link py-3 px-4"
                                    >¿Cómo funciona NTR?</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    href="../soporte-form.html"
                                    class="nav-link py-3 px-4"
                                    >Soporte</a
                                >
                            </li>
                        </ul>
                        <!--User-->
                        <div class="topbar-item">
                            <div
                                class="btn btn-icon w-lg-auto d-flex align-items-center btn-lg px-4 user-toggle"
                                id="kt_quick_user_toggle"
                            >
                                <div
                                    class="d-flex flex-column text-right pr-lg-3 nombres"
                                >
                                    <span
                                        class="font-weight-bolder font-size-md d-md-inline"
                                        >Nombre DISTRIUIDOR</span
                                    >
                                </div>

                                <span class="symbol symbol-35">
                                    <span
                                        class="symbol-label font-size-h5 font-weight-bold text-white"
                                        ><MenuUser-component></MenuUser-component
                                    ></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <v-main class="white">
            <v-container class="white" style="padding: 0px 12px 12px 12px">
                <div class="header-bottom">
                    <div class="container">
                        <div
                            class="header-navs header-navs-left"
                            id="kt_header_navs"
                        >
                            <div
                                id="kt_header_menu"
                                class="header-menu header-menu-mobile header-menu-layout-default"
                                v-for="item in itemsMenu"
                                :key="item.title"
                            >
                                <ul class="menu-nav">
                                    <li
                                        class="menu-item menu-item-active"
                                        aria-haspopup="true"
                                        v-for="subItem in item.items"
                                        :key="subItem.title"
                                    >
                                        <router-link
                                            :to="subItem.link"
                                            active-class="active"
                                            class="menu-link"
                                            ><span
                                                class="menu-text"
                                                v-text="subItem.title"
                                            ></span
                                        ></router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <v-row class="pa-4">
                    <!-- Page Content -->
                    <main style="width: 100%">
                        <!--
                            <v-toolbar style="border-radius: 5px">
                            <v-app-bar-nav-icon
                                v-show="mini"
                                @click="drawer = !drawer"
                            ></v-app-bar-nav-icon>
                            <router-link to="/">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            icon
                                            small
                                            color="teal darken-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon color="teal darken-2">
                                                mdi-home
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Inicio</span>
                                </v-tooltip>
                            </router-link>
                            <router-link to="/calendar">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            class="mx-2"
                                            icon
                                            small
                                            color="teal darken-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon color="teal darken-2">
                                                mdi-calendar-blank
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Agenda</span>
                                </v-tooltip>
                            </router-link>
                            <v-spacer></v-spacer>
                            <div class="text-right mr-2">
                                <small
                                    ><span
                                        class="font-weight-bold"
                                        v-text="currentDate"
                                    ></span
                                ></small>
                                <br />
                                <v-icon
                                    small
                                    v-if="onLine != false"
                                    color="green"
                                    >mdi-wifi</v-icon
                                >
                                <v-icon small v-else color="red"
                                    >mdi-wifi-off</v-icon
                                >
                                <small
                                    ><span v-text="currentTime"></span
                                ></small>
                            </div>
                            <v-divider class="mx-4" vertical> </v-divider>
                            <vue-internet-checker
                                @status="status"
                                @event="event"
                            />
                            <v-idle
                                @idle="onidle"
                                @remind="onremind"
                                :reminders="[1200, 2500]"
                                :wait="3000"
                                :duration="3000"
                                style="display: none"
                            />
                            <v-snackbar v-model="ntf_wait">
                                {{ ntf_text }}

                                <template> </template>
                            </v-snackbar>
                            <v-dialog
                                v-model="dlg_expired"
                                persistent
                                max-width="350"
                            >
                                <v-card>
                                    <v-card-title class="text-h5">
                                        ¿Estas en actividad?
                                    </v-card-title>

                                    <v-card-text class="p-4 text-center">
                                        El sistema ha detectado que llevas mucho
                                        tiempo sin actividad, por seguridad tu
                                        sesion sera cerrada.
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-btn
                                            color="green darken-1"
                                            text
                                            @click="dlg_expired = false"
                                        >
                                            Mantener la sesión
                                        </v-btn>

                                        <v-btn
                                            color="green darken-1"
                                            @click="logout"
                                        >
                                            Salir
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                            <div class="text-right mr-4 hidden-sm-and-down">
                                <span class="font-weight-bold"
                                    >Administrador</span
                                >
                                <br /><small>Admin</small>
                            </div>
                            <MenuUser-component></MenuUser-component>
                        </v-toolbar>
                        -->
                        <br />
                        <v-overlay
                            opacity="0.7"
                            :value="onLine == false"
                            class="text-center"
                        >
                            <v-icon x-large color="red">mdi-wifi-off</v-icon>
                            <p>Sin conexión a internet</p>
                            <v-divider></v-divider>
                        </v-overlay>
                        <v-overlay
                            opacity="0.7"
                            :value="this.$store.state.loadpage"
                        >
                            <v-progress-circular
                                :size="70"
                                :width="7"
                                color="purple"
                                indeterminate
                            ></v-progress-circular>
                        </v-overlay>
                        <router-view></router-view>
                    </main>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import vueInternetChecker from "vue-internet-checker";
import moment from "moment";

export default {
    name: "App",
    components: {
        vueInternetChecker,
    },
    data() {
        return {
            dlg_expired: false,
            ntf_wait: false,
            ntf_text: "Haz estado inactivo por más de 10 minutos",
            onLine: null,
            currentDate: null,
            currentTime: null,
            drawer: null,
            overlay: false,
            showingNavigationDropdown: false,
            selectedItem: 0,
            typeUser: null,
            items: [
                {
                    text: "Administrativo",
                    icon: "mdi-account-cog-outline",
                    type: 0,
                    items: [
                        {
                            title: "Distribuidores",
                            icon: "mdi-account-box-multiple",
                            link: "/listclients",
                        },
                        {
                            title: "Transportistas",
                            icon: "mdi-truck-check-outline",
                            link: "/listcarriers",
                        },
                        {
                            title: "Registrar",
                            icon: "mdi-account-plus",
                            link: "/home",
                        },
                        {
                            title: "Notificaciones de Pago",
                            icon: "mdi-cash-multiple",
                            link: "/home",
                        },
                    ],
                },
                {
                    text: "Clientes",
                    icon: "mdi-book-account",
                    type: 1,
                    items: [
                        {
                            title: "Datos de usuario",
                            icon: "mdi-account-sync",
                            link: "/updatedataclient",
                        },
                        {
                            title: "Pujas",
                            icon: "mdi-cube-send",
                            link: "/listsender",
                        },
                        {
                            title: "Buscar transportista",
                            icon: "mdi-clipboard-text-search",
                            link: "/home",
                        },
                    ],
                },
                {
                    text: "Transportista",
                    icon: "mdi-account-hard-hat",
                    type: 2,
                    items: [
                        {
                            title: "Datos de usuario",
                            icon: "mdi-account-sync",
                            link: "/updatedatacarrier",
                        },
                        {
                            title: "Certificados",
                            icon: "mdi-certificate-outline",
                            link: "/listcertifications",
                        },
                        {
                            title: "Transportista",
                            icon: "mdi-card-account-details-outline",
                            link: "/listdrivers",
                        },
                        {
                            title: "Vehículos",
                            icon: "mdi-truck-cargo-container",
                            link: "/listvehicles",
                        },
                        {
                            title: "Mis pujas",
                            icon: "mdi-truck-delivery",
                            link: "/listorder/8",
                        },
                        {
                            title: "Servicios",
                            icon: "mdi-truck-fast",
                            link: "/listorder/8",
                        },
                        {
                            title: "Mis Documentos",
                            icon: "mdi-truck-fast",
                            link: "/listorder/8",
                        },
                    ],
                },
                {
                    text: "Configuración",
                    icon: "mdi-tools",
                    type: 0,
                    items: [
                        {
                            title: "Crear usuario",
                            icon: "mdi-account-plus",
                            link: "/listorder/8",
                        },
                        {
                            title: "Configuracion",
                            icon: "mdi-wrench-clock",
                            link: "/listorder/8",
                        },
                    ],
                },
            ],
        };
    },
    computed: {
        userdatatype() {
            return this.$store.getters.userdatatype;
        },
        itemsMenu: function () {
            const type = this.userdatatype;
            if (type == null) {
                return this.items;
            }
            return this.items.filter((i) => i.type === type);
        },
        mini() {
            switch (this.$vuetify.breakpoint.name) {
                case "xs":
                    return true;
                case "sm":
                    return true;
                case "md":
                    return false;
                case "lg":
                    return false;
                case "xl":
                    return false;
            }
        },
        breakmenu() {
            switch (this.$vuetify.breakpoint.name) {
                case "md":
                    return 1;
                case "lg":
                    return 1;
                case "xl":
                    return 1;
            }
        },
    },
    methods: {
        onidle() {
            this.logout();
        },
        onremind(time) {
            // alert seconds remaining to 00:00
            if (time === 1200) {
                this.dlg_expired = true;
            } else {
                this.ntf_wait = true;
            }
            // alert(time);
        },
        status(ele) {
            // console.log(ele);
            this.onLine = ele;
        },
        event(ele) {
            // console.log(ele);
        },
        updateCurrentTime() {
            this.currentDate = moment().format("dddd D [de] MMMM ");
            this.currentTime = moment().format("LTS");
        },
        logout: function () {
            axios
                .post("logout")
                .then((response) => {
                    if (response.status === 302 || 401) {
                        window.location = "/";
                        console.log("logout");
                    } else {
                        // throw error and go to catch block
                    }
                })
                .catch((error) => {});
        },
    },
    created() {
        this.currentDate = moment().format("dddd D [de] MMMM ");
        this.currentTime = moment().format("LTS");
        setInterval(() => this.updateCurrentTime(), 1 * 1000);
    },
    mounted() {
        this.$store.dispatch("getUserdata");
    },
};
</script>
<style>
.v-application .teal {
    background-color: #ffffff !important;
}
a:hover {
    /* color: #fff; */
    /* background-color: white !important; */
    text-decoration: none;
}
.add-on,
textarea,
input[type="text"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
input[type="file"],
.uneditable-input {
    border-color: #e4e6eb00 !important;
}
</style>
