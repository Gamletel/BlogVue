import {defineStore} from "pinia";
import axiosInstance from "@/axios/axios";

interface User {
  id: number,
  name: string,
  email: string,
  avatar: string | null,
}

export const useUserStore = defineStore('userStore', {
  state: () => ({
    id: 0,
    name: '',
    email: '',
    avatar: null as string | null,
  }),
  actions: {
    setUser(user: User) {
      this.id = user.id;
      this.name = user.name;
      this.email = user.email;
      this.avatar = user.avatar;
    },
    clearUser(){
      this.id = null;
      this.name = null;
      this.email = null;
      this.avatar = null;
    },
    $reset(){
      this.id = null;
      this.name = null;
      this.email = null;
      this.avatar = null;
    }
  }
})
