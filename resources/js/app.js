import store from './store'
import router from './router'
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'

Vue.use(VueAxios, axios)

const app = new Vue({
    el: '#app',
    store,
    router,
    template: `<App />`,
    components: { App }
});
