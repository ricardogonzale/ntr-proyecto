<template>
    <div>
        <div class="px-5 py-5" style="background-color: white">
            <v-toolbar flat>
                <h2>Listado de Certificaciones</h2>
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
                            Nuevo Certificado
                        </v-btn>
                    </template>
                    <v-card>
                        <v-toolbar color="orange" dark
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
                                                    <h6>
                                                        DATOS DEL CERTIFICADO
                                                    </h6>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.title
                                                        "
                                                        label="Titulo"
                                                        required
                                                        @input="
                                                            $v.editedItem.title.$touch()
                                                        "
                                                        @blur="
                                                            $v.editedItem.title.$touch()
                                                        "
                                                        :error-messages="
                                                            titleErrors
                                                        "
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="12"
                                                    md="12"
                                                >
                                                    <v-file-input
                                                        v-model="
                                                            editedItem.file_path
                                                        "
                                                        color="deep-purple accent-4"
                                                        counter
                                                        label="Archivo"
                                                        prepend-icon=""
                                                        placeholder="Archivo"
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
                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn small color="warning" @click="close">
                                Cancel
                            </v-btn>
                            <v-btn small color="warning" @click="save">
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
                            <v-btn small color="warning" @click="closeDelete"
                                >Cancel</v-btn
                            >
                            <v-btn small color="red" @click="deleteItemConfirm"
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
                            ¿Deseas desactivar este Certificado?
                        </h3>
                        <h3
                            v-if="editedItem.active == 0"
                            class="py-4 text-center"
                        >
                            ¿Deseas activar este Certificado?
                        </h3>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn small color="warning" @click="closeActivate"
                                >No</v-btn
                            >
                            <v-btn
                                small
                                :color="
                                    editedItem.active == 0 ? 'success' : 'error'
                                "
                                @click="activateVehicle"
                                >Si</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
            <v-row>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    v-for="k in certifications"
                    :key="k"
                >
                    <v-card class="pa-2">
                        <v-container class="p-5">
                            <div class="text-center py-5">
                                <v-icon
                                    :color="getColorActivate(k.active)"
                                    dark
                                    x-large
                                    @click="showfile(k)"
                                >
                                    mdi-file-download-outline
                                </v-icon>
                                <br />
                                {{ k.title }}
                            </div>
                        </v-container>
                        <v-card-actions>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-btn
                                        color="orange"
                                        dark
                                        rounded
                                        small
                                        @click="editItem(k)"
                                        style="
                                            border-radius: 30px;
                                            text-transform: none;
                                        "
                                    >
                                        <v-icon small class="mr-2">
                                            mdi-pencil
                                        </v-icon>
                                        Editar
                                    </v-btn>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-btn
                                        color="orange"
                                        dark
                                        rounded
                                        small
                                        @click="activateItem(k)"
                                        style="
                                            border-radius: 30px;
                                            text-transform: none;
                                        "
                                        ><v-icon small class="mr-2">
                                            mdi-close-thick
                                        </v-icon>
                                        Desactivar
                                    </v-btn>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-btn
                                        color="orange"
                                        dark
                                        rounded
                                        small
                                        @click="deleteItem(k)"
                                        style="
                                            border-radius: 30px;
                                            text-transform: none;
                                        "
                                    >
                                        <v-icon small class="mr-2">
                                            mdi-delete
                                        </v-icon>
                                        Eliminar
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>
<script>
import { validationMixin } from "vuelidate";
import { required, maxLength } from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    validations: {
        editedItem: {
            title: { required, maxLength: maxLength(255) },
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
                text: "Titulo",
                align: "start",
                value: "title",
            },
            { text: "Archivo", value: "file_path" },
            { text: "Activo", value: "active" },
            { text: "Acciones", value: "actions", sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: null,
            id_carrier: null,
            title: "",
            file_path: [],
            active: 1,
        },
        defaultItem: {
            id: null,
            id_carrier: null,
            title: "",
            file_path: [],
            active: 1,
        },
    }),

    computed: {
        certifications: {
            get() {
                return this.$store.state.certification.certifications;
            },
        },
        formTitle() {
            return this.editedIndex === -1
                ? "Nuevo Certificado"
                : "Editar Certificado";
        },
        titleErrors() {
            const errors = [];
            if (!this.$v.editedItem.title.$dirty) return errors;
            !this.$v.editedItem.title.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.title.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
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
            this.certifications = [];
        },
        getColorActivate(active) {
            if (active == 1) return "green";
            else return "red";
        },
        editItem(item) {
            this.editedIndex = this.certifications.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            console.log(item);
            this.editedIndex = this.certifications.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.certifications.splice(this.editedIndex, 1);
            this.$store
                .dispatch("deleteCertification", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getCertification");
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
            this.closeDelete();
        },

        activateItem(item) {
            console.log(item);
            this.editedIndex = this.certifications.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogActivate = true;
        },

        activateVehicle() {
            this.$store
                .dispatch("activateCertification", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getCertification");
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
        showfile(file) {
            window.open(
                "'../../../storage/carriers/certitications/" + file.file_path,
                "_blank"
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
            formData.append("file_path[img]", this.editedItem.file_path);

            if (this.editedIndex > -1) {
                // Object.assign(this.drivers[this.editedIndex], this.editedItem);
                this.$store
                    .dispatch("updateCertification", formData)
                    .then((res) => {
                        this.$store.dispatch("getCertification");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            } else {
                this.$store
                    .dispatch("newCertification", formData)
                    .then((res) => {
                        this.$store.dispatch("getCertification");
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
        this.$store.dispatch("getCertification");
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
