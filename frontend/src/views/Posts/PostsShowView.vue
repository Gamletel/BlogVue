<script setup lang="ts">
import usePosts from "@/axios/usePosts";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import type {Post} from "@/types/Post";
import {useUserStore} from "@/stores/UserStore";

const route = useRoute();
const postID = Number(route.params.id);
const {show} = usePosts();
const post = ref<Post>();

const user = useUserStore();

onMounted(async () => {
  post.value = await show(postID);
  console.log(post.value?.title);
})
</script>

<template>
  <h3><strong>Автор:</strong>{{  }}</h3>
  <h3><strong>Дата публикации:</strong>{{ post.created_at }}</h3>
  <h1 v-if="post" class="mb-3">{{post.title}}</h1>
</template>

<style scoped>

</style>
