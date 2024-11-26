<template>
    <div>
        <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
            User's Shop
        </h1>
    </div>
</template>
<script setup>
const { user } = defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>
