<template>
    <div class="p-5">
        <Navigator :data="navigatorData" />
        <div class="mt-4">
            <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
                User Profile
            </h1>
            <div class="rounded shadow p-3 grid grid-cols-7 bg-white">
                <div class="overflow-hidden border-r py-4 col-span-2">
                    <div class="mb-3">
                        <img
                            class="rounded-full shadow mx-auto w-[100px] h-[100px] flex border border-blue-800"
                            v-if="user?.profile"
                            :src="user?.profile"
                        />
                        <div
                            v-else
                            class="rounded-full shadow bg-white mx-auto w-[100px] h-[100px] flex justify-center items-center border border-blue-800"
                        >
                            <FontAwesomeIcon
                                class="text-[50px] primary_text"
                                :icon="faUser"
                            />
                        </div>
                    </div>
                    <h1 class="text-center tracking-wide">{{ user?.name }}</h1>
                    <h1 class="text-center text-sm text-gray-800">
                        {{ user?.phone }}
                    </h1>
                </div>
                <div class="col-span-5 px-3">
                    <div class="grid grid-cols-3">
                        <div>
                            <h1 class="font-bold tracking-wide primary_text">
                                Role
                            </h1>
                            <p class="capitalize tracking-wide text-gray-800">
                                {{ user?.role }}
                            </p>
                        </div>
                        <div>
                            <h1 class="font-bold tracking-wide primary_text">
                                Created At
                            </h1>
                            <p class="capitalize tracking-wide text-gray-800">
                                {{ formatDate(user?.created_at) }}
                            </p>
                        </div>
                        <div>
                            <h1 class="font-bold tracking-wide primary_text">
                                Updated At
                            </h1>
                            <p class="capitalize tracking-wide text-gray-800">
                                {{
                                    user?.updated_at
                                        ? formatDate(user?.updated_at)
                                        : "-"
                                }}
                            </p>
                        </div>
                    </div>
                    <hr class="my-3" />
                    <div>
                        <div>
                            <h1 class="font-bold tracking-wide primary_text">
                                Address
                            </h1>
                            <p class="capitalize tracking-wide text-gray-800">
                                {{ user?.address ?? "-" }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useRoute } from "vue-router";
import apiClient from "../../../axios/axiosConfig";
import { notiError, formatDate } from "../../../utlis/helpers";
import { onMounted, ref } from "vue";
import { faUser } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import Navigator from "../../core/Navigator.vue";

const route = useRoute();
const user = ref(null);
const id = route.params.id;
const navigatorData = ref([
    { name: "Users", link: "/users", current: false },
    { name: "Details", link: `/users/${id}`, current: true },
]);
onMounted(() => {
    getUser();
});

function getUser() {
    apiClient
        .get(`/users/${id}`)
        .then((response) => {
            user.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
            notiError(error);
        });
}
</script>
