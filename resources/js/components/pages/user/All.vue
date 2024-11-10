<template>
    <div class="px-3 mt-6">
        <div class="my-4 grid grid-cols-4">
            <SearchInput
                classes="focus:outline-blue-900 rounded"
                @getChanges="getChanges"
            />
        </div>
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
import { ref, onMounted, inject } from "vue";
import { notiError } from "../../../utlis/helpers";
import SearchInput from "../../ui/SearchInput.vue";
let users = ref(null);
let useDebounce = inject("useDebounce");
onMounted(() => {
    getUsers();
});

function getUsers(search = null) {
    apiClient
        .get("/users", {
            params: {
                per_page: 5,
                page: 1,
                search: search,
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

function getChanges(value) {
    useDebounce(() => {
        getUsers(value);
    }, 500);
}
</script>
