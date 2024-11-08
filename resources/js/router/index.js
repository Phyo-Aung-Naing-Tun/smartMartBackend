import { createWebHistory, createRouter } from "vue-router";
//layouts
const Default = () => import("../layouts/Default.vue");
const Auth = () => import("../layouts/Auth.vue");
// ----

const Home = () => import("../views/index.vue");

//Users
const Index = () => import("../views/user/index.vue");
const UserDetails = () => import("../views/user/Details.vue");
const UserEdit = () => import("../views/user/Edit.vue");
// ----

//Auth
const Login = () => import("../views/Login.vue");
const Register = () => import("../views/Register.vue");
// ----

//Profile
const Profile = () => import("../views/profile/index.vue");
// ----

const routes = [
    {
        path: "/",
        component: Default,
        children: [
            {
                path: "",
                component: Home,
            },
            {
                path: "users",
                component: Index,
            },
            {
                path: "users/:id",
                component: UserDetails,
            },
            {
                path: "users/user/:id",
                component: UserEdit,
            },
            {
                path: "profile",
                component: Profile,
            },
        ],
    },
    {
        path: "/auth",
        component: Auth,
        children: [
            { path: "login", component: Login },
            { path: "register", component: Register },
        ],
    },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
