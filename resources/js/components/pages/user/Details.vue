<template>
    <div class="p-5 space-y-10">
        <Navigator :data="navigatorData" />
        <ProfileCard v-if="user" :user="user" />
        <ShopCard v-if="user?.shop" :shop="user?.shop" />
    </div>
</template>
<script setup>
import { useRoute } from "vue-router";
import apiClient from "../../../axios/axiosConfig";
import { notiError } from "../../../utlis/helpers";
import { onMounted, ref } from "vue";
import Navigator from "../../core/Navigator.vue";
import ProfileCard from "../../user/ProfileCard.vue";
import ShopCard from "../../user/ShopCard.vue";

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
