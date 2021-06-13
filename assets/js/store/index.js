import Vuex from 'vuex'
import Vue from 'vue'
import router from "../router";
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: false
    },
    getters: {
        getUser(state) {
            return state.user
        }
    },
    mutations: {
        changeUser(state, payload) {
            return state.user = payload
        },
        logout(state) {
            state.user = false
            localStorage.removeItem('token')
            router.push('/login')
        }
    },
    actions: {}
})