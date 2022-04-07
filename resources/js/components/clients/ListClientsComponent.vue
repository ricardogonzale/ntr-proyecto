<template>
    <v-data-table
        :headers="headers"
        :items="clients"
        sort-by="lastaname"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Clientes Registrados</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="800px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >
                            Registrar Cliente
                        </v-btn>
                    </template>
                    <v-card>
                        <v-toolbar color="primary" dark
                            >{{ formTitle }}
                            <v-spacer></v-spacer>
                            <v-radio-group
                                v-model="editedItem.type"
                                mandatory
                                row
                                class="mt-5"
                            >
                                <v-radio label="Cliente" value="1"></v-radio>
                                <v-radio
                                    label="Transportista"
                                    value="2"
                                ></v-radio>
                            </v-radio-group>
                        </v-toolbar>

                        <v-card-text class="pt-8">
                            <v-form
                                ref="form"
                                method="POST"
                                @submit.prevent="save()"
                            >
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="6">
                                            <v-row>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.name
                                                        "
                                                        label="Nombre"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.lastaname
                                                        "
                                                        label="lastaname"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.email
                                                        "
                                                        label="Correo electrónico"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.password
                                                        "
                                                        label="Contraseña"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.telephone
                                                        "
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
                                                        v-model="
                                                            editedItem.country
                                                        "
                                                        outlined
                                                    ></v-select>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6">
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.tradename
                                                        "
                                                        label="Nombre comercial"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.logistic_address
                                                        "
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
                                                        v-model="
                                                            editedItem.province
                                                        "
                                                        outlined
                                                    ></v-select>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-file-input
                                                        v-model="
                                                            editedItem.activity_memory
                                                        "
                                                        color="deep-purple accent-4"
                                                        counter
                                                        label="Documentación entrega"
                                                        prepend-icon=""
                                                        placeholder="Documentación entrega"
                                                        append-icon="mdi-cloud-upload-outline"
                                                        outlined
                                                        :show-size="1000"
                                                    >
                                                        <template
                                                            v-slot:selection="{
                                                                index,
                                                                text,
                                                            }"
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
                                                                v-else-if="
                                                                    index === 2
                                                                "
                                                                class="text-overline grey--text text--darken-3 mx-2"
                                                            >
                                                                +
                                                                {{
                                                                    files.length -
                                                                    2
                                                                }}
                                                                Archivos(s)
                                                            </span>
                                                        </template>
                                                    </v-file-input>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="12"
                                            md="12"
                                            class="pt-4"
                                        >
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
                            <v-btn color="blue darken-1" text @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="save">
                                Guardar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5"
                            >¿Deseas Eliminar este registro?</v-card-title
                        >
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeDelete"
                                >Cancel</v-btn
                            >
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="deleteItemConfirm"
                                >OK</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
    </v-data-table>
</template>
<script>
import axios from "axios";

export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        country: [],
        files: [],
        province: [],
        activity: [],
        value: [],
        headers: [
            { text: "Id", value: "id" },
            {
                text: "Nombre",
                align: "start",
                value: "name",
            },
            { text: "Apellido", value: "lastaname" },
            { text: "Correo electrónico", value: "email" },
            { text: "Teléfono", value: "telephone" },
            { text: "Pais", value: "country" },
            { text: "Acciones", value: "actions", sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: null,
            type: null,
            name: "",
            lastaname: "",
            email: "",
            password: "",
            telephone: "",
            country: "",
            tradename: "",
            logistic_address: "",
            cif: "",
            province: "",
            activity: "",
        },
        defaultItem: {
            id: null,
            type: null,
            name: "",
            lastaname: "",
            email: "",
            password: "",
            telephone: "",
            country: null,
            tradename: "",
            logistic_address: "",
            cif: "",
            province: null,
            activity_memory: [],
            activity: "",
        },
    }),

    computed: {
        clients: {
            get() {
                return this.$store.state.clients;
            },
        },
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo Cliente" : "Editar Cliente";
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
            let formData = new FormData();
            let rawData = { info: this.editedItem };
            console.log(this.editedItem);
            rawData = JSON.stringify(rawData);
            formData.append("data", rawData);
            formData.append("activy[img]", this.editedItem.activity_memory);

            if (this.editedIndex > -1) {
                // Object.assign(this.clients[this.editedIndex], this.editedItem);
                this.$store
                    .dispatch("update", formData)
                    .then((res) => {
                        this.$store.dispatch("getClients");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            } else {
                this.$store
                    .dispatch("register", formData)
                    .then((res) => {
                        this.$store.dispatch("getClients");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            }
            this.close();
        },
    },
    mounted() {
        this.$store.dispatch("getClients");
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
