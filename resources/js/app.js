import moment from "moment";


require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import router from './router';
import Index from './components/Index'; // main component
import StarRating from './components/shared/components/StarRating';
import FatalError from "./components/shared/components/FatalError";
import ValidationErrors from "./components/shared/components/ValidationErrors";

Vue.filter('formatDate', value =>  moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component('fatal-error', FatalError);
Vue.component('validation-errors', ValidationErrors);

const app = new Vue({
    router,
    el: '#app',
    components: {
        'index': Index
    }
});
