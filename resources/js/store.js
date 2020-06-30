import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
       lastSearch:{
           from:null,
           to:null
       }
    },
    mutations: {
        setLastSearch (state, payload) {
            state.lastSearch = payload;
        }
    },
    actions:{
        setLastSearch(context, payload){
            context.commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        },
        loadStoredState(context){
            const lastSearch = localStorage.getItem('lastSearch');
            if(lastSearch){
                context.commit('setLastSearch', JSON.parse(lastSearch));
            }
        }
    }
})

export default store;
