import { createRouter, createWebHistory } from 'vue-router'
import HomePage from './pages/HomePage.vue'
import Login from './pages/auth/Login.vue'
import Logout from './pages/auth/Logout.vue'
import Register from './pages/auth/Register.vue'
import Dashboard from './pages/Dashboard.vue'
import User from './pages/user/User.vue'
import AddUser from './pages/user/Add.vue'
import EditUser from './pages/user/Edit.vue'
import Book from './pages/book/Book.vue'
import AddBook from './pages/book/Add.vue'
import EditBook from './pages/book/Edit.vue'
import Pinjam from './pages/pinjam/Pinjam.vue'
import AddPinjam from './pages/pinjam/Add.vue'
import EditPinjam from './pages/pinjam/Edit.vue'


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
            path: '/user',
            name: 'user',
            component: User,
            meta: { layout: 'Admin', title: 'Anggota' },
        },
        {
            path: '/user/add',
            name: 'adduser',
            component: AddUser,
            meta: { layout: 'Admin', title: 'Tambah Anggota' },
        },
        {
            path: '/user/edit/:id',
            name: 'edituser',
            component: EditUser,
            meta: { layout: 'Admin', title: 'Edit Anggota' },
        },
        {
            path: '/book',
            name: 'book',
            component: Book,
            meta: { layout: 'Admin', title: 'Buku' },
        },
        {
            path: '/book/add',
            name: 'addbook',
            component: AddBook,
            meta: { layout: 'Admin', title: 'Tambah Buku' },
        },
        {
            path: '/book/edit/:id',
            name: 'editbook',
            component: EditBook,
            meta: { layout: 'Admin', title: 'Edit Buku' },
        },
        {
            path: '/pinjam',
            name: 'pinjam',
            component: Pinjam,
            meta: { layout: 'Admin', title: 'Pinjam' },
        },
        {
            path: '/pinjam/add',
            name: 'addpinjam',
            component: AddPinjam,
            meta: { layout: 'Admin', title: 'Tambah Pinjam' },
        },
        {
            path: '/pinjam/edit/:id',
            name: 'editpinjam',
            component: EditPinjam,
            meta: { layout: 'Admin', title: 'Edit Pinjam' },
        },
    ]
})