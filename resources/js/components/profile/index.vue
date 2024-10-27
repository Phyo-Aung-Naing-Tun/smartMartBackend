<template>
    <div class="p-4 flex flex-col gap-2 items-center">
        <img
            class="border mt-20 mb-6 w-[200px] h-[200px] rounded-full shadow"
            v-if="!profile?.profile"
            src="../../assets/public/images/png/smartmartlogo.png"
            alt=""
        />
        <img
            class="w-[200px] h-[200px] rounded-full shadow"
            v-else
            :src="profile?.profile"
            alt=""
        />
        <h1 class="font-bold text-lg tracking-wide text-gray-900">
            {{ profile?.name }}
        </h1>
        <p class="tracking-wide text-gray-900">{{ profile?.email }}</p>
        <p class="tracking-wide text-gray-900">{{ profile?.phone }}</p>
        <button
            @click="logOut"
            class="fixed bottom-20 right-20 hover:text-red-600 flex items-center gap-3"
        >
            <FontAwesomeIcon :icon="faArrowRightFromBracket" />
            <span>Logout</span>
        </button>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import apiClient from "../../axios/axiosConfig";
import { toast } from "vue3-toastify";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { icon } from "@fortawesome/fontawesome-svg-core";
import { faArrowRightFromBracket } from "@fortawesome/free-solid-svg-icons";
import { router } from "../../router";
const profile = ref(null);

onMounted(() => {
    getProfile();
});

function getProfile() {
    apiClient
        .get("/profile")
        .then((response) => {
            profile.value = response.data.data;
        })
        .catch((error) => {
            toast(error);
        });
}

function logOut() {
    apiClient
        .post("/logout")
        .then((response) => {
            console.log();

            if (response.status) {
                localStorage.clear("user");
                localStorage.clear("token");
                router.push("/auth/login");
            }
        })
        .catch((error) => {
            console.log(error);
        });
}
</script>
