<script setup lang="ts">

import {onMounted, ref} from "vue";
import type {Comment} from "@/types/Comment";
import useComments from "@/axios/useComments";
import type {User} from "@/types/User";
import useUsers from "@/axios/useUsers";
import moment from "moment";
import axiosInstance from "@/axios/axios";
import {useUserStore} from "@/stores/UserStore";

const props = defineProps<{
  id: number
}>()

const {showComment, deleteComment} = useComments();
const comment = ref<Comment>();

const {showUser} = useUsers();
const user = ref<User>();
const auth_user = useUserStore();

const is_auth_user_owner = ref<boolean>(false);

const emit = defineEmits<{
  (event: 'commentDeleted', id: number): void;
}>();

async function handleDeleteComment() {
  const response = await deleteComment(props.id);
  if (response?.status === 200) {
    emit('commentDeleted', props.id);
  }
}

onMounted(async () => {
  comment.value = await showComment(props.id);
  user.value = await showUser(comment.value?.user_id);

  is_auth_user_owner.value = auth_user.id === user.value?.id;
})
</script>

<template>
  <article class="w-full bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-700 rounded-lg p-3">
    <div class="flex items-center mb-4">
      <img class="w-10 h-10 me-4 rounded-full" :src="axiosInstance.defaults.baseURL+'storage/'+ user?.avatar" alt="">
      <div class="font-medium dark:text-white">
        <p> {{ user?.name }}
          <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 dark:text-gray-400">
            {{ moment(comment?.updated_at).calendar() }}
          </time>
        </p>
      </div>

      <div v-if="is_auth_user_owner" class="ml-auto">
        <form @submit.prevent="handleDeleteComment">
          <button type="submit"
                  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            <svg class="w-[16px] h-[16px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                 height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
            <span class="sr-only">Delete comment</span>
          </button>
        </form>
      </div>
    </div>
    <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
      <div class="rating flex items-center">
        <template v-for="i in 5" :key="i">
          <svg
            v-if="i <= (comment?.rating || 0)"
            class="w-4 h-4 ms-1 text-yellow-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
          <svg
            v-else
            class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
        </template>
      </div>

      <h3 class="ms-2 text-sm font-semibold text-gray-900 dark:text-white">{{ comment?.title }}</h3>
    </div>
    <div class="text-block" v-html="comment?.text"></div>
  </article>
</template>

<style scoped>
.rating input[type="radio"] ~ label svg {
  color: #f59e0b; /* Жёлтый цвет для активных */
}

.rating input[type="radio"]:checked ~ label svg,
.rating input[type="radio"]:checked ~ label ~ label svg {
  color: #f59e0b; /* Жёлтый цвет для активных */
}

.rating input[type="radio"]:hover ~ label svg {
  color: #f59e0b; /* Жёлтый цвет для активных */
}

.rating input[type="radio"]:checked ~ label ~ label svg,
.rating input[type="radio"]:hover ~ label ~ label svg {
  color: gray;
}
</style>
