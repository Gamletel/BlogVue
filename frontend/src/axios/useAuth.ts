import {computed, reactive} from "vue";
import axiosInstance from "@/axios/axios";
import {useUserStore} from "@/stores/UserStore";

interface User {
  id: number,
  name: string,
  email: string,
  password: string,
}

const state = reactive({
  isAuth: false,
  user: {},
})

export default function useAuth() {
  const userStore = useUserStore();

  const isAuth = computed(() => state.isAuth);
  const user = computed(() => state.user);

  const setIsAuth = (isAuth: boolean) => {
    state.isAuth = isAuth;
  }

  const setUser = (user: User) => {
    state.user = user;
  }

  const login = async (credentials: {
    email: string,
    password: string,
    remember: number,
  }) => {
    try {
      const response = await axiosInstance.post('/api/login', {
        'email': credentials.email,
        'password': credentials.password,
        'remember': credentials.remember,
      });

      localStorage.setItem('access_token', response.data.access_token);
      await attempt();
    } catch (e) {
      console.error(e);
    }
  }

  const attempt = async () => {
    try {
      let response = await axiosInstance.get('/api/user');
      setIsAuth(true);
      setUser(response.data);

      userStore.setUser(user.value);

      return response;
    } catch (e) {
      console.error(e);
      setIsAuth(false);
      setUser(null);
      userStore.$reset();
    }
  }

  const logout = async () => {
    try {
      const response = await axiosInstance.post('/api/logout');
      console.log(response);

      localStorage.removeItem('access_token');

      await attempt();
    } catch (e) {
      console.error(e);
    }
  }

  const register = async (credentials: {
    name: string,
    email: string,
    password: string,
    password_confirmation: string,
    remember: boolean,
  }) => {
    try {
      const response = await axiosInstance.post('/api/register', {
        'name': credentials.name,
        'email': credentials.email,
        'password': credentials.password,
        'password_confirmation': credentials.password_confirmation,
        'remember': credentials.remember,
      });

      await login({
        email: credentials.email,
        password: credentials.password,
        remember: credentials.remember
      });
    } catch (e) {
      console.error(e);
    }
  }

  return {
    isAuth,
    login,
    user,
    attempt,
    logout,
    register,
  };
}
