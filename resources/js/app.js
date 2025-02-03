import app from "./main";
import "./bootstrap";
import "../css/app.css";
import VOtpInput from "vue3-otp-input";
import useDebounce from "./plugins/useDebounce";
import "./components";

app.use(useDebounce);
app.component("v-otp-input", VOtpInput);
