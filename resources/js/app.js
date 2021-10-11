/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
Vue.component('pagination', require('laravel-vue-pagination'));
import VueSweetalert2 from "vue-sweetalert2";
import VueMdb, { AxiosPlugin } from "vue-mdbootstrap";
import VueTimepicker from 'vue2-timepicker'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import pagination from 'laravel-vue-pagination'
import { store } from './store/store';
import VueMoment from 'vue-moment'
Vue.use(require('vue-moment'));


// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
    // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(VueSweetalert2)


import VCalendar from 'v-calendar';
// Use v-calendar & v-date-picker components
Vue.use(VCalendar, {
    componentPrefix: 'vc', // Use <vc-calendar /> instead of <v-calendar />
});

Vue.use(VueMdb);
// Optionally, install the MDBootstrap Axios plugin
// only requires if using BsGrid, BsTreeGrid, BsModel, BsStore, BsTreeStore or needs to perform HTTP Request
Vue.use(AxiosPlugin);


import App from './components/App.vue'


export const eventBus = new Vue();
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    // axios.defaults.baseURL = 'http://api.project.test' // Backend URL for API

const app = new Vue({
    el: '#app',
    store,
    render: (h) => h(App),

    components: {
        'app': App,
        'pagination': pagination,
        'moment': VueMoment

    }
});
