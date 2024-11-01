import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from "@/views/RegisterView.vue";
import LoginView from "@/views/LoginView.vue";
import PostsCreateView from "@/views/Posts/PostsCreateView.vue";
import PostsIndexView from "@/views/Posts/PostsIndexView.vue";
import PostsShowView from "@/views/Posts/PostsShowView.vue";
import PostsUpdateView from "@/views/Posts/PostsUpdateView.vue";
import UsersShowView from "@/views/Users/UsersShowView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/posts',
      name: 'posts.index',
      component: PostsIndexView,
    },
    {
      path: '/posts/:id',
      name: 'posts.show',
      component: PostsShowView,
    },
    {
      path: '/posts/create',
      name: 'posts.create',
      component: PostsCreateView,
    },
    {
      path: '/posts/:id/update',
      name: 'posts.update',
      component: PostsUpdateView,
    },
    {
      path: '/user/:id',
      name: 'user.show',
      component: UsersShowView,
    },
  ],
})

export default router
