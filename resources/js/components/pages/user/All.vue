<template>
    <div class="px-3 mt-6">
        <Navigator :data="navigatorData" />
        <div>{{ result }}</div>
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
            <m-button
                link="/users/create"
                text="Add New"
                class="border border-blue-800 bg-blue-800 hover:bg-blue-500 text-white rounded w-[120px]"
            >
                <FontAwesomeIcon class="ms-2" :icon="faPlusCircle" />
            </m-button>
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
import { notiError, transformDropDownData } from "../../../utlis/helpers";
import SearchInput from "../../ui/SearchInput.vue";
import DropDown from "../../core/DropDown.vue";
import Navigator from "../../core/Navigator.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusCircle } from "@fortawesome/free-solid-svg-icons";

const users = ref(null);
const result = ref(null);
const useDebounce = inject("useDebounce");
const searchValue = ref(null);
const roleValue = ref(null);

const selectData = ref([
    {
        type: "normal",
        key: "name",
    },
    {
        type: "dropDown",
        key: "job_id",
    },
    {
        type: "date",
    },
]);

const navigatorData = ref([{ name: "Users", link: "/users", current: true }]);

const dropdownData = ref([]);
onMounted(() => {
    getUsers();
    getRoles();
});

function getUsers(search = null, role = null) {
    apiClient
        .get("/users", {
            params: {
                per_page: 7,
                page: 1,
                search: search,
                role: role,
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
        searchValue.value = value;
        getUsers(searchValue.value, roleValue.value);
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
    roleValue.value = value !== "all" ? value : null;
    getUsers(searchValue.value, roleValue.value);
}
</script>
