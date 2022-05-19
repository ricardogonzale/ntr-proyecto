<template>
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-5 mb-md-0">
            <div class="hero-text">
                <h2>Regístrate como distribuidor para publicar tu envío</h2>
                <div class="text-gris font-14 mb-40">
                    En NTR tendrás la oportunidad de encontrar la mejor agencia
                    de transporte para tus envíos y de la forma más rentable,
                    eficiente y rápida posible. Para poder lanzar viajes
                    necesitas estar registrado. <a href="#">Pincha Aquí.</a>
                </div>
                <div>
                    <div class="font-18 mb-5">
                        <i class="la la-check-circle iconcheckhome"></i>El
                        registro es <b>100% gratis</b>
                    </div>
                    <div class="font-18 mb-5">
                        <i class="la la-check-circle iconcheckhome"></i>Máxima
                        <b>fiabilidad </b>y <b>confianza</b>
                    </div>
                    <div class="font-18">
                        <i class="la la-check-circle iconcheckhome"></i
                        ><b>Súmate a la revolución digital</b> del transporte
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <!--Login-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="selector-login">
                    <v-form ref="form" method="POST" @submit.prevent="save()">
                        <div class="card-body">
                            <h3 class="mb-5 font-24">
                                Inicia tu registro aquí:
                            </h3>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Nombre*"
                                        required
                                        v-model="editedItem.name"
                                    />
                                </div>
                                <div class="form-group col-sm-6">
                                    <input
                                        name="lastname"
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Apellidos*"
                                        required
                                        v-model="editedItem.lastaname"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <input
                                    name="email"
                                    type="email"
                                    class="form-control form-control-lg"
                                    placeholder="Email"
                                    required
                                    v-model="editedItem.email"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    name="password"
                                    type="password"
                                    class="form-control form-control-lg"
                                    placeholder="Password"
                                    required
                                    v-model="editedItem.password"
                                />
                            </div>

                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input
                                        name="telephone"
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Telefono*"
                                        required
                                        v-model="editedItem.telephone"
                                    />
                                </div>
                                <div class="form-group col-sm-6">
                                    <select
                                        name="id_country"
                                        class="form-control form-control-lg"
                                        v-model="editedItem.id_country"
                                    >
                                        <option>País*</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-inline agree">
                                    <label
                                        class="checkbox checkbox-outline checkbox-success text-gris font-14"
                                    >
                                        <input
                                            type="checkbox"
                                            name="Checkboxes15"
                                            v-model="terms"
                                        />
                                        <span></span>Acepto los
                                        <a href="#"><u> términos de uso </u></a>
                                        del site</label
                                    >
                                </div>
                            </div>
                            <div class="text-center mb-20">
                                <button
                                    type="submit"
                                    class="btn btn-orange button"
                                    :disabled="isDisabled"
                                >
                                    ACEPTAR
                                </button>
                            </div>
                            <div class="text-center">
                                <a href="/" class="font-14 text-gris"
                                    >¿Ya tienes cuenta? Entra aquí</a
                                >
                            </div>
                        </div>
                    </v-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { validationMixin } from "vuelidate";
import {
    required,
    maxLength,
    minLength,
    email,
} from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    validations: {
        editedItem: {
            name: { required, maxLength: maxLength(255) },
            lastaname: { required, maxLength: maxLength(255) },
            email: { required, email },
            password: { required, minLength: minLength(8) },
            id_country: { required },
            id_province: { required },
        },
    },
    data: () => ({
        dialog: false,
        dialogDelete: false,
        terms: false,
        country: [],
        files: [],
        province: [],
        activity: [],
        value: [],
        editedIndex: -1,
        editedItem: {
            id: null,
            name: "",
            lastaname: "",
            email: "",
            password: "",
            telephone: "",
            id_country: "",
            tradename: "",
            logistic_address: "",
            cif: "",
            id_province: 1,
            activity: "",
        },
        defaultItem: {
            id: null,
            name: "",
            lastaname: "",
            email: "",
            password: "",
            telephone: "",
            id_country: null,
            tradename: "",
            logistic_address: "",
            cif: "",
            id_province: 1,
            activity_memory: [],
            activity: "",
        },
    }),

    computed: {
        isDisabled: function () {
            return (
                !this.terms ||
                !this.editedItem.name ||
                !this.editedItem.lastaname ||
                !this.editedItem.email ||
                !this.editedItem.password ||
                !this.editedItem.telephone ||
                !this.editedItem.id_country
            );
        },
        clients: {
            get() {
                return this.$store.state.client.clients;
            },
        },
        formTitle() {
            return this.editedIndex === -1
                ? "Nuevo Distribuidor"
                : "Editar Distribuidor";
        },
        nameErrors() {
            const errors = [];
            if (!this.$v.editedItem.name.$dirty) return errors;
            !this.$v.editedItem.name.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.name.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
            return errors;
        },
        lastanameErrors() {
            const errors = [];
            if (!this.$v.editedItem.lastaname.$dirty) return errors;
            !this.$v.editedItem.lastaname.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.lastaname.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.editedItem.email.$dirty) return errors;
            !this.$v.editedItem.email.email &&
                errors.push("El formato del correo electrónico es invalido.");
            !this.$v.editedItem.email.required &&
                errors.push("E-mail es obligatorio");
            return errors;
        },
        passwordErrors() {
            const errors = [];
            if (!this.$v.editedItem.password.$dirty) return errors;
            !this.$v.editedItem.password.minLength &&
                errors.push(
                    "La contraseña no debe contener menos de 8 digitos"
                );
            !this.$v.editedItem.password.required &&
                errors.push("Este campo es obligatorio.");
            return errors;
        },
        countryErrors() {
            const errors = [];
            if (!this.$v.editedItem.id_country.$dirty) return errors;
            !this.$v.editedItem.id_country.required &&
                errors.push("Este campo es obligatorio");
            return errors;
        },
        provinceErrors() {
            const errors = [];
            if (!this.$v.editedItem.id_province.$dirty) return errors;
            !this.$v.editedItem.id_province.required &&
                errors.push("Este campo es obligatorio");
            return errors;
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.clients = [];
        },

        editItem(item) {
            this.editedIndex = this.clients.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            console.log(item);
            this.editedIndex = this.clients.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.clients.splice(this.editedIndex, 1);
            this.$store
                .dispatch("delete", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getClients");
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
            this.closeDelete();
        },

        close() {
            this.$v.$reset();
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        getCountry: function () {
            axios.get("/getCountry").then(
                function (response) {
                    this.country = response.data;
                }.bind(this)
            );
        },
        getProvince: function () {
            axios.get("/getProvince").then(
                function (response) {
                    this.province = response.data;
                }.bind(this)
            );
        },
        getActivity: function () {
            axios.get("/getActivity").then(
                function (response) {
                    this.activity = response.data;
                }.bind(this)
            );
        },
        save() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                return;
            }
            let formData = new FormData();
            let rawData = { info: this.editedItem };
            rawData = JSON.stringify(rawData);
            formData.append("data", rawData);

            this.$store
                .dispatch("registerFront", formData)
                .then((res) => {
                    alert(
                        "Te hemos enviado un correo electrónico para activar tu cuenta"
                    );
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
        },
    },
    mounted() {
        this.getCountry();
        this.getProvince();
        this.getActivity();
    },
};
</script>
