<template>
    <v-data-table
        :headers="headers"
        :items="vehicles"
        sort-by="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Listado de Vehículos</v-toolbar-title>
            </v-toolbar>
            <v-toolbar flat>
                <v-dialog v-model="dialog" max-width="400px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="orange"
                            dark
                            small
                            rounded
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                            style="border-radius: 30px; text-transform: none"
                        >
                            Nuevo Vehículo
                        </v-btn>
                    </template>
                    <v-card>
                        <v-toolbar color="primary" dark
                            >{{ formTitle }}
                            <v-spacer></v-spacer>
                        </v-toolbar>

                        <v-card-text class="pt-8">
                            <v-form
                                ref="form"
                                method="POST"
                                @submit.prevent="save()"
                            >
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-row>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <h6>DATOS DEL VEHÍCULO</h6>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-select
                                                        :items="type_vehicle"
                                                        item-text="name"
                                                        item-value="id"
                                                        label="Tipo de Vehículo"
                                                        v-model="
                                                            editedItem.type_vehicle
                                                        "
                                                        required
                                                        @change="
                                                            $v.editedItem.type_vehicle.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.type_vehicle.$touch()
                                                        "
                                                        :error-messages="
                                                            typeVehicleErrors
                                                        "
                                                        outlined
                                                    ></v-select>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.mark
                                                        "
                                                        label="Marca"
                                                        required
                                                        @input="
                                                            $v.editedItem.mark.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.mark.$touch()
                                                        "
                                                        :error-messages="
                                                            markErrors
                                                        "
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.modelo
                                                        "
                                                        label="Modelo"
                                                        required
                                                        @input="
                                                            $v.editedItem.modelo.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.modelo.$touch()
                                                        "
                                                        :error-messages="
                                                            modeloErrors
                                                        "
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.type_load
                                                        "
                                                        label="Tipo de Carga"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="12" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.tuition
                                                        "
                                                        label="Matrícula"
                                                        required
                                                        @input="
                                                            $v.editedItem.tuition.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.tuition.$touch()
                                                        "
                                                        :error-messages="
                                                            tuitionErrors
                                                        "
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.year
                                                        "
                                                        label="Año"
                                                        @input="
                                                            $v.editedItem.year.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.year.$touch()
                                                        "
                                                        :error-messages="
                                                            yearErrors
                                                        "
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" md="12">
                                                    <v-textarea
                                                        outlined
                                                        v-model="
                                                            editedItem.observations
                                                        "
                                                        label="Observaciones"
                                                        placeholder="Observaciones"
                                                        rows="2"
                                                    ></v-textarea>
                                                </v-col>
                                            </v-row>
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
                <v-dialog v-model="dialogDelete" max-width="300px">
                    <v-card>
                        <h3 class="py-4 text-center">
                            ¿Deseas Eliminar este registro?
                        </h3>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeDelete"
                                >Cancel</v-btn
                            >
                            <v-btn
                                color="red darken-1"
                                text
                                @click="deleteItemConfirm"
                                >OK</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogActivate" max-width="300px">
                    <v-card>
                        <h3
                            v-if="editedItem.active == 1"
                            class="py-4 text-center"
                        >
                            ¿Deseas desactivar este Vehículo?
                        </h3>
                        <h3
                            v-if="editedItem.active == 0"
                            class="py-4 text-center"
                        >
                            ¿Deseas activar este Vehículo?
                        </h3>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeActivate"
                                >No</v-btn
                            >
                            <v-btn
                                :color="
                                    editedItem.active == 0
                                        ? 'green darken-1'
                                        : 'red darken-1'
                                "
                                text
                                @click="activateVehicle"
                                >Si</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.active="{ item }">
            <v-icon
                :color="getColorActivate(item.active)"
                dark
                @click="activateItem(item)"
            >
                mdi-check-circle-outline
            </v-icon>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
            <v-chip color="orange" dark @click="editItem(item)">
                <v-icon small class="mr-2"> mdi-pencil </v-icon>
                Editar
            </v-chip>
            <v-chip color="orange" dark @click="deleteItem(item)">
                <v-icon small class="mr-2"> mdi-delete </v-icon> Eliminar
            </v-chip>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
    </v-data-table>
