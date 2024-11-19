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
  <div v-if="posts.length > 0" class="flex flex-col gap-3 mx-auto">
    <PostCard v-for="post of posts" :post="post"/>
  </div>
</template>

<style scoped>

</style>
