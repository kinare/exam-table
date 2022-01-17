import Vue from "vue";
import router from "./router";
import store from "./store";
import  vuetify from  "./plugins/vuetify";

Event = new Vue();

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
})
