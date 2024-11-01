import './assets/main.css'

import {createApp, onMounted} from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import 'flowbite';
import { initFlowbite } from 'flowbite'

onMounted(() => {
  initFlowbite();
})

const app = createApp(App)

app.component('QuillEditor', QuillEditor)
app.use(createPinia())
app.use(router)

app.mount('#app')
