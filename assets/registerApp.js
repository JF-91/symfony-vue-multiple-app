import './styles/app.scss';
import 'vuetify/styles'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import  { createApp } from 'vue';
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import Register from './views/register/Register.vue';
import router from './routes/register';


const vuetify = createVuetify({
    components,
    directives,
  })


createApp(Register)
    .use(vuetify, {iconfont: 'md'})
    .use(router)
    .mount('#registerApp');
