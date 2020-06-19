import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/ExampleComponent'
import Home2 from './components/Example2'

const routes = [
    { path: "/", component:Home, name: 'home'},
    { path: "/home2", component:Home2, name:'home2'}
]


const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang : false,
    mode: 'history'
})

export default router
