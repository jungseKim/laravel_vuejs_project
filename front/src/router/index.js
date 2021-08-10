import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import map from '@/components/map.vue'

Vue.use(VueRouter)

const routes = [
  {path: '/', name: 'Home',component: Home },
  { path: '/map', name: 'map', component: map },
   
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
