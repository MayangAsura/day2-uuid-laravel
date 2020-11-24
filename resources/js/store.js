import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    count: 7,
}

const mutations = {
    increment: (state, payload)=>{
        state.count++
    }
}

const getters = {
    count : state => state.count
}

const actions = {
    
}

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})