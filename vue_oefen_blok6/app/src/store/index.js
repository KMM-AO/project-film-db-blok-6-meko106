import { createStore } from 'vuex'
import creatPersistedState from "vuex-persistedstate";

const dataSet=creatPersistedState({
  path : ['count']
})

export default createStore({
  state: {
    count:1,
    user:'Guest',
    loading:true
  },
  getter:{
    conunt2x(state){
      return state.count *2;
    }
  },
  mutations: {
    increment(state){
      state.count++;
    },
    toggleLoading(state){
      state.loading=state.loading ? false : true;
    },
    changeUser(state,username){
      // state.user=username.trim().length > 0 ? username: 'Guest';
      state.user=username.trim().length > 0 ? username: 'Guest';
    },
    test(){
      this.
    }
  },


  actions:{
    increment(context){
      context.commit
    }
  }
  actions: {},
  modules: {},
  plugins : [creatPersistedState()]
})
