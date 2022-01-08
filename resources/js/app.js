import Vue from 'vue';
import {routes} from './routes'
import VueRouter from 'vue-router';
require('./bootstrap');

window.Vue = require('vue').default;

import User from './Helper/User.js';
window.User = User;

window.Reload = new Vue();
Vue.use(VueRouter);

import Moment from 'moment';
Vue.use(Moment);

import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});

const app = new Vue({
    el: '#app',
    router
});
