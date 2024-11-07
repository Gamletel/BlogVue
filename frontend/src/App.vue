<script setup lang="ts">
import {RouterLink, RouterView} from 'vue-router'
import Header from "@/components/Header.vue";
import MainLayout from "@/layouts/MainLayout.vue";
import useAuth from "@/axios/useAuth";
import {onBeforeMount} from "vue";
import {useUserStore} from "@/stores/UserStore";

const {attempt} = useAuth();
const user = useUserStore();

onBeforeMount(async () => {
  await attempt();
})
</script>

<template>
  <Header/>

  <MainLayout>
    <RouterView/>
  </MainLayout>

</template>

<style scoped>
</style>