</template>
<script>
import axios from "axios";
import { validationMixin } from "vuelidate";
import { required, maxLength, minLength } from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    validations: {
        editedItem: {
            mark: { required, maxLength: maxLength(255) },
            modelo: { required, maxLength: maxLength(255) },
            year: { required },
            tuition: { required, minLength: minLength(7) },
            type_vehicle: { required },
        },
    },
    data: () => ({
        dialog: false,
        dialogDelete: false,
        dialogActivate: false,
        type_vehicle: [],
        files: [],
        value: [],
        headers: [
            { text: "Id", value: "id" },
            {
                text: "Tipo Vehículo",
                align: "start",
                value: "type_vehicle",
            },
            { text: "Marca", value: "mark" },
            { text: "Modelo", value: "modelo" },
            { text: "Matrícula", value: "tuition" },
            { text: "Activo", value: "active" },
            { text: "Acciones", value: "actions", sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: null,
            id_carrier: null,
            type_vehicle: "",
            mark: "",
            modelo: "",
            type_load: "",
            tuition: "",
            year: "",
            observations: "",
            active: "",
        },
        defaultItem: {
            id: null,
            id_carrier: null,
            type_vehicle: "",
            mark: "",
            modelo: "",
            type_load: "",
            tuition: "",
            year: "",
            observations: "",
            active: 1,
        },
    }),

    computed: {
        vehicles: {
            get() {
                return this.$store.state.vehicle.vehicles;
            },
        },
        formTitle() {
            return this.editedIndex === -1
                ? "Nuevo Vehículo"
                : "Editar Vehículo";
        },
        markErrors() {
            const errors = [];
            if (!this.$v.editedItem.mark.$dirty) return errors;
            !this.$v.editedItem.mark.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.mark.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
            return errors;
        },
        modeloErrors() {
            const errors = [];
            if (!this.$v.editedItem.modelo.$dirty) return errors;
            !this.$v.editedItem.modelo.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.modelo.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
            return errors;
        },
        yearErrors() {
            const errors = [];
            if (!this.$v.editedItem.year.$dirty) return errors;
            !this.$v.editedItem.year.required &&
                errors.push("Año es obligatorio");
            return errors;
        },
        tuitionErrors() {
            const errors = [];
            if (!this.$v.editedItem.tuition.$dirty) return errors;
            !this.$v.editedItem.tuition.minLength &&
                errors.push("La matrícula no debe contener menos de 7 digitos");
            !this.$v.editedItem.tuition.required &&
                errors.push("Este campo es obligatorio.");
            return errors;
        },
        typeVehicleErrors() {
            const errors = [];
            if (!this.$v.editedItem.type_vehicle.$dirty) return errors;
            !this.$v.editedItem.type_vehicle.required &&
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
            this.vehicles = [];
        },
        getColorActivate(active) {
            if (active == 1) return "green";
            else return "red";
        },
        editItem(item) {
            this.editedIndex = this.vehicles.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            console.log(item);
            this.editedIndex = this.vehicles.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.vehicles.splice(this.editedIndex, 1);
            this.$store
                .dispatch("deleteVehicle", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getVehicle");
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
            this.closeDelete();
        },

        activateItem(item) {
            console.log(item);
            this.editedIndex = this.vehicles.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogActivate = true;
        },

        activateVehicle() {
            this.$store
                .dispatch("activateVehicle", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getVehicle");
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
            this.closeActivate();
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

        closeActivate() {
            this.dialogActivate = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        getTypeVehicle: function () {
            axios.get("/getTypeVehicle").then(
                function (response) {
                    this.type_vehicle = response.data;
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

            if (this.editedIndex > -1) {
                // Object.assign(this.drivers[this.editedIndex], this.editedItem);
                this.$store
                    .dispatch("updateVehicle", formData)
                    .then((res) => {
                        this.$store.dispatch("getVehicle");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            } else {
                this.$store
                    .dispatch("newVehicle", formData)
                    .then((res) => {
                        this.$store.dispatch("getVehicle");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            }
            // this.close();
        },
    },
    mounted() {
        this.$store.dispatch("getVehicle");
        this.getTypeVehicle();
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
