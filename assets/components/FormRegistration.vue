<script>
import Axios from "axios";
export default {
  data: () => ({
    firstName: null,
    lastName: null,
    email: null,
    password: null,
    agreeTerms: false,
  }),

  methods: {
    async register() {
      try {
        const response = await Axios.post("/register", {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.email,
          password: this.password,
          agreeTerms: this.agreeTerms,
        }, {
          headers: {
            'Content-Type': 'application/json',
          },
        });

        console.log('User registered successfully')
        console.log(response.data);

        this.$router.push('/');
      } catch (error) {
        console.log('User registration failed')
        console.error(error.response.data);
      }
    },
  
  },
}
</script>

<template>
  <v-img class="mx-auto my-6" max-width="228"
  src="https://cdn.vuetifyjs.com/docs/images/logos/vuetify-logo-v3-slim-text-light.svg"></v-img>
  
  <v-card class="mx-auto" max-width="344" title="User Registration">
    <v-container>
      <v-text-field v-model="firstName" color="primary" label="First name" variant="underlined"></v-text-field>

      <v-text-field v-model="lastName" color="primary" label="Last name" variant="underlined"></v-text-field>

      <v-text-field v-model="email" color="primary" label="Email" variant="underlined"></v-text-field>

      <v-text-field v-model="password" color="primary" label="Password" placeholder="Enter your password"
        variant="underlined" type="password"></v-text-field>

      <v-checkbox v-model="agreeTerms" color="secondary" label="I agree to site agreeTerms and conditions"></v-checkbox>
    </v-container>

    <v-divider></v-divider>

    <v-card-actions>
      <v-spacer></v-spacer>

      <v-btn @click="register" color="success">
        Complete Registration

        <v-icon icon="mdi-chevron-right" end></v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>import { _ } from "core-js";

