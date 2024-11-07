<template>
    <div class="px-3 mt-6">
        <Footable
            v-if="users"
            :json="json"
            :data="users.data"
            @paginateData="getData"
        />
    </div>
</template>
<script setup>
import Footable from "../../core/Footable.vue";
import json from "../../../directives/user.json";
import apiClient from "../../../axios/axiosConfig";
import { ref, onMounted, watch } from "vue";
import { notiError } from "../../../utlis/helpers";
let users = ref(null);

onMounted(() => {
    getUsers();
});

function getUsers() {
    apiClient
        .get("/users", {
            params: {
                per_page: 5,
                page: 1,
            },
        })
        .then((response) => {
            users.value = response.data;
            json.meta = users.value?.meta;
        })
        .catch((error) => {
            notiError("Server Error");
            console.log(error);
        })
        .finally(() => {
            console.log("finally");
        });
}

function getData(value) {
    users.value = value.data;
    json.meta = users.value?.meta;
}
</script>
