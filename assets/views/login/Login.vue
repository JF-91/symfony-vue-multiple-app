<script setup>
import FormAuth from "../../components/FormAuth.vue";
</script>

<template>
    <v-app>
        <v-main>
            <v-container>
                <v-row>
                    <v-col>
                        <h1 class="text-h1 text-primary">Login</h1>
                        
                        <v-img contain  class="image-login" src="/images/mano_robot.jpg" />
                    </v-col>

                    <v-col>
                        <FormAuth />
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<style lang="scss" scoped>
.text-h1 {
    margin-bottom: 24px;
}
</style>