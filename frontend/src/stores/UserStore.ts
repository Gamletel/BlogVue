import {defineStore} from "pinia";
import type {User} from "@/types/User";

export const useUserStore = defineStore('userStore', {
  state: () => ({
    id: -1,
    name: '',
    email: '',
  }),
  actions: {
    setUser(user: User) {
      this.id = user.id;
      this.name = user.name;
      this.email = user.email;
    },
    clearUser() {
      this.id = null;
      this.name = null;
      this.email = null;
    },
    $reset() {
      this.id = null;
      this.name = null;
      this.email = null;
    }
  }
})
