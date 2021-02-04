import { createRouter, createWebHistory } from 'vue-router'
const routes = 
[
  {
    path: '/',
    name: 'Home',
    component: ()=>import(/* webpackChunkName:"Home"*/ '../views/Home.vue')
  },
  {
    path: '/Films/:id',
    name: 'Films',
    component: ()=>import(/* webpackChunkName:"Films"*/ '../views/Films.vue')
  },
  {
    path: '/Person/:id',
    name: 'Person',
    component: ()=>import(/* webpackChunkName:"Person"*/ '../views/Person.vue')
  },
  {
    path: '/Films_search/:film_name',
    name: 'FilmsSearch',
    component: ()=>import(/* webpackChunkName:"FilmsSearch"*/ '../views/Films_search.vue')
  }
]

const router = createRouter({
  linkActiveClass:"active_class",
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router
