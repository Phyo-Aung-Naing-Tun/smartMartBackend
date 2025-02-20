import app from "./main";

import OTPModal from "@/components/core/modals/OTPModal.vue";
app.component("otp-modal",OTPModal);

import Input from "@/components/core/Form/Input.vue";
app.component("m-input", Input);

import Button from "@/components/core/Button.vue";
app.component("m-button", Button);

import Selector from "@/components/core/Form/selector.vue";
app.component("m-selector", Selector);

import RoleSelector from "@/components/core/Selectors/RoleSelector.vue";
app.component("role-selector", RoleSelector);

import PulseSpinner from "@/components/core/Loadings/PulseSpinner.vue";
app.component("pulse-loading",PulseSpinner);
