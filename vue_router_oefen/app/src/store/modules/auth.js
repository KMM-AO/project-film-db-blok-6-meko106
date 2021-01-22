//store/modules/auth.js

import axios from 'axios';
const state = {
    user:null,
    posts:null,
};

const getters = { //getters are functions to get the state.
    isAuthenticated: state => !!state.user,    
    StatePosts: state => state.posts, // it returns state.posts
    StateUser: state => state.user, // it return state.user
};
const actions = {
    async Register({dispatch}, form) {
        await axios.post('register', form)
        let UserForm = new FormData()
        UserForm.append('username', form.username)
        UserForm.append('password', form.password)
        await dispatch('LogIn', UserForm)
      },
      async LogIn({commit}, User) {
        await axios.post('login', User)
        await commit('setUser', User.get('username'))
      },
      async CreatePost({dispatch}, post) {
        await axios.post('post', post)
        await dispatch('GetPosts')
      },
      async GetPosts({ commit }){//it send a GET request to the /posts endpoint
        let response = await axios.get('posts')
        commit('setPosts', response.data)
      },
      async LogOut({commit}){ // it removes the user from the browser cache by commiting logout
        let user = null
        commit('logout', user)
      }


};
const mutations = {
    setUser(state, username){
        state.user = username
    },
    setPosts(state, posts){
        state.posts = posts
    },
    LogOut(state){
        state.user = null
        state.posts = null
    },
};
export default {
  state,
  getters,
  actions,
  mutations
};
