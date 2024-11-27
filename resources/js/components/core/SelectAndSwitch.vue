<template>
    <div>
        <pre>{{ data }}</pre>
    </div>
</template>
<script setup>
const prop = defineProps({
    data: {
        type: Array,
        requied: true,
    },
});
</script>
