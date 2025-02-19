<template>
    <div>
        <h1
            class="text-xl font-bold leading-tight tracking-tight text-center mb-3 text-gray-900 md:text-2xl"
        >
            Login
        </h1>
        <form @submit.prevent="login" class="space-y-4 md:space-y-6" action="#">
            <div>
                <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Your email</label
                >
                <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="name@company.com"
                    required
                />
            </div>
            <div>
                <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Password</label
                >
                <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                />
            </div>
            <m-button
                :isLoading="isLoading"
                type="submit"
                text="Sign In"
                classes="text-white bg-blue-900 h-10 w-full"
            />
            <p class="text-sm font-light text-gray-500">
                Don't have an account?
                <RouterLink
                    to="/auth/register"
                    class="font-medium text-primary-600 hover:underline"
                    >Register here</RouterLink
                >
            </p>
        </form>
        <OTPModal
            :secondsForTimmer="1000"
            :width="'400px'"
            title="Enter OTP Code"
            :show="openOtpModal"
            @dismiss="updateOtpModal"
            @submit="submitOTP"
            @rerequest="rerequestOTP"
        />
    </div>
</template>
<script setup lang="ts">
import { reactive, ref } from "vue";
import { RouterLink } from "vue-router";
import apiClient from "@/axios/axiosConfig";
import { notiError, notiSuccess } from "@/utlis/helpers";
import OTPModal from ".@/core/modals/OTPModal.vue";
import { router } from "@/router";
const openOtpModal: Boolean = ref(false);
const isLoading: Boolean = ref(false);

const form = reactive({
    email: null,
    password: null,
});

function login() {
    isLoading.value = true;
    apiClient
        .post("/login", form)
        .then((response) => {
            if (response.data.data.success) {
                updateOtpModal();
            }
        })
        .catch((error) => {
            notiError(error.response?.data?.message);
            console.log(error.response?.data?.message);
        })
        .finally(() => {
            isLoading.value = false;
        });
}

function submitOTP(value: String): void {
    apiClient
        .post("/verify_otp", {
            email: form.email,
            otp: value,
        })
        .then((response) => {
            if (response.status === 200) {
                notiSuccess("Login Successful");
                localStorage.setItem(
                    "user",
                    JSON.stringify(response.data.data.data)
                );
                localStorage.setItem(
                    "token",
                    JSON.stringify(response.data.data.token)
                );
                return router.push("/");
            }
        })
        .catch((error) => {
            notiError(error.response?.data?.message);
            console.log("error", error.response?.data.message);
        });
    console.log(value);
}

function rerequestOTP(): void {
    console.log("rerequesting");
}

function updateOtpModal(): void {
    localStorage.clear("duration"); //reset the timmer
    openOtpModal.value = !openOtpModal.value;
}
</script>
