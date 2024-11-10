import "./bootstrap";
import "../css/app.css";
import { createApp } from "vue";
import app from "./app.vue";
import { router } from "./router";
import apiClient from "./axios/axiosConfig";
import VOtpInput from "vue3-otp-input";
import useDebounce from "./plugins/useDebounce";

const data = createApp(app);
data.config.globalProperties.$axios = apiClient;
data.use(useDebounce);
data.use(router);
data.component("v-otp-input", VOtpInput);
data.mount("#app");
// createApp(app).config.globalProperties.$xi.use(router).mount('#app');
