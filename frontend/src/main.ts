import './assets/main.css'
import { useNotificationStore } from '@/stores/notificationStore';
import { useUserStore } from '@/stores/UserStore';


import {createApp, onMounted} from 'vue'
import {createPinia} from 'pinia'

import App from './App.vue'
import router from './router'

import {QuillEditor} from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import 'flowbite';
const app = createApp(App)

const pinia = createPinia()
app.component('QuillEditor', QuillEditor)
app.use(pinia)
app.use(router)

const userStore = useUserStore(pinia);
const notificationStore = useNotificationStore(pinia);

if (userStore.id !== -1) {
  window.Echo.private(`user.${userStore.id}`)
    .listen('CommentCreated', (e) => {
      notificationStore.addNotification(e);
    });
}

app.mount('#app')
