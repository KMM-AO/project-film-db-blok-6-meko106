import Vue from 'vue' // importing vue its self
import App from './App.vue' // importing the vue component
import router from './router' // importing the router

Vue.config.productionTip=false

new Vue({ // the vue instance will accept an options/object
  router,
  render: h => h(App)
}).$mount('#app')