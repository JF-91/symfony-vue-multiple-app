import {createMemoryHistory, createRouter} from 'vue-router'

const routes = [
    { path: '/', component: ()=> import ('../pages/home/Home.vue') },
    { path: '/about', component: ()=> import ('../pages/about/About.vue') },
    { path: '/contact', component: ()=> import ('../pages/contact/Contact.vue')},
]

const router = createRouter({
    history: createMemoryHistory(),
    base: '/app/',
    routes,
})

export default router