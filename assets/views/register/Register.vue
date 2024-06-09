<script setup>
import FormRegistration from "../../components/FormRegistration.vue";
import Carousel from "../../components/Carousel.vue";
</script>

<template>
    <v-app>
        <v-main>
            <v-container>
                <v-row>
                    <v-col>
                        <h1>Register</h1>
                        <!-- <v-img height="300" contain class="my-3" src="/assets/public/images/mano_robot.jpg" /> -->
                         <Carousel />
                    </v-col> 

                    <v-col>
                        <FormRegistration />
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<style lang="scss" scoped>

</style>