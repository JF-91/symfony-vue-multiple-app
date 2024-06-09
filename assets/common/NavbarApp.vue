<script setup>
</script>

<template>
    <v-app-bar fixed app>
        <v-toolbar class="navbar-container">
            <v-toolbar-title>Application</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link to="/">
                <v-btn text>Home</v-btn>
            </router-link>

            <router-link to="/about">
                <v-btn text>About</v-btn>
            </router-link>

            <router-link to="/contact">
                <v-btn text>Contact</v-btn>
            </router-link>
        </v-toolbar>
    </v-app-bar>
</template>

<style lang="scss" scoped>
.navbar-container {
    background-color: #1976D2;
}
</style>