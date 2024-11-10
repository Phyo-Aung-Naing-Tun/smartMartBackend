<template>
    <input
        v-bind="attributes"
        @keyup="emitAction"
        v-model="inputValue"
        type="text"
        :placeholder="placeholder"
    />
</template>
<script setup lang="ts">
import { computed, ref } from "vue";

const inputValue = ref("");
const props = defineProps({
    placeholder: {
        type: String,
        default: "Search...",
    },
    classes: {
        type: String,
    },
});

const attributes: object = computed(() => {
    return {
        class: `${props.classes} border border-gray-700 px-4 py-2 block w-full`,
    };
});
const emit = defineEmits(["getChanges"]);

function emitAction(): void {
    emit("getChanges", inputValue.value);
}
</script>
