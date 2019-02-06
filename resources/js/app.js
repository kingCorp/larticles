import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import Login from './components/Login.vue';
import Articles from './components/Articles.vue';
import Navbar from './components/Navbar.vue';

const routes = [
    {path: '/', component: Articles},
    {path: '/login', component: Login}
]
const router = new VueRouter({
    routes,
   // mode: 'history'
})

const app = new Vue({
    el: '#app',
    router,
    components: { Navbar }
});
