<script setup lang="ts">
import usePosts from "@/axios/usePosts";
import {onMounted, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import type {Post} from "@/types/Post";
import {useUserStore} from "@/stores/UserStore";
import type {User} from "@/types/User";
import moment from "moment";
import router from "@/router";

const route = useRoute();
const post_id = Number(route.params.id);
const {show, deletePost} = usePosts();
const post = ref<Post>();
const creator = ref<User>();

const user = useUserStore();

const user_is_creator = ref(false);

async function handleDelete() {
  await deletePost(post_id);

  await router.back();
}


onMounted(async () => {
  const response = await show(post_id);
  post.value = response.post;
  creator.value = response.creator;

  user_is_creator.value = creator?.value?.id === user.id;
})
</script>

<template v-if="post">
  <h1 class="mb-5">{{ post?.title }}</h1>
  <h3 v-if="post?.description" class="mb-3">{{ post?.description }}</h3>
  <div v-if="post?.text" class="text-block" v-html="post?.text"></div>
  <p class="mb-2"><strong>Автор:</strong> {{ user_is_creator ? 'Вы' : creator?.name }}</p>
  <p class="mb-2"><strong>Дата публикации:</strong>{{ moment(post?.created_at).calendar() }}</p>

  <div class="inline-flex rounded-md shadow-sm mt-3" role="group">
    <router-link :to="{name:'posts.update'}"
                 class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
           width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
      </svg>

      Редактировать
    </router-link>
    <!--    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">-->
    <!--      <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">-->
    <!--        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2"/>-->
    <!--      </svg>-->
    <!--      Settings-->
    <!--    </button>-->
    <button type="button" @click="handleDelete"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
           width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
      </svg>

      Удалить
    </button>
  </div>

</template>

<style scoped>

</style>
