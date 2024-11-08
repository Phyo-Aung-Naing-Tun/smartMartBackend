<template>
    <input
        class="border border-gray-700 px-4 py-2 block w-full"
        @keyup="emitAction"
        v-model="inputValue"
        type="text"
        :placeholder="placeholder"
    />
</template>
<script setup lang="ts">
import { ref } from "vue";

const inputValue = ref("");
const props = defineProps({
    placeholder: {
        type: String,
        default: "Search...",
    },
});
const emit = defineEmits(["getChanges"]);

function emitAction(): void {
    emit("getChanges", inputValue.value);
}
</script>
