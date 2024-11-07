<script setup lang="ts">
import {useUserStore} from "@/stores/UserStore";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";
import axiosInstance from "@/axios/axios";

const route = useRoute();
const user = useUserStore();
const isAuthUserPage = ref(false);

onMounted(() => {
  if (user.id == Number(route.params.id)) {
    isAuthUserPage.value = true;
  }
  console.log(isAuthUserPage.value);
})
</script>

<template>
  <div class="grid grid-cols-12 gap-3">
    <div v-if="user.avatar" class="bg-gray-500 col-span-4">
      <img class="w-20 h-20 rounded" :src="axiosInstance.defaults.baseURL +'storage/'+ user.avatar" alt="avatar">
    </div>

    <div class="bg-green-200 col-span-8">
      <div class="flex flex-col gap-3">
        <h6>Имя: {{ user.name }}</h6>
        <h6>Эл. почта: {{ user.email }}</h6>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
