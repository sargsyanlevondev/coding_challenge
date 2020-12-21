import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path:'',
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router;

// router.beforeEach((to, from, next) => {
//     if (to.meta.requiresAuth) {
//         const token = localStorage.getItem('token');
//         if (token) {
//             next();
//         } else {
//             next({path: '/login',
//                 query: {
//                     nextUrl: to.fullPath,
//                 }});
//         }
//         next()
//     }
//     next()
// })
