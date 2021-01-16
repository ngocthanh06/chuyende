import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import { handleAuthorization } from '../helper/auth';
import store from '../Store/main';
import publicRoutes from './public.js';
import privateRoutes from './private.js';

const routes = publicRoutes.concat(privateRoutes);

const router = new VueRouter({
  mode: 'history',
  base: process.env.MIX_PUBLISH_APP_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticate = store.getters[ 'currentUser' ];
  const onlyLoggedOut = to.matched.some(record => record.meta.onlyLoggedOut);
  const isPublic = to.matched.some(record => record.meta.public);

  if (!isPublic && !isAuthenticate) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    return next({
      path: '/login',
      query: { 
        redirect: to.fullPath 
      }
    });
  }

  if (isAuthenticate && onlyLoggedOut || !to.matched.length) {
    return next('/homepage');
  }

  if (isAuthenticate) {
    handleAuthorization();
  }

  next();

});

export default router;
  