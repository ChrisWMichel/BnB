import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Bookable from './components/bookable/Bookable'
import Bookables from './components/bookables/Bookables'
import Review from "./components/review/Review";
import Basket from "./basket/Basket";

const routes = [
    { path: "/", component:Bookables, name: 'home'},
    {
        path: "/bookable/:id",
        component:Bookable,
        name:'bookable'
    },
    {
        path: "/review/:id",
        component: Review,
        name:'review'
    },
    {
        path: "/basket",
        component: Basket,
        name:'basket'
    }
]


const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang : false,
    mode: 'history'
})

export default router
