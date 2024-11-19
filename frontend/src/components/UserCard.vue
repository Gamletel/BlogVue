<script setup lang="ts">

import useUsers from "@/axios/useUsers";
import {onMounted, ref} from "vue";
import type {User} from "@/types/User";
import {useUserStore} from "@/stores/UserStore";
import axiosInstance from "@/axios/axios";

const props = defineProps<{
  id: number,
}>();

const {showUser} = useUsers();
const user = ref<User>();

const authUser = useUserStore();

onMounted(async () => {
  user.value = await showUser(props.id);
})
</script>

<template>
  <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-end px-4 pt-4">
      <button :id="`dropdownButton-${props.id}`"
              :data-dropdown-toggle="`dropdown-${props.id}`"
              class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
              type="button">
        <span class="sr-only">Подробнее</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
             viewBox="0 0 16 3">
          <path
            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
        </svg>
      </button>
      <!-- Dropdown menu -->
      <div :id="`dropdown-${props.id}`"
           class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2"
            :aria-labelledby="`dropdownButton-${props.id}`">
          <li>
            <a href="#"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
          </li>
          <li>
            <a href="#"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
              Data</a>
          </li>
          <li>
            <a href="#"
               class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="flex flex-col items-center pb-10">
      <router-link :to="{name:'users.show', params:{id: props.id}}">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
             :src="axiosInstance.defaults.baseURL +'storage/'+ user?.avatar"
             alt="Bonnie image"/>
      </router-link>
      <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
        {{ user?.name }}

        {{ authUser.id === props.id ? '(Вы)' : null }}
      </h5>
      <span class="text-sm text-gray-500 dark:text-gray-400">{{ user?.email }}</span>
      <div class="flex mt-4 md:mt-6">
        <a href="#"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Add friend
        </a>
        <a href="#"
           class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Message
        </a>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
