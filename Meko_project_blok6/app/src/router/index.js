import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
// import Register from '../views/RegisterForm.vue'
import Login from '../views/Login.vue'

const routes = [
  {
    path: '/Home',
    name: 'Home',
    component: Home
  },
  // {
  //   path: '/register',
  //   name: 'Register',
  //   component: Register
  // },
  {
    path: '/Login',
    name: 'Login',
    component: Login
  },
  {
    path: '/Film/:id',
    name: 'Film',
    component: ()=>import(/* webpackChunkName:"Films"*/ '../views/Film.vue')
  },
]

const router = createRouter({

  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router