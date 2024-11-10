<template>
    <div class="relative">
        <div @click="hello">
            <div v-bind="attributes">All</div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { computed } from "vue";

const props = defineProps({
    classes: {
        type: String,
    },
});
const attributes: object = computed(() => {
    return {
        class: `${props.classes} border border-gray-700 px-4 py-2 cursor-pointer block w-full`,
        disabled: true,
    };
});
function hello() {
    console.log("hello");
}
</script>
