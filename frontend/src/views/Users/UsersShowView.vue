<script setup lang="ts">
import {useUserStore} from "@/stores/UserStore";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";
import axiosInstance from "@/axios/axios";
import type {User} from "@/types/User";
import useUsers from "@/axios/useUsers";
import usePosts from "@/axios/usePosts";
import PostCard from "@/components/PostCard.vue";

const route = useRoute();
const authUser = useUserStore();
const user = ref<User>();
const isAuthUserPage = ref(false);
const {userPosts} = usePosts();
const posts = ref();

onMounted(async () => {
  isAuthUserPage.value = authUser.id === Number(route.params.id);
  if (isAuthUserPage.value) {
    user.value = authUser;
  } else {
    const {show} = useUsers();
    user.value = await show(Number(route.params.id));
  }

  posts.value = await userPosts(Number(route.params.id));
})

async function updateUser() {

}
</script>

<template>
  <div class="flex flex-col gap-3">
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-1 border border-gray-200 rounded-lg">
        <div class="border-b border-gray-200 py-4 px-3">
          <h5>Персональные данные</h5>
        </div>

        <div class="border-b border-gray-200 py-4 px-3">
          <div class="flex justify-between items-center">
            <h6 class="color-gray-500 h-auto">Фото</h6>

            <img v-if="user?.avatar" class="w-[75px] h-auto aspect-square rounded-full"
                 :src="axiosInstance.defaults.baseURL +'storage/'+ user.avatar" alt="avatar">
            <img v-else :src="axiosInstance.defaults.baseURL + 'storage/avatars/default.png'" alt="avatar">
          </div>
        </div>

        <div class="border-b border-gray-200 py-4 px-3">
          <div class="flex justify-between items-center">
            <h6 class="color-gray-500 h-auto mr-auto">Имя</h6>

            {{ user?.name }}
          </div>
        </div>

        <div class="border-b border-gray-200 py-4 px-3">
          <div class="flex justify-between items-center">
            <h6 class="color-gray-500 h-auto">Почта</h6>

            {{ user?.email }}
          </div>
        </div>
      </div>

      <div class="col-span-1 border border-gray-200 rounded-lg">
        <div class="border-b border-gray-200 py-4 px-3">
          <h5>Последние публикации</h5>
        </div>

        <div class="flex flex-col max-h-[250px] overflow-y-auto">
          <PostCard v-for="post of posts" :post="post" class="mt-3"/>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
