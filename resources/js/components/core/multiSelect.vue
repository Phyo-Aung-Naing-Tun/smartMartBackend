<template>
    <div>
        <div v-for="(select, index) in data" :key="index">
            <div>{{ select.type }}</div>
            <!-- for normal search -->
            <input
                v-if="select?.type == 'normal'"
                type="text"
                class="border border-blue-600"
            />
            <!-- for dropdown search -->

            <!-- for date search -->
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    data: {
        requierd: true,
        type: String,
    },
});
</script>
