import './styles/app.scss';
import 'vuetify/styles'
import  { createApp } from 'vue';
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import Login from './views/login/Login.vue';


const vuetify = createVuetify({
    components,
    directives,
  })


createApp(Login)
    .use(vuetify)
    .mount('#loginApp');
