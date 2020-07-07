


require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import moment from "moment";
import router from './router';
import Index from './components/Index'; // main component
import StarRating from './components/shared/components/StarRating';
import FatalError from "./components/shared/components/FatalError";
import ValidationErrors from "./components/shared/components/ValidationErrors";
import Success from "./components/shared/components/Success";
import store from './store';

Vue.filter('formatDate', value =>  moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component('fatal-error', FatalError);
Vue.component('validation-errors', ValidationErrors);
Vue.component('success', Success);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if(error.response.status === 401){
            store.dispatch('logout');
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    router,
    store,
    el: '#app',
    components: {
        'index': Index
    },
    async beforeCreate(){
        this.$store.dispatch('loadStoredState');

        this.$store.dispatch('loadUser');
    }
});
