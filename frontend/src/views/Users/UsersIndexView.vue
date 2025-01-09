<script setup lang="ts">
import useUsers from "@/axios/useUsers";
import {onMounted, ref} from "vue";
import UserCard from "@/components/UserCard.vue";
import type {User} from "@/types/User";
import UserPlaceholderCard from "@/components/UserPlaceholderCard.vue";

const {indexUsers} = useUsers();
const users = ref<User[]>([]);
const isLoading = ref(true);

onMounted(async () => {
  users.value = await indexUsers();
  isLoading.value = false;
})
</script>

<template>
  <h1 class="text-center mb-5">Пользователи</h1>

  <div v-if="isLoading" class="grid grid-cols-3 gap-3 animate-pulse" role="status">
    <UserPlaceholderCard v-for="n in 9" :key="n" />
  </div>

  <div v-else>
    <div v-if="users.length" class="grid grid-cols-3 gap-3">
      <div v-for="user in users" class="w-full">
        <UserCard :id="user.id"/>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>
