<template>
    <div class="space-x-2 flex items-center text-lg">
        <div v-for="(link, index) in data" :key="index">
            <router-link
                :class="link?.current ? 'primary_text' : 'text-gray-600'"
                class="space-x-2 tracking-wide hover:text-blue-800 font-bold"
                :to="link?.link"
            >
                <span>/</span>
                <span>{{ link?.name }}</span>
            </router-link>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
});
</script>
