require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import Layout from "./Layout";
import router from "./router/router";
import store from "./store/store";

new Vue({
    router,
    store,
    render: h => h(Layout)
}).$mount('#app');
