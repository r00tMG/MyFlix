import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "@/views/HomePage.vue";
import ShowPage from "@/views/ShowPage.vue";
import Login from "@/views/Login.vue";
import Register from "@/views/Register.vue";
import Admin from "@/views/admin/Admin.vue";
import CreateFilms from "@/views/admin/CreateFilms.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/home',
      name: 'homePage',
      component: HomePage,
      meta: { requiresAuth:true }
    },
    {
      path: '/show/:titre-:id',
      name: 'showPage',
      component: ShowPage,
      meta: {requiresAuth: true}
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,
      meta: {requiresAuth: true},
    },
    {
      path: '/admin/create',
      name: 'create',
      component: CreateFilms
    }


  ]
})
router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const token = localStorage.getItem('token');

  if (requiresAuth && !token) {
    next('/');
  } else {
    next();
  }
});


export default router
