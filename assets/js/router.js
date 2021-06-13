import VueRouter from "vue-router";
import Vue from "vue"
import Index from "./pages/Index";
import Login from "./pages/Login";

Vue.use(VueRouter)

const routes = [
    {
        path: "/",
        name: "index",
        component: Index,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            noAuth: true
        }
    }
]

export default new VueRouter({
    routes,
    mode: "history"
})