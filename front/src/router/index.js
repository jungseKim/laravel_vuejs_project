import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../views/login.vue'
import map from '@/components/map.vue'

Vue.use(VueRouter)

const routes = [
  {path: '/login', name: 'Home',component: login },
  { path: '/map', name: 'map', component: map,meta:{auth:true} },
   
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const loggedIn = localStorage.getItem('user')
  console.log(localStorage.getItem('user'))
  if (to.matched.some(record => record.meta.auth) && !loggedIn) {
    next('/login')
    return
  }
  next()
})

export default router
