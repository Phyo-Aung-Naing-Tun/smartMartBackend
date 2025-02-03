import { createApp } from "vue";
import App from "./app.vue";
import apiClient from "./axios/axiosConfig";
import { router } from "./router";

const app = createApp(App);
app.use(router);
app.config.globalProperties.$axios = apiClient;
app.mount("#app");
export default app;
