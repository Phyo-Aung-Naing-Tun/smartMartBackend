import './bootstrap';
import '../css/app.css'; 
import { createApp } from 'vue';
import app from './app.vue'
import { router } from './router';

createApp(app).use(router).mount('#app');
