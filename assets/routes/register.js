import {createMemoryHistory, createRouter} from 'vue-router'

const routes = [
    { path: '/register', component: ()=> import ('../views/register/Register.vue') },
    { path: '/', component: ()=> import ('../views/dashboard/App.vue') },
]
const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router