<script setup lang="ts">
import usePosts from "@/axios/usePosts";
import PostCard from "@/components/PostCard.vue";
import {onMounted, ref} from "vue";
import type {Post} from "@/types/Post";


const {index} = usePosts();
const posts = ref<Post[]>([]);

onMounted(async () => {
  posts.value = await index();
  console.log(posts.value);
  console.log(posts.value[0].id);
})
</script>

<template>
  <div class="flex flex-col gap-3 mx-auto">
    <PostCard v-for="post of posts" :post="post"/>
  </div>
</template>

<style scoped>

</style>
