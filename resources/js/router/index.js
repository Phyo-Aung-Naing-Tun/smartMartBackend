import { createWebHistory, createRouter } from 'vue-router'

import Default from '../layouts/Default.vue';

//Users
const Index = import('../views/user/index.vue');
//

const routes = [
  {
    path: '/', component: Default, children: [{
      //User
      path: "/user", component: Index,
      //
    }]
  },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})