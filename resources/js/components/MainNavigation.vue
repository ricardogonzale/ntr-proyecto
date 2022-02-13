<template>
    <!-- 
    <v-navigation-drawer app>
          
    </v-navigation-drawer>
    -->
      
    <v-app-bar dense app dark color="orange darken-2">
          
        <v-toolbar-title class="headline font-weight-bold">NTR</v-toolbar-title>

        <v-spacer></v-spacer>

        
        <loginButton    v-if="!auth"></loginButton>
        <registerButton v-if="!auth"></registerButton>

        <logoutButton   v-if="auth"></logoutButton>
        
    </v-app-bar>

</template>

<script>
import loginButton      from './auth/LoginButton.vue';
import logoutButton     from './auth/LogoutButton.vue';
import registerButton   from './auth/RegisterButton.vue';

export default {
    components: {
        loginButton,
        logoutButton,
        registerButton
    },
    props: ['auth'],
    data() {
        return {
            
        }
    },

    computed: {
        loggedIn(){
            return this.$store.getters.loggedIn;
        }
    },


}
</script>
