<template>
    <div class="px-3 mt-6">
        <Footable v-if="products" :json="json" :data="products.data" />
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
        .get("/users")
        .then((response) => {
            products.value = response.data;
        })
        .catch((error) => {
            notiError("Server Error");
            console.log(error);
        })
        .finally(() => {
            console.log("finally");
        });
}
</script>
