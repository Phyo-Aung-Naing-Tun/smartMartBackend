import './bootstrap';
import '../css/app.css'; 
import { createApp } from 'vue';
import app from './app.vue'
import { router } from './router';
import apiClient from './axios/axiosConfig'

const data = createApp(app);
data.config.globalProperties.$axios = apiClient;
data.use(router)
data.mount('#app')
// createApp(app).config.globalProperties.$xi.use(router).mount('#app');
