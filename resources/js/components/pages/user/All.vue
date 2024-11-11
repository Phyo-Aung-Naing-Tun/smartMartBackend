<template>
    <div class="px-3 mt-6">
        <div class="my-4 grid grid-cols-4 gap-5">
            <SearchInput
                classes="focus:outline-blue-900 rounded"
                @getChanges="getChanges"
            />
            <DropDown
                classes="rounded"
                :data="dropdownData"
                @selectValue="filter"
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
import { ref, onMounted, inject, reactive } from "vue";
import { notiError, transformDropDownData } from "../../../utlis/helpers";
import SearchInput from "../../ui/SearchInput.vue";
import DropDown from "../../core/DropDown.vue";
let users = ref(null);
let useDebounce = inject("useDebounce");
const dropdownData = ref([]);
onMounted(() => {
    getUsers();
    getRoles();
});

function getUsers(search = null) {
    apiClient
        .get("/users", {
            params: {
                per_page: 7,
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

function getRoles() {
    apiClient
        .get("/roles")
        .then((response) => {
            dropdownData.value = response.data.data.map((data) =>
                transformDropDownData(data.id, data.name, false)
            );
            dropdownData.value.unshift({
                key: "all",
                value: "All",
                active: true,
            });
        })
        .catch((error) => {
            notiError("Server Error");
            console.log(error);
        });
}

function filter(value) {
    console.log(value);
}
</script>
