<template>
    <v-card>
        <v-toolbar color="orange" dark
            >{{ formTitle }}
            <v-spacer></v-spacer>
        </v-toolbar>

        <v-card-text class="pt-8">
            <v-form ref="form" method="POST" @submit.prevent="save()">
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="6">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <h6>PERSONA DE CONTACTO</h6>
                                    <br />
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        v-model="editedItem.name"
                                        label="Nombre"
                                        :counter="255"
                                        required
                                        @input="$v.editedItem.name.$touch()"
                                        @blur="$v.editedItem.name.$touch()"
                                        :error-messages="nameErrors"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        v-model="editedItem.lastaname"
                                        label="Apellidos"
                                        :counter="255"
                                        required
                                        @input="
                                            $v.editedItem.lastaname.$touch()
                                        "
                                        @blur="$v.editedItem.lastaname.$touch()"
                                        :error-messages="lastanameErrors"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field
                                        v-model="editedItem.email"
                                        label="Correo electrónico"
                                        required
                                        @input="$v.editedItem.email.$touch()"
                                        @blur="$v.editedItem.email.$touch()"
                                        :error-messages="emailErrors"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field
                                        v-model="editedItem.password"
                                        label="Contraseña"
                                        required
                                        @input="$v.editedItem.password.$touch()"
                                        @blur="$v.editedItem.password.$touch()"
                                        :error-messages="passwordErrors"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        v-model="editedItem.telephone"
                                        label="Telefono"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-select
                                        :items="country"
                                        item-text="name"
                                        item-value="id"
                                        label="Pais"
                                        v-model="editedItem.id_country"
                                        required
                                        @change="
                                            $v.editedItem.id_country.$touch()
                                        "
                                        @blur="
                                            $v.editedItem.id_country.$touch()
                                        "
                                        :error-messages="countryErrors"
                                        outlined
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <h6>COMPAÑÍA DISTRIBUIDORA</h6>
                                    <br />
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field
                                        v-model="editedItem.tradename"
                                        label="Nombre comercial"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field
                                        v-model="editedItem.logistic_address"
                                        label="Dirección sede logística"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        v-model="editedItem.cif"
                                        label="CIF"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-select
                                        :items="province"
                                        item-text="name"
                                        item-value="id"
                                        label="Provincia"
                                        v-model="editedItem.id_province"
                                        required
                                        @change="
                                            $v.editedItem.id_province.$touch()
                                        "
                                        @blur="
                                            $v.editedItem.id_province.$touch()
                                        "
                                        :error-messages="provinceErrors"
                                        outlined
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-file-input
                                        v-model="editedItem.activity_memory"
                                        color="deep-purple accent-4"
                                        counter
                                        label="Cargar memoria de actividad"
                                        prepend-icon=""
                                        placeholder="Cargar memoria de actividad"
                                        append-icon="mdi-cloud-upload-outline"
                                        outlined
                                        :show-size="1000"
                                    >
                                        <template
                                            v-slot:selection="{ index, text }"
                                        >
                                            <v-chip
                                                v-if="index < 2"
                                                color="deep-purple accent-4"
                                                dark
                                                label
                                                small
                                            >
                                                {{ text }}
                                            </v-chip>

                                            <span
                                                v-else-if="index === 2"
                                                class="text-overline grey--text text--darken-3 mx-2"
                                            >
                                                +
                                                {{ files.length - 2 }}
                                                Archivos(s)
                                            </span>
                                        </template>
                                    </v-file-input>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col cols="12" sm="12" md="12" class="pt-4">
                            <v-select
                                v-model="value"
                                :items="activity"
                                item-text="name"
                                item-value="id"
                                return-object
                                attach
                                chips
                                label="Selecciona la actividad de la empresa"
                                outlined
                                multiple
                            ></v-select>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="warning" small @click="close"> Cancel </v-btn>
            <v-btn color="warning" small @click="save"> Guardar </v-btn>
        </v-card-actions>
    </v-card>
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
            id_province: "",
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
            id_province: null,
            activity_memory: [],
            activity: "",
        },
    }),

    computed: {
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
            console.log(this.editedItem);
            rawData = JSON.stringify(rawData);
            formData.append("data", rawData);
            formData.append("activy[img]", this.editedItem.activity_memory);

            this.$store
                .dispatch("update", formData)
                .then((res) => {
                    axios.post("/dataClient").then((response) => {
                        this.editedItem = response.data;
                    });
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });

            this.close();
        },
    },
    mounted() {
        axios.post("/dataClient").then((response) => {
            this.editedItem = response.data;
        });
        this.getCountry();
        this.getProvince();
        this.getActivity();
    },
};
</script>
<style scoped>
.col,
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col-auto,
.col-lg,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg-auto,
.col-md,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md-auto,
.col-sm,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm-auto,
.col-xl,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl-auto {
    width: 100%;
    padding: 0px 12px;
}
.v-dialog__content {
    position: absolute;
}
</style>
