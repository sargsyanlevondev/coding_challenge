require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import Layout from "./Layout";
import router from "./router/router";
import store from "./store/store";
import axios from 'axios';
import _ from 'lodash';
Object.defineProperty(Vue.prototype, '_', { value: _ });

new Vue({
    router,
    store,
    render: h => h(Layout)
}).$mount('#app');
