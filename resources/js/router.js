import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Bookable from './components/bookable/Bookable'
import Bookables from './components/bookables/Bookables'
import Review from "./components/review/Review";
import Basket from "./components/basket/Basket";
import Register from "./auth/register";

const routes = [
    { path: "/", component:Bookables, name: 'home'}, // require("./components/bookables/Bookables")
    {
        path: "/bookable/:id",
        component:Bookable,  // require("./components/bookable/Bookable")
        name:'bookable'
    },
    {
        path: "/review/:id",
        component: Review, // require("./components/review/Review")
        name:'review'
    },
    {
        path: "/basket",
        component: Basket, // require("./components/basket/Basket")
        name:'basket'
    },
    {
        path: "/login",
        component:require("./auth/Login").default,
        name:'login'
    },
    {
        path: "/register",
        component:Register,
        name:'register'
    }
]


const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang : false,
    mode: 'history'
})

export default router
