import { createRouter, createWebHistory } from "vue-router";
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import Dashboard from '../components/dashboard/Dashboard'
import RoomIndex from '../components/dashboard/room/RoomIndex'
import RoomCreate from '../components/dashboard/room/RoomCreate'
import RoomUpdate from '../components/dashboard/room/RoomUpdate'
import PeopleCreate from '../components/dashboard/people/PeopleCreate'
import PeopleUpdate from '../components/dashboard/people/PeopleUpdate'
import store from "../store/store";

const routes = [
    {
        path: '/login',
        name: 'login.index',
        component: Login,
        meta: { requiresAuth: false }
    },
    {
        path: '/register',
        name: 'register.index',
        component: Register,
        meta: { requiresAuth: false }
    },
    {
        path: '/dashboard',
        name: 'dashboard.index',
        component: Dashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/room/:id',
        name: 'room.index',
        component: RoomIndex,
        meta: { requiresAuth: true },
        props: true
    },
    {
        path: '/dashboard/room/create',
        name: 'room.create',
        component: RoomCreate,
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/room/:id/edit',
        name: 'room.edit',
        component: RoomUpdate,
        meta: { requiresAuth: true },
        props: true
    },
    {
        path: '/dashboard/people/create',
        name: 'people.create',
        meta: { requiresAuth: true },
        component: PeopleCreate,
    },
    {
        path: '/dashboard/room/people/:people_id/edit',
        name: 'people.edit',
        meta: { requiresAuth: true },
        component: PeopleUpdate,
        props: true
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

let entryUrl = null;
router.beforeEach((to, from, next) => {
    let authToken = localStorage.getItem("auth_token");
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!authToken) {
            if (to.name !== "login.index" && to.name !== "dashboard.index") {
                entryUrl = to.fullPath;
            }
            next({ name: "login.index" });
        } else if (entryUrl) {
            let url = entryUrl;
            entryUrl = null;
            next(url);
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router


