<template>
    <div>
        <input
            @input="handleInput"
            v-bind="attributes"
            @keydown="handleKeyDown"
        />
        <small v-if="errorMessage" class="tracking-wide text-red-600 mt-2">{{
            errorMessage
        }}</small>
    </div>
</template>
<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    type: {
        required: false, //text, number, password, confirm_password
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
    compareValue: {
        required: false,
        type: String,
    },
});
const banKeysForNumberInput = ref(["e", "E", "ArrowUp", "ArrowDown", "=", "-"]);
const isBanForNumberInput = ref(false);
const result = defineModel();
const errorMessage = ref(null);

function handleKeyDown(e) {
    isBanForNumberInput.value = banKeysForNumberInput.value.includes(e.key);
}

function handleInput(e) {
    if (filterCharacters(e.data) && props.type == "text")
        e.target.value = result.value;

    if (isBanForNumberInput.value && props.type == "number")
        e.target.value = result.value;

    if (
        props.compareValue &&
        props.type == "confirm_password" &&
        e.target.value != props.compareValue
    ) {
        errorMessage.value = "Confirm password must be same";
    } else if (props.compareValue && e.target.value != props.compareValue) {
        errorMessage.value = "Compare value must be same";
    } else {
        errorMessage.value = null;
    }

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
