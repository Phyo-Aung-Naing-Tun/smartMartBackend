<template>
    <div>
        <h1 class="text-gray-800 mb-4 text-lg tracking-wide font-bold">
            User's Shop
        </h1>
        <pre>{{ shop }}</pre>
    </div>
</template>
<script setup>
const { shop } = defineProps({
    shop: {
        type: Object,
        required: true,
    },
});
</script>
