<script setup lang="ts">
import {useUserStore} from "@/stores/UserStore";
import {onMounted, ref} from "vue";
import useUsers from "@/axios/useUsers";
import type {User} from "@/types/User";
import useAuth from "@/axios/useAuth";
import axiosInstance from "@/axios/axios";

const {updateUser} = useUsers();
const {attempt} = useAuth();

const user = useUserStore();
const name = ref<string>(user.name);
const email = ref<string>(user.email);
const old_password = ref<string>('');
const password = ref<string>(user.password);
const avatar = ref<File | null>(null);
const response = ref();

async function handleSubmit() {
  const formData = new FormData();
  formData.append("id", user.id.toString());
  formData.append("name", name.value);
  formData.append("email", email.value);

  if (password.value) {
    formData.append("password", password.value);
    formData.append("old_password", old_password.value);
  }

  console.log(formData);

  let data: User = {
    id: user.id,
    name: name.value,
    email: email.value,
    avatar: avatar.value,
  };

  if (data.avatar) {
    console.log(data.avatar);
  }

  if (avatar.value) {
    formData.append("avatar", avatar.value);
    console.log(formData.get('avatar'));
  }

  response.value = await updateUser(formData);
  console.log(response.value);
  await attempt();
}

function handleFileChange(event: Event) {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    avatar.value = target.files[0];
  }
}
</script>

<template>
  <h1 class="mb-5">Настройки</h1>

  <div v-if="response && response.errors">
    <ul class="mb-5">
      <li v-for="(error, index) in response.errors" :key="index">
        <p class="text-red-500 mb-2">
          {{ error[0] }}
        </p>
      </li>
    </ul>
  </div>

  <form @submit.prevent="handleSubmit">
    <label for="avatar" class="cursor-pointer">
      <img
        :src="
        // axiosInstance.defaults.baseURL+'storage/'+user?.avatar
         user?.avatar
         ?? axiosInstance.defaults.baseURL + 'storage/avatars/default.png'"
        alt=""
        class="w-[100px] h-[100px] rounded-full mb-5">
    </label>

    <input type="file" @change="handleFileChange" class="hidden" name="avatar" id="avatar" accept="image/*">

    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
        <input v-model="name" type="text" id="name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="myCoolUsername2003" required/>
      </div>
      <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input v-model="email" type="email" id="email"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="example@mail.com" required/>
      </div>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div class="">
        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old
          Password</label>
        <input v-model="old_password" type="password" id="old_password"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="•••••••••" autocomplete="false"/>
      </div>

      <div class="">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
        <input v-model="password" type="password" id="password"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="•••••••••" autocomplete="false"/>
      </div>
    </div>


    <div class="flex gap-3">
      <button type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Сохранить
      </button>

      <button @click="$router.back()"
              class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
        Назад
      </button>
    </div>
  </form>
</template>

<style scoped>

</style>
