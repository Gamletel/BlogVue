import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from "@/views/RegisterView.vue";
import LoginView from "@/views/LoginView.vue";
import PostsCreateView from "@/views/Posts/PostsCreateView.vue";
import PostsIndexView from "@/views/Posts/PostsIndexView.vue";
import PostsShowView from "@/views/Posts/PostsShowView.vue";
import PostsUpdateView from "@/views/Posts/PostsUpdateView.vue";
import UsersShowView from "@/views/Users/UsersShowView.vue";
import UsersIndexView from "@/views/Users/UsersIndexView.vue";
import UsersSettingsView from "@/views/Users/UsersSettingsView.vue";
import useAuth from "@/axios/useAuth";
import {useUserStore} from "@/stores/UserStore";
import {echo} from "@/echo";
import AdminDashboardView from "@/views/Admin/AdminDashboardView.vue";
import RolesView from "@/views/Admin/RolesView.vue";

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
      path: '/users/',
      name: 'users.index',
      component: UsersIndexView,
    },
    {
      path: '/users/:id',
      name: 'users.show',
      component: UsersShowView,
    },
    {
      path: '/users/:id/settings',
      name: 'users.settings',
      component: UsersSettingsView,
    },
    {
      path: '/admin/dashboard',
      name: 'admin.dashboard',
      component: AdminDashboardView,
    },
    {
      path: '/admin/roles',
      name: 'admin.roles',
      component: RolesView,
    },
  ],
})

router.beforeEach(async (to, from, next) => {
  const userStore = useUserStore();
  const {attempt} = useAuth();

  if (userStore.id === -1) {
    try {
      await attempt();

      // echo.private(`user.notification.${userStore.id}`).listen('CommentSend', (e: any) => {
      //   console.log(e);
      // });
      // console.log(`user.notification.${userStore.id}`);

      return next();
    } catch (error) {
      console.error('Ошибка при попытке авторизации:', error);
      return next();
    }
  }

  return next();
});

export default router
