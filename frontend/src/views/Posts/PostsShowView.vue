<script setup lang="ts">
import usePosts from "@/axios/usePosts";
import {onMounted, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import type {Post} from "@/types/Post";
import {useUserStore} from "@/stores/UserStore";
import type {User} from "@/types/User";
import moment from "moment";
import router from "@/router";
import CommentCard from "@/components/CommentCard.vue";
import useComments from "@/axios/useComments";
import useAuth from "@/axios/useAuth";

const route = useRoute();
const post_id = Number(route.params.id);
const {showPost, deletePost, postComments} = usePosts();
const post = ref<Post>();
const creator = ref<User>();
const comments = ref<number[]>([]);

const user = useUserStore();

const {isAuth} = useAuth();

const user_is_creator = ref(false);

const {storeComment} = useComments();
const comment_title = ref<string>("");
const comment_text = ref<string>("");
const comment_rating = ref<number>(5);

async function handleDelete() {
  await deletePost(post_id);

  router.back();
}

async function handleCommentSend() {
  if (isAuth.value) {
    const data = await storeComment({
      post_id: post_id,
      user_id: user.id,
      rating: comment_rating.value,
      title: comment_title.value,
      text: comment_text.value,
    });

    comment_rating.value = 5;
    comment_title.value = "";
    comment_text.value = "";

    comments.value.unshift(data.id);
  }
}

function removeComment(deletedId: number) {
  comments.value = comments.value.filter(comment => comment !== deletedId);
}

onMounted(async () => {
  const response = await showPost(post_id);
  post.value = response.post;
  creator.value = response.user;

  user_is_creator.value = creator?.value?.id === user.id;

  comments.value = await postComments(post_id);
  console.log(comments.value);
})
</script>

<template v-if="post">
  <h1 class="mb-5">{{ post?.title }}</h1>
  <h3 v-if="post?.description" class="mb-3">{{ post?.description }}</h3>
  <div v-if="post?.text" class="text-block" v-html="post?.text"></div>
  <p class="mb-2"><strong>Автор:</strong> {{ user_is_creator ? 'Вы' : creator?.name }}</p>
  <p class="mb-2"><strong>Дата публикации:</strong>{{ moment(post?.created_at).calendar() }}</p>

  <div v-if="user_is_creator" class="inline-flex rounded-md shadow-sm mt-3" role="group">
    <router-link :to="{name:'posts.update'}"
                 class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
           width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
      </svg>

      Редактировать
    </router-link>
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

  <form v-if="isAuth" @submit.prevent="handleCommentSend" class="mt-5 border rounded-lg p-5">
    <h6 class="mb-3">Оставьте комментарий</h6>

    <div class="rating flex items-center mb-5">
      <input v-model="comment_rating" type="radio" name="comment_rating" value="1" id="comment_rating_1" class="hidden">
      <label for="comment_rating_1">
        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 22 20">
          <path
            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
      </label>

      <input v-model="comment_rating" type="radio" name="comment_rating" value="2" id="comment_rating_2" class="hidden">
      <label for="comment_rating_2">
        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 22 20">
          <path
            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
      </label>

      <input v-model="comment_rating" type="radio" name="comment_rating" value="3" id="comment_rating_3" class="hidden">
      <label for="comment_rating_3">
        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 22 20">
          <path
            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
      </label>

      <input v-model="comment_rating" type="radio" name="comment_rating" value="4" id="comment_rating_4" class="hidden">
      <label for="comment_rating_4">
        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 22 20">
          <path
            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
      </label>

      <input v-model="comment_rating" type="radio" name="comment_rating" value="5" id="comment_rating_5" class="hidden">
      <label for="comment_rating_5">
        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 22 20">
          <path
            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
        </svg>
      </label>
    </div>

    <div class="mb-6">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Заголовок</label>
      <input v-model="comment_title" type="text" id="title"
             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
             placeholder="Введите заголовок" required/>
    </div>

    <div class="mb-6">
      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст</label>

      <quill-editor v-model:content="comment_text" contentType="html" theme="snow"/>
    </div>

    <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Отправить
    </button>
  </form>

  <div v-if="comments"
       id="comments"
       class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 bg-white dark:bg-gray-800 flex flex-col gap-5 p-5 mt-5">
    <CommentCard v-for="comment in comments"
                 :key="comment"
                 :id="comment"
                 @commentDeleted="removeComment"
    />
  </div>
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
