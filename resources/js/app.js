

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import router from './router';
import Index from './components/Index'; // main component

const app = new Vue({
    router,
    el: '#app',
    components: {
        'index': Index
    }
});
