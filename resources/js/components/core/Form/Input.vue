<template>
    <div>
        <input @input="handleInput" v-bind="attributes" />
    </div>
</template>
<script setup>
import { required } from "@vuelidate/validators";
import { computed, ref } from "vue";

const props = defineProps({
    type: {
        required: false,
        default: "text",
        type: String,
    },
    banCharacters: {
        required: false,
        default: ["/", "//", "||", "s"],
    },
});

function handleInput(e) {
    console.log(filterCharacters(e.target.value));
}

const attributes = computed(() => {
    return {
        class: "border border-gray-700 px-4 py-1.5 block w-full focus:outline-blue-900 rounded",
        type: props.type,
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
