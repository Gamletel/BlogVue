<script setup lang="ts">
import {RouterLink, RouterView} from 'vue-router'
import Header from "@/components/Header.vue";
import MainLayout from "@/layouts/MainLayout.vue";
</script>

<template>
  <Header/>
  <MainLayout>
    <RouterView/>
    <NotificationToast />
  </MainLayout>
</template>

<style scoped>
</style>
