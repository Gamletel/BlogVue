<template>
  <div class="fixed top-4 right-4 z-50">
    <TransitionGroup name="notification">
      <div
        v-for="notification in notifications"
        :key="notification.id"
        class="mb-2 p-4 bg-white rounded-lg shadow-lg max-w-sm transform transition-all duration-300"
      >
        <div class="flex items-start">
          <div class="flex-1">
            <p class="text-sm font-medium text-gray-900">
              {{ notification.message }}
            </p>
            <p class="text-xs text-gray-500 mt-1">
              {{ notification.data.comment_preview }}
            </p>
          </div>
          <button
            @click="removeNotification(notification.id)"
            class="ml-4 text-gray-400 hover:text-gray-500"
          >
            <span class="sr-only">Закрыть</span>
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { useNotificationStore } from '@/stores/notificationStore';

const store = useNotificationStore();
const { notifications } = storeToRefs(store);

const removeNotification = (id: string) => {
  store.removeNotification(id);
};
</script>

<style scoped>
.notification-enter-active,
.notification-leave-active {
  transition: all 0.3s ease;
}

.notification-enter-from {
  opacity: 0;
  transform: translateX(30px);
}

.notification-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>