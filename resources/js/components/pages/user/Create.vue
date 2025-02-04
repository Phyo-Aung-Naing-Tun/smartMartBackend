<template>
    <div class="px-3 mt-6">
        <Navigator :data="navigatorData" />
        <div class="mt-3">
            <!-- User Create Form -->
            <CreateOrEditForm />
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import Navigator from "@/components/core/Navigator.vue";
import CreateOrEditForm from "@/components/user/CreateOrEditForm.vue";

const navigatorData = ref([
    { name: "Users", link: "/users", current: false },
    { name: "Create", link: "/users/create", current: true },
]);
</script>
