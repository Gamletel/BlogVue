<script setup lang="ts">

import {useUserStore} from "@/stores/UserStore";
import useAuth from "@/axios/useAuth";
import axiosInstance from "@/axios/axios";
import userPlaceholder from '@/assets/img/user-placeholder.png';

const {isAuth} = useAuth();
const user = useUserStore();

const {logout} = useAuth();
</script>

<template>
  <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 mb-3">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <router-link :to="{name:'home'}" class="flex items-center space-x-3 rtl:space-x-reverse mr-3">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo"/>
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">BlogVue</span>
      </router-link>
      <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ml-auto">
        <button type="button"
                class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" :src="user?.avatar ?
          // axiosInstance.defaults.baseURL+'storage/'+ user?.avatar
          user?.avatar
          : axiosInstance.defaults.baseURL + 'storage/avatars/default.png'"
               alt="user avatar">
        </button>
        <!-- Dropdown menu -->
        <div
          class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
          id="user-dropdown">
          <div class="px-4 py-3">
            <span v-if="isAuth" class="block text-sm text-gray-900 dark:text-white">
              {{ user.name }}
            </span>
            <span v-else class="block text-sm text-gray-900 dark:text-white">
              Гость
            </span>
            <span v-if="isAuth" class="block text-sm  text-gray-500 truncate dark:text-gray-400">
              {{ user.email }}
            </span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li v-if="!isAuth">
              <router-link :to="{name:'login'}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Войти
              </router-link>
              <router-link :to="{name:'register'}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Зарегистрироваться
              </router-link>
            </li>
            <li>
              <router-link :to="{name:'admin.dashboard'}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Админ-панель
              </router-link>
            </li>

            <li v-if="isAuth">
              <router-link :to="{name:'users.show', params:{id:user?.id}}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Профиль
              </router-link>
            </li>
            <li v-if="isAuth">
              <router-link :to="{name:'users.settings', params:{id:user?.id}}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Настройки
              </router-link>
            </li>
            <li v-if="isAuth">
              <button type="button" @click="logout"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                Выйти
              </button>
            </li>
          </ul>
        </div>
      </div>
      <button data-collapse-toggle="navbar-multi-level" type="button"
              class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
              aria-controls="navbar-multi-level" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto mx-auto" id="navbar-multi-level">
        <ul
          class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <router-link :to="{name:'home'}"
                         class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent"
                         aria-current="page">Главная
            </router-link>
          </li>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                    class="flex items-center justify-between w-full py-2 px-3 text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
              Посты
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                   viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4"/>
              </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar"
                 class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLargeButton">
                <li>
                  <router-link :to="{name:'posts.index'}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Все
                  </router-link>
                </li>
                <li aria-labelledby="dropdownNavbarLink" class="hidden">
                  <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                          data-dropdown-placement="right-start" type="button"
                          class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Dropdown
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                  <div id="doubleDropdown"
                       class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton">
                      <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Overview</a>
                      </li>
                      <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">My
                          downloads</a>
                      </li>
                      <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Billing</a>
                      </li>
                      <li>
                        <a href="#"
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Rewards</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li v-if="isAuth">
                  <router-link :to="{name:'users.show', params:{id:user.id}}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Мои посты
                  </router-link>
                </li>
              </ul>

              <div class="py-1" v-if="isAuth">
                <li>
                  <router-link :to="{name:'posts.create'}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Создать новый
                  </router-link>
                </li>
              </div>
            </div>
          </li>
          <li>
            <router-link :to="{name:'users.index'}"
                         class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
              Пользователи
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>


</template>

<style scoped>

</style>
