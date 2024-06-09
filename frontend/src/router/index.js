import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue'),
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: ()=> import('../views/LoginView.vue')
    }
  ]
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('accessToken');
  if (to.meta.requiresAuth) {
    if (token && token !== '') {
      // User is authenticated, proceed to the route
      next();
    } else {
      // User is not authenticated, redirect to login
      next('/login');
    }
  } else if (to.name === 'login' || to.name === 'register') {
    // If user is authenticated, prevent access to login and register routes
    if (token && token !== '') {
      next('/'); // Redirect to home or dashboard route
    } else {
      next(); // Allow access to login and register routes
    }
  } else {
    // Non-protected route, allow access
    next();
  }
});

export default router
