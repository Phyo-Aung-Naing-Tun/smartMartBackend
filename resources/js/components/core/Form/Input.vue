<template>
    <div>
        <div :class="$getInputLayout(minimize)">
            <label
                :class="$getLabelPosition(grid)"
                class="tracking-wide"
                v-if="label"
                :for="id ? id : generatedId"
                >{{ label }} <span v-if="isRequired">*</span></label
            >
            <input
                :class="$getInputPosition(grid)"
                :id="id ? id : generatedId"
                @input="handleInput"
                v-bind="attributes"
                @keydown="handleKeyDown"
            />
        </div>
        <small v-if="errorMessage" class="tracking-wide text-red-600 mt-2">{{
            errorMessage
        }}</small>
    </div>
</template>
<script setup>
import { computed, ref } from "vue";
import helpers from "@/utlis/helpers.js";

const props = defineProps({
    type: {
        required: false, //text, number, password, confirm_password
        default: "text",
        type: String,
    },
    banCharacters: {
        //to ban in text input
        required: false,
        default: ["/", "//", "||"],
        type: Array,
    },
    maxLength: {
        required: false,
        default: 100,
        type: Number,
    },
    minLength: {
        required: false,
        default: 0,
        type: Number,
    },
    isRequired: {
        required: false,
        default: false,
        type: Boolean,
    },
    compareValue: {
        //to compare two value
        required: false,
        type: String,
    },
    placeholder: {
        required: false,
        type: String,
    },
    id: {
        required: false,
        default: null,
        type: String | Number,
    },
    label: {
        required: false,
        default: null,
        type: String,
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
const banKeysForNumberInput = ref(["e", "E", "ArrowUp", "ArrowDown", "=", "-"]);
const isBanForNumberInput = ref(false);
const result = defineModel();
const errorMessage = ref(null);
const generatedId = ref( helpers.generaCustomId());
const attributes = computed(() => {
    return {
        class: "border border-gray-700 px-4 py-1.5 block w-full focus:outline-blue-900 rounded",
        type: props.type,
        maxlength: props.maxLength,
        minlength: props.minLength,
        required: props.isRequired,
        placeholder: props.placeholder,
    };
});

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
