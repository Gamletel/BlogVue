<script setup lang="ts">
import usePosts from "@/axios/usePosts";
import PostCard from "@/components/PostCard.vue";
import {onMounted, ref} from "vue";
import type {Post} from "@/types/Post";

const {indexPosts} = usePosts();
const posts = ref<Post[]>([]);

onMounted(async () => {
  posts.value = await indexPosts();
})
</script>

<template>
  <h1 class="text-center mb-5">Посты</h1>

  <div v-if="posts.length > 0" class="flex flex-col gap-3 mx-auto">
    <PostCard v-for="post of posts" :post="post"/>
  </div>

  <h2 v-else class="text-center">Постов нет</h2>
</template>

<style scoped>

</style>
