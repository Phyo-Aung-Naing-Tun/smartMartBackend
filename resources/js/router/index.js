import { createMemoryHistory, createRouter } from 'vue-router'

import Home from '../pages/Home.vue'
import About from '../pages/About.vue'
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
  history: createMemoryHistory(),
  routes,
})