<template>
    <div class="relative">
        <pulse-loading v-if="isSearching" class=" text-blue-700 absolute right-2 top-[8%] "/>
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
    isSearching: {
        required: false,
        default: false,
        type: Boolean,
    },
});







</script>
