import Vue from 'vue';
import VueRouter from 'vue-router';
import MangaDetails from './components/MangaDetails.vue'; // Example component

Vue.use(VueRouter);

const routes = [
  {
    path: '/manga/:id',  // ':id' is the dynamic segment
    component: MangaDetails,
  },
];

const router = new VueRouter({
  routes,
});

export default router;
