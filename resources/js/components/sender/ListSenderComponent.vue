<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="tipom"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Envios</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="1000px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >
                            Nuevo Envio
                        </v-btn>
                    </template>
                    <v-stepper v-model="e1">
                        <v-stepper-header>
                            <v-stepper-step :complete="e1 > 1" step="1">
                                Detalle del envío
                            </v-stepper-step>

                            <v-divider></v-divider>

                            <v-stepper-step :complete="e1 > 2" step="2">
                                Entregas
                            </v-stepper-step>

                            <v-divider></v-divider>

                            <v-stepper-step step="3">
                                Cartera de Agencias
                            </v-stepper-step>

                            <v-divider></v-divider>

                            <v-stepper-step step="4">
                                Validación
                            </v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-items>
                            <v-stepper-content step="1">
                                <v-card class="mb-8">
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-radio-group
                                                    v-model="
                                                        editedItem.modality
                                                    "
                                                    row
                                                >
                                                    <v-radio
                                                        label="POR CARRETERA"
                                                        value="1"
                                                    ></v-radio>
                                                    <v-radio
                                                        label="INTERMODAL"
                                                        value="2"
                                                    ></v-radio>
                                                </v-radio-group>
                                                <template>
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
                                                    <v-select
                                                        :items="items"
                                                        outlined
                                                        label="Tipo de mercancía"
                                                    ></v-select>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-switch
                                                                v-model="
                                                                    editedItem.closed_bid
                                                                "
                                                                flat
                                                                label="Puja cerrada"
                                                            ></v-switch>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-switch
                                                                v-model="
                                                                    editedItem.deferred_payment
                                                                "
                                                                flat
                                                                label="Pago diferido"
                                                            ></v-switch>
                                                        </v-col>
                                                    </v-row>
                                                </template>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-textarea
                                                    outlined
                                                    rows="10"
                                                    name="description"
                                                    label="Describe brevemente el envío"
                                                ></v-textarea>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card>
                                <v-btn color="primary" @click="e1 = 2">
                                    Continue
                                </v-btn>
                                <v-btn text> Cancel </v-btn>
                            </v-stepper-content>

                            <v-stepper-content step="2">
                                <v-card class="mb-8">
                                    <div
                                        class="border mt-2"
                                        v-for="(order, idx) in orders"
                                        :key="idx"
                                    >
                                        <div
                                            class="text-right pr-2"
                                            style="
                                                position: absolute;
                                                right: 2%;
                                                z-index: 1;
                                            "
                                        >
                                            <v-tooltip right>
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <v-icon
                                                        small
                                                        color="red"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        @click="
                                                            removeItem(order)
                                                        "
                                                        >mdi-close</v-icon
                                                    >
                                                </template>
                                                <span>Eliminar Entrega</span>
                                            </v-tooltip>
                                        </div>
                                        <v-container>
                                            <v-row class="pt-5">
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        outlined
                                                        label="Lugar de recogida*"
                                                        v-model="
                                                            order.placepickup
                                                        "
                                                    ></v-text-field>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    order.datepickup
                                                                "
                                                                label="Fecha de recogida"
                                                                outlined
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    order.hourpickup
                                                                "
                                                                label="Hora de recogida"
                                                                outlined
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field
                                                        outlined
                                                        label="Lugar de entrega*"
                                                        v-model="
                                                            order.placedelivery
                                                        "
                                                    ></v-text-field>
                                                    <v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    order.datedelivery
                                                                "
                                                                label="Fecha de entrega"
                                                                outlined
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="6"
                                                        >
                                                            <v-text-field
                                                                v-model="
                                                                    order.hourdelivery
                                                                "
                                                                label="Hora de entrega"
                                                                outlined
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </div>
                                    <v-btn
                                        small
                                        color="info"
                                        @click="addItem"
                                        style="
                                            text-transform: none;
                                            letter-spacing: 0.1rem;
                                        "
                                    >
                                        <v-icon left> mdi-plus </v-icon>
                                        Añadir entrega
                                    </v-btn>
                                    <v-btn
                                        small
                                        color="info"
                                        @click="duplicateItem"
                                        style="
                                            text-transform: none;
                                            letter-spacing: 0.1rem;
                                        "
                                    >
                                        <v-icon left>
                                            mdi-content-duplicate
                                        </v-icon>
                                        Duplicar linea
                                    </v-btn>
                                    <br />
                                    <br />
                                </v-card>

                                <v-btn color="primary" @click="e1 = 3">
                                    Continue
                                </v-btn>

                                <v-btn text @click="e1 = 1"> Cancel </v-btn>
                            </v-stepper-content>

                            <v-stepper-content step="3">
                                <v-card
                                    class="mb-12"
                                    color="grey lighten-1"
                                    height="200px"
                                ></v-card>

                                <v-btn color="primary" @click="e1 = 1">
                                    Continue
                                </v-btn>

                                <v-btn text @click="e1 = 2"> Cancel </v-btn>
                            </v-stepper-content>
                        </v-stepper-items>
                    </v-stepper>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5"
                            >¿Desea eliminar el envio?</v-card-title
                        >
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeDelete"
                                >Cancelar</v-btn
                            >
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="deleteItemConfirm"
                                >ELIMINAR</v-btn
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
    data: (vm) => ({
        e1: 1,
        files: [],
        dialog: false,
        dialogDelete: false,
        date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
        date2: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
        dateFormatted: vm.formatDate(
            new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10)
        ),
        dateFormatted2: vm.formatDate(
            new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10)
        ),
        orders: [
            {
                placepickup: "",
                datepickup: "",
                hourpickup: "",
                placedelivery: "",
                datedelivery: "",
                hourdelivery: "",
            },
        ],
        items: ["Foo", "Bar", "Fizz", "Buzz"],
        menu1: false,
        menu2: false,
        time1: null,
        time2: null,
        menuTime1: false,
        menuTime2: false,
        headers: [
            {
                text: "Modalidad",
                align: "start",
                sortable: false,
                value: "name",
            },
            { text: "Tipo de mercancia", value: "tipom" },
            { text: "Tipo", value: "tipo" },
            { text: "Origen", value: "origin" },
            { text: "Destino", value: "destination" },
            { text: "Acciones", value: "actions", sortable: false },
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            modality: "",
            name: "",
            tipom: 0,
            tipo: 0,
            origin: 0,
            destination: 0,
            closed_bid: false,
            deferred_payment: false,
        },
        defaultItem: {
            modality: "",
            name: "",
            tipom: 0,
            tipo: 0,
            origin: 0,
            destination: 0,
            closed_bid: 0,
            deferred_payment: 0,
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Item" : "Edit Item";
        },
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
        },
        date2(val) {
            this.dateFormatted2 = this.formatDate(this.date2);
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.desserts = [
                {
                    name: "Por Carretera",
                    tipom: 2,
                    tipo: "Puja Cerrada",
                    origin: "Madrid",
                    destination: "Barcelona",
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
        formatDate(date) {
            if (!date) return null;

            const [year, month, day] = date.split("-");
            return `${day}/${month}/${year}`;
        },
        parseDate(date) {
            if (!date) return null;

            const [day, month, year] = date.split("/");
            return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
        },
        duplicateItem: function () {
            var lastElement;
            var id =
                Math.max.apply(
                    Math,
                    this.orders.map(function (o) {
                        return o.id;
                    })
                ) + 1;
            for (lastElement in this.orders);
            lastElement;
            console.log(this.orders[lastElement]);
            this.orders.push({
                placepickup: this.orders[lastElement].placepickup,
                datepickup: this.orders[lastElement].datepickup,
                hourpickup: this.orders[lastElement].hourpickup,
                placedelivery: this.orders[lastElement].placedelivery,
                datedelivery: this.orders[lastElement].datedelivery,
                hourdelivery: this.orders[lastElement].hourdelivery,
            });
        },
        addItem: function () {
            var id =
                Math.max.apply(
                    Math,
                    this.orders.map(function (o) {
                        return o.id;
                    })
                ) + 1;
            this.orders.push({
                placepickup: "",
                datepickup: "",
                hourpickup: "",
                placedelivery: "",
                datedelivery: "",
                hourdelivery: "",
            });
        },
        removeItem: function (order) {
            var index = this.orders.indexOf(order);
            this.orders.splice(index, 1);
        },
    },
};
</script>
