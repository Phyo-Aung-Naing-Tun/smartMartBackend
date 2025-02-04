<template>
    <div>
        <input
            @input="handleInput"
            v-bind="attributes"
            @keydown="handleKeyDown"
        />
    </div>
</template>
<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    type: {
        required: false,
        default: "text",
        type: String,
    },
    banCharacters: {
        required: false,
        default: ["/", "//", "||"],
    },
    maxLength: {
        required: false,
        default: false,
    },
    minLength: {
        required: false,
        default: false,
    },
    isRequired: {
        required: false,
        default: false,
    },
});
const banKeysForNumberInput = ref(["e", "E", "ArrowUp", "ArrowDown", "=", "-"]);
const isBanForNumberInput = ref(false);
const result = defineModel();

function handleKeyDown(e) {
    isBanForNumberInput.value = banKeysForNumberInput.value.includes(e.key);
}

function handleInput(e) {
    if (filterCharacters(e.data) && props.type == "text")
        e.target.value = result.value;
    if (isBanForNumberInput.value && props.type == "number")
        e.target.value = result.value;
    result.value = e.target.value;
}

const attributes = computed(() => {
    return {
        class: "border border-gray-700 px-4 py-1.5 block w-full focus:outline-blue-900 rounded",
        type: props.type,
        maxlength: props.maxLength,
        minlength: props.minLength,
        required: props.isRequired,
    };
});

function filterCharacters(text) {
    return props.banCharacters.includes(text);
}
</script>
<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
