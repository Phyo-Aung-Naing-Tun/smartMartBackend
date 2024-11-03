<template>
    <div class="px-3 mt-6">
        <Footable
            v-if="products"
            :json="json"
            :data="products.data"
            @paginateData="getData"
        />
    </div>
</template>
<script setup>
import Footable from "../../core/Footable.vue";
import json from "../../../directives/user.json";
import apiClient from "../../../axios/axiosConfig";
import { ref, onMounted } from "vue";
import { notiError } from "../../../utlis/helpers";
let products = ref(null);

onMounted(getProducts);
function getProducts() {
    apiClient
        .get("/users", {
            params: {
                per_page: 3,
                page: 2,
            },
        })
        .then((response) => {
            products.value = response.data;
            json.meta = products.value?.meta;
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
    products.value = value.data;
    json.meta = products.value?.meta;
}
</script>
