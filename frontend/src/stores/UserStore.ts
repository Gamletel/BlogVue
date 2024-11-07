import {defineStore} from "pinia";
import type {User} from "@/types/User";

export const useUserStore = defineStore('userStore', {
  state: () => ({
    id: -1,
    name: '',
    email: '',
    password: '',
    avatar: '',
  }),
  actions: {
    setUser(user: User) {
      this.id = user.id;
      this.name = user.name;
      this.email = user.email;
      this.password = user.password;
      this.avatar = user.avatar;
    },
    $reset() {
      this.id = null;
      this.name = null;
      this.email = null;
      this.password = null;
      this.avatar = null;
    }
  }
})
