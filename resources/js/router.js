import { createRouter, createWebHistory } from 'vue-router'
import HomePage from './pages/HomePage.vue'
import Login from './pages/auth/Login.vue'
import Logout from './pages/auth/Logout.vue'
import Register from './pages/auth/Register.vue'
import Dashboard from './pages/Dashboard.vue'
import Post from './pages/post/Post.vue'
import User from './pages/user/User.vue'



export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage,
            meta: { layout: 'Guest' },
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { layout: 'Guest' },
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: { layout: 'Guest' },
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: { layout: 'Guest' },
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { layout: 'Admin', title: 'Dashboard' },
        },
        {
            path: '/post',
            name: 'post',
            component: Post,
            meta: { layout: 'Admin', title: 'Postingan' },
        },
        {
            path: '/user',
            name: 'user',
            component: User,
            meta: { layout: 'Admin', title: 'Anggota' },
        },
    ]
})