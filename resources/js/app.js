import moment from "moment";


require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
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


const app = new Vue({
    router,
    store,
    el: '#app',
    components: {
        'index': Index
    },
    beforeCreate(){
        this.$store.dispatch('loadStoredState');
    }
});
