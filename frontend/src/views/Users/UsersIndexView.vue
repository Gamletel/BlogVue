<script setup lang="ts">
import useUsers from "@/axios/useUsers";
import {onMounted, ref} from "vue";
import UserCard from "@/components/UserCard.vue";

const {index} = useUsers();
const users = ref();

onMounted(async () => {
  users.value = await index();
})
</script>

<template>
  <div class="grid grid-cols-3">
    <div v-for="user in users" class="w-full">
      <UserCard :id="user.id"/>
    </div>
  </div>
</template>

<style scoped>

</style>
