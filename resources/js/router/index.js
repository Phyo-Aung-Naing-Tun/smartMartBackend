import { createWebHistory, createRouter } from 'vue-router'
//layouts
const Default = () => import('../layouts/Default.vue');
const Auth = () => import('../layouts/Auth.vue');
// ----

const Home = () => import('../views/index.vue')

//Users
const Index = () => import('../views/user/index.vue');
// ----

//Auth
const Login = () => import('../views/Login.vue');
const Register = () => import('../views/Register.vue');
// ----


//Profile
const Profile = () => import('../views/profile/index.vue');
// ----


const routes = [
  {
    path: '/', 
    component: Default, 
    children: [
      {
        path: '',
        component: Home
      },
      {
      path: "user",
       component: Index,
      },
      {
        path: "profile",
        component: Profile,
      }
    ],
      
  },
  {
    path: '/auth',
    component: Auth,
    children:[
      { path: "login",component: Login},
      { path: "register",component: Register}
    ]
  }
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})