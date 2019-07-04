
require('./bootstrap');

window.Vue = require('vue');



import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);


import Myheader from './components/Myheader'
import Home from "./components/Home"
import About from "./components/About"
import Myfooter from "./components/Myfooter"
import axios from 'axios'


const routes = [
    { path: "/home", component: Home },
    { path: "/about", component: About }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    router,
    components:{Myheader, Home, About, Myfooter},
});
