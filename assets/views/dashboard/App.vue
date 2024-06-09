<script setup>
import NavbarApp from "../../common/NavbarApp.vue";
import SidebarApp from "../../common/SidebarApp.vue";
</script>

<template>
    <v-app>
        <NavbarApp />
        <SidebarApp/>
        <v-main>
            <v-container>
                <v-row>
                    <!-- <v-col class="col-1">
                       
                    </v-col> -->

                    <v-col class="col-2">
                        <router-view></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<style lang="scss" scoped>
</style>

