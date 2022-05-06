<template>
    <div class="row">
        <div class="col-md-3 d-none d-md-block"></div>
        <div class="col-md-6 col-sm-12">
            <!--Login-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="selector-login">
                    <v-form ref="loginForm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <h3 class="mb-5 font-12">
                                        DATOS DEL USUARIO
                                    </h3>
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            v-model="email"
                                            class="form-control form-control-lg"
                                            placeholder="Email"
                                            style="
                                                border-color: #072b42 !important;
                                            "
                                        />
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            v-model="password"
                                            class="form-control form-control-lg"
                                            placeholder="Password"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="text-center mb-20">
                                        <button
                                            class="btn btn-orange"
                                            type="button"
                                            :large="$vuetify.breakpoint.smAndUp"
                                            :loading="loginRequestSent"
                                            @click="login"
                                        >
                                            Entrar
                                        </button>
                                    </div>
                                    <div class="text-center font-14 text-gris">
                                        <a href="#" class="linkolvido"
                                            >Olvidé mi contraseña</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-form>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-none d-md-block"></div>
    </div>
</template>

<script>
export default {
    props: ["auth"],
    data() {
        return {
            darkTheme: true,
            platformName: "NTR | Good Deals",
            email: "",
            emailRules: [(email) => !!email || "E-mail is required"],

            password: "",
            passwordRules: [
                (password) => !!password || "password is required",
                (password) =>
                    password.length > 6 ||
                    "password must be more than 6 characters long",
            ],

            errors: {
                email: [],
            },

            /* loading status for the v-card and v-btn */
            loginRequestSent: false,
        };
    },

    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        },
    },

    methods: {
        reset() {
            this.$refs.loginForm.reset();
        },

        login() {
            if (this.$refs.loginForm.validate()) {
                // if the form is validated send login request
                this.loginRequestSent = true;

                const credentials = {
                    email: this.email,
                    password: this.password,
                };

                this.$store
                    .dispatch("login", credentials)
                    .then((res) => {
                        console.log(res);
                        this.loginRequestSent = false;
                        this.dialog = false;
                        window.location.href = "/home/";
                    })
                    .catch((error) => {
                        console.log(error.response.data.message);
                        alert(error.response.data.message);
                        this.errors = error.response.data.errors;
                        this.loginRequestSent = false;
                    });
            }
        },
    },
};
</script>
