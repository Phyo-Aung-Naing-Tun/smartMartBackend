<template>
    <div>
        <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
            User's Shop
        </h1>
        <div>{{ shopId }}</div>
    </div>
</template>
<script setup>
const { shopId } = defineProps({
    shopId: {
        type: String,
        required: true,
    },
});
</script>
