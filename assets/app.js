import './styles/app.scss';
import 'vuetify/styles'
import  { createApp } from 'vue';
import router from './routes/app';
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import App from './views/dashboard/App.vue';


const vuetify = createVuetify({
    components,
    directives,
  })


createApp(App)
    .use(vuetify)
    .use(router)
    .mount('#app');
