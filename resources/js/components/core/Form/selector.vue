<template>
    <div>
        <m-input :label="label" :placeholder="placeholder" :mininize="minimize" :grid="grid"  />
    </div>
</template>
<script setup>
const props = defineProps({
    label : {
        required: false,
        default : null,
    },
    placeholder : {
        required : false,
        default : null,
    },
    minimize: {
        //for label position
        required: false,
        default: false,
        type: Boolean,
    },
    grid: {
        required: false,
        default: 2,
        type: Number,
    },
});







</script>
