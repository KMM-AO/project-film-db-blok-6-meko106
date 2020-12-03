import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import PostDetail from '../views/Posts.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/contact',
    name: 'Contact',
    component: () => import(/* webpackChunkName: "about" */ '../views/Contact.vue')
  },
  {
    path:'/acteur/:id?',
    name: 'Acteur',
    component: () => import(/* webpackChunkName: "about" */ '../views/Acteur.vue')
  },


  {
    path:'/posts',

    component: ()=> import (/*webpackChunkName */ "../views/Posts.vue"),
    childeren:[
      {
        path: 'new',
        component: ()=> import(/* */ "../components/PostNew.vue"),
        mets:{requireAuth: true , favs:5}
      },
      {
        path: ':id',
        component: PostDetail,
        meta:{requireAuth: true, favs:5 , loggedIn:false},
      }
    ]
  },
]

const router=createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

router.beforeEach((to,from,next)=>{
  console.log('To',to);
  console.log('From',from);
  next();
})


export default router