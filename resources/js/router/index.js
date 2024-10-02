import { createWebHistory, createRouter } from 'vue-router'

import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Default from '../layouts/Default.vue'

const routes = [
  {
    path: '/', component: Default, children: [{
      path: '', component: Home
    }]
  },
  { path: '/about', component: About },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})