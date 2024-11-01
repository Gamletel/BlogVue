<script setup lang="ts">
import {useUserStore} from "@/stores/UserStore";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";

const route = useRoute();
const user = useUserStore();
const isAuthUserPage = ref(false);

onMounted(() => {
  if (user.id == route.params.id) {
    isAuthUserPage.value = true;
  }
  console.log(isAuthUserPage.value);
})
</script>

<template>

</template>

<style scoped>

</style>
