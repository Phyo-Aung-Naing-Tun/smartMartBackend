import app from "./main";
import "./bootstrap";
import "../css/app.css";
import VOtpInput from "vue3-otp-input";
import useDebounce from "./plugins/useDebounce";
import "./components";
import inputGrid from "./plugins/inputGrid";

app.use(useDebounce);
app.use(inputGrid);
app.component("v-otp-input", VOtpInput);

