import { createApp } from "vue";
import App from "./app.vue";
import apiClient from "./axios/axiosConfig";
import { router } from "./router";
import { createPinia } from "pinia";

const app = createApp(App);
const pinia = createPinia();
app.use(router);
app.use(pinia);
app.config.globalProperties.$axios = apiClient;
app.mount("#app");
export default app;
