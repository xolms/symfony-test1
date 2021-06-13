/*
 * Welcome to your app"s main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "../scss/app.scss";
import vMask from "v-mask";
import axios from "axios";

import Vue from "vue";

import store from "./store";
import router from "./router";

Vue.use(vMask);

Vue.prototype.$axios = axios;

const token = localStorage.getItem("token");

if (token) {
    Vue.prototype.$axios.defaults.headers.common['Authorization'] = token
    store.commit('changeUser', token)
}

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.getUser) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})
router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.noAuth)) {
        if (store.getters.getUser) {
            next('/')

        }
        next()

    } else {
        next()
    }
})

const app = new Vue({
    el: "#app",
    store,
    router,
    template: "<router-view></router-view>",
    render(h) {
        return Vue.compile(this.$options.template).render.call(this, h);
    },
})

// start the Stimulus application
import "../bootstrap";

export default app;
