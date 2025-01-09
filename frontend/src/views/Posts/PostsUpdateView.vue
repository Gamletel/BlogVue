<script setup lang="ts">
import {onMounted, ref} from "vue";
import usePosts from "@/axios/usePosts";
import {useUserStore} from "@/stores/UserStore";
import type {Post} from "@/types/Post";
import {useRoute} from "vue-router";

const {showPost} = usePosts();
const post = ref<Post>();
const title = ref('');
const description = ref('');
const text = ref('');

const route = useRoute();
const post_id = route.params.id;

async function handleSubmit() {
  const {updatePost} = usePosts();

  await updatePost(post_id, {
    title: title.value,
    description: description.value,
    text: text.value
  });
}

onMounted(async () => {
  const response = await showPost(post_id);
  post.value = response.post;

  title.value = post.value.title;
  description.value = post.value.description;
  text.value = post.value.text;
})
</script>

<template>
  <form @submit.prevent="handleSubmit">
    <div class="mb-6">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Заголовок</label>
      <input v-model="title" type="text" id="title"
             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
             placeholder="Введите заголовок" required/>
    </div>

    <div class="mb-6">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
      <input v-model="description" type="text" id="description"
             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
             placeholder="Введите описание"/>
    </div>

    <div class="mb-6">
      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст</label>

      <quill-editor v-model:content="text" contentType="html" theme="snow"/>
    </div>

    <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Сохранить
    </button>

    <router-link :to="{name:'posts.show', params:{id:post_id}}"
                 class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
      Назад
    </router-link>
  </form>
</template>

<style scoped>

</style>
