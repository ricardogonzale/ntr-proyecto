<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="apellido"
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
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="12" md="6">
                                        <v-row>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-text-field
                                                    v-model="editedItem.name"
                                                    label="Nombre"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.apellido
                                                    "
                                                    label="Apellido"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field
                                                    v-model="editedItem.email"
                                                    label="Correo electrónico"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12" md="12">
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
                                                    label="Pais"
                                                    v-model="editedItem.country"
                                                    outlined
                                                ></v-select>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6">
                                        <v-row>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field
                                                    v-model="
                                                        editedItem.comercialName
                                                    "
                                                    label="Nombre comercial"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field
                                                    v-model="editedItem.campus"
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
                                                    :items="country"
                                                    label="Provincia"
                                                    v-model="
                                                        editedItem.province
                                                    "
                                                    outlined
                                                ></v-select>
                                            </v-col>
                                            <v-file-input
                                                v-model="files"
                                                color="deep-purple accent-4"
                                                counter
                                                label="Documentación entrega"
                                                multiple
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
                                                        v-else-if="index === 2"
                                                        class="text-overline grey--text text--darken-3 mx-2"
                                                    >
                                                        +
                                                        {{ files.length - 2 }}
                                                        Archivos(s)
                                                    </span>
                                                </template>
                                            </v-file-input>
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
                                            :items="items"
                                            attach
                                            chips
                                            label="Selecciona la actividad de la empresa"
                                            outlined
                                            multiple
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="register">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5"
                            >Are you sure you want to delete this
                            item?</v-card-title
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
export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        country: ["Foo", "Bar", "Fizz", "Buzz"],
        files: [],
        items: ["foo", "bar", "fizz", "buzz", "fizzbuzz", "foobar"],
        value: [],
        headers: [
            {
                text: "Nombre",
                align: "start",
                value: "name",
            },
            { text: "Apellido", value: "apellido" },
            { text: "Correo electrónico", value: "email" },
            { text: "Teléfono", value: "telephone" },
            { text: "Pais", value: "country" },
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            type: null,
            name: "",
            apellido: "",
            email: "",
            password: "",
            telephone: "",
            country: "",
            comercialName: "",
            campus: "",
            cif: "",
            province: "",
            activity: "",
        },
        defaultItem: {
            type: null,
            name: "",
            apellido: "",
            email: "",
            password: "",
            telephone: "",
            country: "",
            comercialName: "",
            campus: "",
            cif: "",
            province: "",
            activity: "",
        },
    }),

    computed: {
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
            this.desserts = [
                {
                    name: "Frozen Yogurt",
                    apellido: 159,
                    email: 6.0,
                    telephone: 24,
                    country: 4.0,
                },
                {
                    name: "Ice cream sandwich",
                    apellido: 237,
                    email: 9.0,
                    telephone: 37,
                    country: 4.3,
                },
                {
                    name: "Eclair",
                    apellido: 262,
                    email: 16.0,
                    telephone: 23,
                    country: 6.0,
                },
                {
                    name: "Cupcake",
                    apellido: 305,
                    email: 3.7,
                    telephone: 67,
                    country: 4.3,
                },
                {
                    name: "Gingerbread",
                    apellido: 356,
                    email: 16.0,
                    telephone: 49,
                    country: 3.9,
                },
                {
                    name: "Jelly bean",
                    apellido: 375,
                    email: 0.0,
                    telephone: 94,
                    country: 0.0,
                },
                {
                    name: "Lollipop",
                    apellido: 392,
                    email: 0.2,
                    telephone: 98,
                    country: 0,
                },
                {
                    name: "Honeycomb",
                    apellido: 408,
                    email: 3.2,
                    telephone: 87,
                    country: 6.5,
                },
                {
                    name: "Donut",
                    apellido: 452,
                    email: 25.0,
                    telephone: 51,
                    country: 4.9,
                },
                {
                    name: "KitKat",
                    apellido: 518,
                    email: 26.0,
                    telephone: 65,
                    country: 7,
                },
            ];
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1);
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

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                this.desserts.push(this.editedItem);
            }
            this.close();
        },
        register() {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                this.desserts.push(this.editedItem);
            }
            this.close();
            // if the form is validated send login request
            this.registerRequestSent = true;
            console.log(this.editedItem);
            const credentials = {
                name: "Ricardo",
                email: "ricardogonzale@gmail.com",
                password: "123456",
                password_confirmation: "123456",
            };

            this.$store
                .dispatch("register", credentials)
                .then((res) => {
                    this.registerRequestSent = false;
                    this.dialog = false;
                    // window.location = "/";
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
        },
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
